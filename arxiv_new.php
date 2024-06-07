<?php

date_default_timezone_set( "EST" );

define('IN_PHPBB', true);
define('BOOKMARK_LINK', '/bookmark.php');

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

anti_hack($phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();
$user->get_profile_fields($user->data['user_id']);

//var_dump($user->lang['arxives']);

page_header('Arxiv New');
$template->set_filenames(array(
    'body' => 'message_body.html',
));

$starttime = microtime_float();

$arxivesString = ($user->profile_fields['pf_user_arxives']) ? $user->profile_fields['pf_user_arxives'] : $config['default_arxives'];
$arxives = to_array($arxivesString);

$keywords = ($user->profile_fields['pf_user_keywords']) ? $user->profile_fields['pf_user_keywords'] : $config['default_arxiv_keys'];
$keywords = to_array($keywords);

$date = ($request->is_set('d')) ? $request->variable('d', '') : '';
$month = ($request->is_set('m')) ? $request->variable('m', '') : '';
$year = ($request->is_set('y')) ? $request->variable('y', '') : '';

$interval = ($request->is_set('i')) ? $request->variable('i', 0) : 1;
$interval = min(30, $interval);

$new_date = ($date) ? $date : $config['arxiv_new_date'];
$newDate = new DateTime($new_date);

$latestArxiv = new DateTime($config['arxiv_new_date']);


$text = '';

if(!$user->profile_fields['pf_user_arxives']) {
    $text .= '<p class="gen" style="text-align: center; color: #FF0000">Log in to use a customized arxiv and keyword list set in your profile.<br />You can then also make bookmarks and set up or join journal clubs.</p>';
}

$links = get_links_html($new_date, $interval, $latestArxiv, $newDate, $arxives);
$text .= $links;
$text .= '<dl>';

if(!empty($month)) {
    $date_range = "arxiv_tag like '". date("ym",strtotime("$year-$month-01")) ."%'";
    $date_range_replace = "date >= '$year-$month-01' and date < date_add('$year-$month-01',interval 1 month)";
} elseif ($interval > 1) {
    $date_range = "date <= '$new_date' and date > date_sub('$new_date',interval $interval day)";
    $date_range_replace = $date_range;
} else {
    $date_range = "date = '$new_date'";
    $date_range_replace = $date_range;
}
$arxiv_sql = $db->sql_in_set('arxiv', $arxives);


$text .= get_archives_html($arxiv_sql, $date_range, $keywords, $arxives);

$text .= "<dt><hr><h3>Replacements</h3></dt>";
$text .= get_replacements_html($arxiv_sql, $date_range_replace, $keywords, $arxives);
$text .= "</dl><hr>";

$links .= '<p>' . get_month_links($latestArxiv) . '</p>';
$links .= "<p>";

$links .= '<span class ="gensmall">Search time: '. number_format((microtime_float() - $starttime), 3, '.', '') . ' seconds</span>';
$links .= '<br><span class="gensmall">Papers matching: '. htmlspecialchars(implode(', ', $keywords)) .'</span>';

if ($user->data['user_id'] != ANONYMOUS) {
    $links .= '<p><span class ="genmed">';
    $links .= '[<A HREF="/">CosmoCofee Home</A>] ';
    $links .= '[<A HREF="' . BOOKMARK_LINK . '">Bookmarks</A>] ';
    $links .= '[<A HREF="/search.php?search_id=newposts">New posts</A>] ';
    $links .= '[<A HREF="/search.php?search_id=unanswered">Unanswered posts</A>]';
    $links .= '</span></p>';
}
$links .= "</p>";

$text .= $links;

$template->assign_vars(array(
    'MESSAGE_TEXT'	=> $text,
    'MESSAGE_TITLE'	=> get_page_title($arxives, $new_date, $month, $year, $interval)
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

function get_links_html($new_date, $interval, $latestArxiv, $newDate, $arxives) {
    global $user, $request;

    $linksHtml = '';
    $links = [];

    if ($user->data['user_id'] != ANONYMOUS) {
        $linksHtml .= '[<A HREF="' . BOOKMARK_LINK . '">Bookmarks</A>]';
    }

    $dateDaysForLink = new DateTime($new_date);
    if ($interval > 1) {
        $dateDaysForLink->modify("-$interval day");
    }
    $linksHtml .= '[<A HREF="' . $request->server('PHP_SELF') . '?i=7&d=' . $dateDaysForLink->format('Y-m-d') . '">Week to ' . $dateDaysForLink->format('jS M') .'</A>] ';

    if($latestArxiv > $newDate) {
        $dateDaysForLink = new DateTime($new_date);

        for($i = 1; $i <= 7; $i++) {
            $dateDaysForLink->modify('+1 day');
            if($dateDaysForLink > $latestArxiv) break;
            if($dateDaysForLink->format('w') === '0' || $dateDaysForLink->format('w') === '6') continue;
            $links[] = '[<A HREF="' . $request->server('PHP_SELF') . '?d=' . $dateDaysForLink->format('Y-m-d') . '">' . $dateDaysForLink->format('j M') . '</A>] ';
        }
    }

    $links[] = ($interval > 1) ? '[<A HREF="' . $request->server('PHP_SELF') . '?d=' . $newDate->format('Y-m-d') . '">' . $newDate->format('j M') . '</A>] ' : '' ;

    $dateDaysForLink = new DateTime($new_date);
    for($i = 1; $i <= 7; $i++) {
        $dateDaysForLink->modify('-1 day');
        if($dateDaysForLink->format('w') === '0' || $dateDaysForLink->format('w') === '6') continue;

        $links[] = '[<A HREF="' . $request->server('PHP_SELF') . '?d=' . $dateDaysForLink->format('Y-m-d') . '">' . $dateDaysForLink->format('j M') . '</A>] ';
    }
    arsort($links);
    $linksHtml .= implode('', $links);

    if($latestArxiv == $newDate) {
        ob_start();
    ?>
        <TABLE BORDER=0 CELLPADDING=0 WIDTH=100%>
            <TR>
                <TD class="genmed"><?= $linksHtml ?></TD>
                <TD align="right" class ="genmed">
                    <?php foreach($arxives as $arxivItem): ?>
                        [<A TARGET="_blank" HREF="https://arxiv.org/list/<?= $arxivItem ?>/new"><?= $arxivItem ?></A>]
                    <?php endforeach; ?>
                </TD>
            </TR>
        </TABLE>
    <?php
        $linksHtml = ob_get_clean();
    }

    return $linksHtml;
}

function get_archives_html($arxiv_sql, $date_range, $keywords, $arxives) {
    global $db;

    $scores = [];
    $items = [];

    $sql = "SELECT
                phpbb_papers.paper_id, a.arxiv_tag, a.arxiv, a.title, a.authors, a.comments, a.abstract
            FROM
                ARXIV_NEW as a
            LEFT JOIN
                phpbb_papers using(arxiv_tag)
            WHERE
                $date_range
            AND
                $arxiv_sql
            ";

    $result = $db->sql_query($sql);

    while($row = $db->sql_fetchrow($result)) {
        $rowResult = print_relevant($row, false, $keywords, $arxives);
        if($rowResult) {
            $scores[] = $rowResult['score'];
            $items[] = $rowResult['item'];
        }
    }
    $db->sql_freeresult($result);
    array_multisort($scores, SORT_NUMERIC, SORT_DESC, $items, SORT_STRING);

    return implode('', $items);
}

function get_replacements_html($arxiv_sql, $date_range_replace, $keywords, $arxives) {
    global $db;

    $scores = [];
    $items = [];

    $sql = "SELECT
                phpbb_papers.paper_id, a.arxiv_tag, a.title, a.authors, a.comments
            FROM
                ARXIV_REPLACE as a
            LEFT JOIN
                phpbb_papers using(arxiv_tag)
            WHERE
                $date_range_replace
            AND
                $arxiv_sql
            ";

    $result = $db->sql_query($sql);

    while($row = $db->sql_fetchrow($result)) {
        $rowResult = print_relevant($row, true, $keywords, $arxives);
        if($rowResult) {
            $scores[] = $rowResult['score'];
            $items[] = $rowResult['item'];
        }
    }
    $db->sql_freeresult($result);
    array_multisort($scores, SORT_NUMERIC, SORT_DESC, $items, SORT_STRING);

    return implode('', $items);
}

function print_relevant($row, $replace, array $keywords, array $arxives) {
    global $user, $config;
    $text = '';

    $match_strings = get_match_strings($keywords);
    $mirror = ($user->profile_fields['pf_user_mirror']) ? $user->profile_fields['pf_user_mirror'] : $config['default_mirror'];

    $title = preg_replace($match_strings['match_str'], '<span class="key">\\0</span>', $row['title']);
    $authors = preg_replace($match_strings['match_str'], '<span class="key">\\0</span>', $row['authors']);
    $abstract = ($replace) ? '' : preg_replace($match_strings['match_str'], '<span class="key">\\0</span>', $row['abstract']);

    $addlen = 25;

    $tit_matches = (strlen($title) - strlen($row['title'])) / $addlen ;
    $tit_matches += (strlen($authors) - strlen($row['authors'])) / $addlen ;
    $abs_matches = ($replace) ? 0 : (strlen($abstract) - strlen($row['abstract'])) / $addlen;

    if($tit_matches + $abs_matches > 0) {
        if(!empty($match_strings['neg_match'])) {
            if (preg_match($match_strings['neg_match'], "$title $abstract $authors")) {
                return false;
            }
        }

        $arxivTag = $row['arxiv_tag'];
        $arxivSubject = isset($row['arxiv']) ? $row['arxiv'] : null;

        $titleLinks = " [";
        $titleLinks .= "<a href='https://$mirror/abs/$arxivTag' target='_blank'>abs</a>, ";
        $titleLinks .= "<a href='https://$mirror/pdf/$arxivTag'>pdf</a>";

        if(!defined('IPHONE')) {
            $titleLinks .= "] [<a href='/bibtex.php?arxiv=$arxivTag'>BibTex</a>] ";
        } else {
            $titleLinks .= "] ";
        }

        if ($user->data['user_id'] != ANONYMOUS) {
            $titleLinks .= "[<a href='/bookmark.php?add=$arxivTag' target='_blank'>Bookmark</a>]";
        }

        if($row['paper_id']) {
            $titleLinks .= " [<a href='/discuss/$arxivTag' target='_blank'>View discussion</a>]";
        } else {
            $titleLinks .= " [<a href='/arxiv_start.pl?$arxivTag' target='_blank'>discuss</a>]";
        }

        $text .= "<dt><h3 class='arxiv_title'><b>$arxivTag</b>$titleLinks</h3></dt>";

        $text .= "<dd>";
        $text .= '<span class="arxiv_title_line"><b>Title:</b> '. $title .'</span><br>';

        $authors = tex_accents($authors);
        #$authors = preg_replace('#\\\rm\{(.+?)\}#s','\\1', $authors);
        $text .= "<b>Authors:</b> $authors<br>";

        $comments = make_clickable($row['comments']);
        $comments = preg_replace('#(\<a\s*href=.*?\>).*?(\<\/a)#is', '\\1this URL\\2', $comments);
        #$comments = preg_replace('#\\\rm\{(.+?)\}#s','\\1', $comments);
        if($comments) {
            $text .= "<b>Comments:</b> $comments<br>";
        }

        if(!$replace) {
            $abs_matches = $abs_matches * 1000 / max(1000, strlen($abstract));
            $abstract = preg_replace('/\\\\cite\{([^\{]*?)\}/', '[$1]', $abstract);
            $abstract = make_clickable($abstract);
            $text .= "<p class='postbody2'>$abstract<br></p>";
        }
        $text .= "</dd>";

        return [
            'item' => $text,
            'score' => $tit_matches * 3 + $abs_matches + (count($arxives) - array_search($arxivSubject, $arxives)) * 3
        ];
    }
    return false;
}

function get_page_title($arxives, $new_date, $month, $year, $interval) {
    $newDate = new DateTime($new_date);
    if (!empty($month)){
        $year = ($year) ? $year : $newDate->format('Y');
        $dateStr =  $newDate->setDate($year, $month, 1)->format('F Y');
    } else {
        $dateStr =  $newDate->format('l, jS F Y');
        if($interval > 1) {
            $dateStr = "$interval days to " . $dateStr;
        }
    }

    return 'Filtered abstracts for ' . implode(', ', $arxives) . ': '. $dateStr;
}

function get_month_links($latestArxiv) {
    global $request;
    $monthlinks = '';

    $latestArxivMonth = $latestArxiv->format('m');
    $latestArxivYear = $latestArxiv->format('Y');

    for($y = 2007; $y <= $latestArxivYear; $y++) {
        $monthlinks .= '<p>'. $y .': ';
        for ($m = 1; $m <= 12 ; $m++) {
            if($y == $latestArxivYear && $m > $latestArxivMonth) break;
            $monthlinks .= '[<A HREF="' . $request->server('PHP_SELF') . '?y=' . $y . '&m=' . $m . '">' . date('F', strtotime("$y-$m")) . '</A>] ';
        }
        $monthlinks .= '</p>';
    }

    return $monthlinks;
}


