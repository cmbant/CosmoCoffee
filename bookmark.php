<?php

define('IN_PHPBB', true);


#error_reporting(E_ALL);
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);



$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/arxiv_db.' . $phpEx);

anti_hack($phpEx);

// Initialize ArXiv database
$arxiv_db = new ArxivDatabase();

$user->session_begin();
$auth->acl($user->data);
$user->setup();
$user->get_profile_fields($user->data['user_id']);

$user_id = $user->data['user_id'];
$username = $user->data['username'];

$fname = $this_page = basename($request->server('SCRIPT_NAME'));
$fullfname = makeUrl($fname, $request->server('QUERY_STRING'), "deltag=&book_id=&paper=");

$page_title = 'Paper bookmarks';
$inner_page_title = 'Paper bookmarks';
$canchange = 1;
$status = '';
$status_read = 1;
$status_ignore = 2;
$startc = 0; //first row to return
$maxrows = 50;
$isadmin = 0;


$text = '';
$error = '';
$clubtxt = '';


if($request->is_set('export')) {
    $do_export = $request->variable('export', '');
    $maxrows = 10000;
    $separator = ($request->is_set('separator')) ? $request->variable('separator', '') : ' ';
}
$club = $request->variable('club', -1);
$noclub = $request->variable('noclub', '');
$addclub = $request->variable('addclub', 0);

$addref = ($request->is_set('add')) ? $request->variable('add', '') : '';
$addref = preg_replace('#v.$#', '', $addref);
$delref = ($request->is_set('delete')) ? $request->variable('delete', '') : '';

$startc = $request->variable('start', 0);
$paper_status = $request->variable('status', 0);
$paper = $request->variable('paper', '');
$bookmark_id = $request->variable('book_id', 0);
$top_months = $request->variable('top_months', 0);

$category = $request->variable('category', '');
if($category != 'null') {
    $category = $request->variable('category', 0);
}

$edit_categories = (boolean) $request->variable('editcategory', 0);
$addcategory = $request->variable('addcategory', '');
$delcategory = $request->variable('delcategory', 0);

$deltag = $request->variable('deltag', 0);
$editnote = $request->variable('editnote', 0);
$sort_by = $request->variable('sort_by', 'paper_date');

if($club >= 0) {
    $delref = '';
    $addref = '';
    $canchange = 0;
    $isdamin = 0;

    $sqlClub = "SELECT
                name, description
            FROM
                journal_clubs
            WHERE
                club_id = $club";

    $result = $db->sql_query($sqlClub);
    if($row = $db->sql_fetchrow($result)) {
        $db->sql_freeresult($result);
        $page_title = $row['name'];
        $inner_page_title = $row['name'];

        $clubtxt = "<p class='postbody2'>{$row['description']}</p>";

        $sql = "SELECT
                    u.username, c.manager, u.user_id, u.user_email
                FROM
                    phpbb_users as u, club_members as c
                WHERE
                    c.user_id = u.user_id
                AND
                    c.club_id = '$club'
                ORDER BY
                    c.manager DESC, u.username";

        $emails = '';
        if ($result = $db->sql_query($sql)) {
            $managers  = [];
            $members   = [];
            $emailsArr = [];
        
            while ($row = $db->sql_fetchrow($result)) {
                // Build the profile‐link HTML
                $link = "<a href='memberlist.php?mode=viewprofile&u={$row['user_id']}'>"
                      . htmlspecialchars($row['username'], ENT_QUOTES)
                      . "</a>";
        
                // Track managers vs members
                if ($row['manager'] === '1') {
                    $managers[] = $link;
                    if ($row['user_id'] == $user->data['user_id']) {
                        $isadmin = 1;
                        $canchange = 1;
                    }
                } else {
                    $members[] = $link;
                }
        
                // Track emails (skip your own)
                if ($row['user_id'] !== $user->data['user_id']) {
                    $emailsArr[] = $row['user_email'];
                    $canchange = 1;
                }
            }
            $db->sql_freeresult($result);
        
            // Implode with comma+space
            $managersLinks = implode(', ', $managers);
            $membersLinks  = implode(', ', $members);
            $emails        = implode(';',  $emailsArr);
        
            // Output
            $clubtxt .= "<p class='genmed'>Managers: $managersLinks</p>";
            $clubtxt .= "<p class='genmed'>Members:  $membersLinks</p>";
        }
        if($isadmin === 1) {
            $clubtxt .= "<p class='genmed'><a href='mailto:$emails?subject=$page_title'>Emails</a></p>";
        }
    }
}

if ($user->data['user_id'] != ANONYMOUS  && $canchange) {
    $text .= get_arXiv_ref_html();
}

if($club < 0 && $request->is_set('user_id')) {

    $user_id = $request->variable('user_id', '');
    if($category != 'all') {
        $user_id = $request->variable('user_id', 0);
    }

    if($user_id !== $user->data['user_id']) {
        $delref = '';
        $addref = '';

        if ($user_id == 'all'){
            $username = 'Everyone';
        } else {
            $username = get_username_by_id($user_id);
        }
    }
}

if($user_id === 'all' && $club < 0) {
    $page_title = "Everyone's bookmarks";
}

if(
    $club < 0 &&
    $request->is_set('notepaper', \phpbb\request\request_interface::POST) &&
    $user->data['user_id'] != ANONYMOUS &&
    $user->data['user_id'] == $user_id  &&
    $bookmark_id
) {

    $tag = $request->variable('notepaper', '', false, \phpbb\request\request_interface::POST);
    $note = $request->variable('note', '', false, \phpbb\request\request_interface::POST);

    if(!$result = $db->sql_query("UPDATE bookmarks SET note = '$note' WHERE bookmark_id = $bookmark_id AND user_id = $user_id")) {
        trigger_error('Could not change note');
    }
    $db->sql_freeresult($result);
}

if(
    $club < 0 &&
    $request->is_set('add_book_tag', \phpbb\request\request_interface::POST) &&
    $user->data['user_id'] != ANONYMOUS &&
    $user->data['user_id'] == $user_id  &&
    $bookmark_id
){
    $tag = $request->variable('add_book_tag', 0, false, \phpbb\request\request_interface::POST);
    if($tag) {
        if(!$result = $db->sql_query("insert ignore into paper_bookmark_tags(bookmark_id,tag_id) values ($bookmark_id, $tag)")) {
            trigger_error('Could not add tag');
        }
        $db->sql_freeresult($result);

        $tag = $request->variable('add_book_tag2', 0, false, \phpbb\request\request_interface::POST);
        if($tag) {
            if(!$result = $db->sql_query("insert ignore into paper_bookmark_tags(bookmark_id,tag_id) values ($bookmark_id, $tag)")) {
                trigger_error('Could not add tag2');
            }
        }
        $db->sql_freeresult($result);
    }
}

if(
    $club < 0 &&
    $deltag &&
    $user->data['user_id'] != ANONYMOUS &&
    $user->data['user_id'] == $user_id  &&
    $bookmark_id
){
    if(!$result = $db->sql_query("delete from paper_bookmark_tags where bookmark_id=$bookmark_id and tag_id=$deltag")) {
        trigger_error('Could not delete tag');
    }
    $db->sql_freeresult($result);
}

if($club < 0 && $addcategory) {
    if($result = $db->sql_query("select * from bookmark_tags where user_id=$user_id and tag='$addcategory'")) {
        if(!$row = $db->sql_fetchrow($result)) {
            $db->sql_freeresult($result);
            if(!$result = $db->sql_query("insert into bookmark_tags(user_id,tag) values($user_id,'$addcategory')")) {
                trigger_error('Error adding category');
            }
        }
    } else {
        trigger_error('Error checking existing category');
    }
    $db->sql_freeresult($result);
}

if($club < 0 && $delcategory) {
    if(!$result = $db->sql_query("delete from paper_bookmark_tags where tag_id in (select tag_id from bookmark_tags where  user_id=$user_id and tag_id=$delcategory)")) {
        trigger_error('Error deleting bookmarked categories');
    }
    $db->sql_freeresult($result);

    if(!$result = $db->sql_query("delete from bookmark_tags where user_id=$user_id and tag_id=$delcategory")) {
        trigger_error('Error deleting category');
    }
    $db->sql_freeresult($result);
}

if(!empty($addref) && $user_id > 1) {

   if($result = $db->sql_query("select user_id from bookmarks where user_id = $user_id and arxiv_tag='$addref'")) {
        if(!$row = $db->sql_fetchrow($result)) {
            $db->sql_freeresult($result);

            // Check if paper exists in ArXiv SQLite database
            if($arxiv_db->existsInArxivNew($addref)) {
                if(!$result = $db->sql_query("insert into bookmarks (user_id,arxiv_tag) values ($user_id,'$addref')")) {
                    trigger_error('Could not query existing bookmarks');
                }
                $db->sql_freeresult($result);
            } else {
                $error = "Paper $addref is not in the arXiv new database.";
            }
        }
    } else {
        trigger_error('Could not query existing bookmarks');
    }
}

if($noclub && $user->data['user_id'] != ANONYMOUS) {
    if(!$result = $db->sql_query("update bookmarks set club_id=0 where arxiv_tag='$noclub' and user_id={$user->data['user_id']}")) {
        trigger_error('Could not clear club-paper association');
    }
    $db->sql_freeresult($result);
}

if($addclub && $user->data['user_id'] != ANONYMOUS) {
    if(!$result = $db->sql_query("update bookmarks set club_id=$addclub where arxiv_tag='$paper' and user_id={$user->data['user_id']}")) {
        trigger_error('Could not add paper to club association');
    }
    $db->sql_freeresult($result);
}

if($user->data['user_id'] == ANONYMOUS && $club < 0){
    $error = 'You need to be logged in to view your bookmarks';
}

if(!empty($delref) && $user_id > 1) {
    if(!$result = $db->sql_query("delete paper_bookmark_tags from paper_bookmark_tags,bookmarks where user_id = $user_id and arxiv_tag='$delref' and paper_bookmark_tags.bookmark_id = bookmarks.bookmark_id")) {
        trigger_error('Could not delete bookmark tags');
    }
    $db->sql_freeresult($result);

    if(!$result = $db->sql_query("delete from bookmarks where user_id = $user_id and arxiv_tag='$delref'")) {
        trigger_error('Could not delete bookmark');
    }
    $db->sql_freeresult($result);
}

$change_status = $request->variable('change_status', '');
$flag = $request->variable('flag', 0);

if($club >= 0 && $isadmin == 1 && $change_status) {
    if($result = $db->sql_query("delete from club_paper_status where arxiv_tag='$change_status' and club_id=$club")) {
        $db->sql_freeresult($result);
        if(!$result = $db->sql_query("insert into club_paper_status values('$change_status', $club, $flag)")) {
            trigger_error('Could not change status');
        }
        $db->sql_freeresult($result);
    } else {
        trigger_error('Could not change status');
    }
}

$bookmark_tags = array();
$category_sel = '';

if($club < 0 && $canchange == 1 && $user_id != 'all') {
    if($result = $db->sql_query("select tag, tag_id from bookmark_tags where user_id = $user_id order by 1")) {
        while($row = $db->sql_fetchrow($result)){
            $bookmark_tags[$row['tag_id']] = $row['tag'];
        }

        if(!empty($bookmark_tags)) {
            foreach($bookmark_tags as $btag => $tag) {
                $category_sel .= "<option value='$btag'>$tag</option>";
            }
        }
    } else {
        trigger_error('Error getting bookmark_tags');
    }
    $db->sql_freeresult($result);
}

if($error !='') {
    $text .= '<p align="center"><font color="red">'. $error .'</font></p>';
}

$text .= '<p>';
$hasclubs = 0;

$isMember = array();
$clubs_shortname = array();
$clubs_id = array();

if($user->data['user_id'] != ANONYMOUS) {
    $text .= '<TABLE BORDER=0 CELLPADDING=0 WIDTH=100%><tr><td class="genmed">';

    if($club >= 0 || $user_id == 'all') {
        $text .= "[<a href='$fname'>Bookmarks</A>] ";
    }

    $text .= "Journal clubs: [<a href='$fname?user_id=all'>CosmoCoffee</a>]";

    $sql = "select
                j.shortname, j.name, j.club_id
            from
                journal_clubs as j, club_members as c
            where
                c.club_id=j.club_id
            and
                c.user_id={$user->data['user_id']}
            order by
                j.name";

    if($result = $db->sql_query($sql)) {
        while($row = $db->sql_fetchrow($result)){
            $hasclubs++;

            $text .= " [<a href='$fname?club={$row['club_id']}'>{$row['name']}</a>]";

            if(!empty($row['shortname'])) {
                $clubs_shortname[$hasclubs] = $row['shortname'];
            } else {
                $clubs_shortname[$hasclubs] = $row['name'];
            }

            $clubs_id[$hasclubs] = $row['club_id'];
            $isMember[$row['club_id']] = 1;
        }
    }
    $db->sql_freeresult($result);

    $text .= ' (<a href="journalclub.php">Start new or edit</a>)</td><td align="right" class ="genmed">';

    if($club < 0 && $user->data['user_id'] == $user_id) {
        $setcat = ($category) ? "&category=$category" : "";

        if($editnote == 1){
            $text .= "[<a href='$fname?$setcat'>Hide tag editors</a>]";
        } else {
            $text .= "[<a href='$fname?editnote=1$setcat'>Edit/Add tags</a>]";
        }
    }

    $text .= '</td></tr></table>';
}

if($user_id == 'all') {
   $text .= '<TABLE BORDER=0 CELLPADDING=0 WIDTH=100%><TR><TD class="genmed">';
   $text .= "<br>Most Popular: [<A HREF=\"$fname?user_id=all&top_months=1\">Month</a>] [<A HREF=\"$fname?user_id=all&top_months=3\">Quarter</a>] [<A HREF=\"$fname?user_id=all&top_months=12\">Year</a>]</TR></TD></TABLE>";
   $inner_page_title = 'All CosmoCoffee Bookmarks';
}

if($club > 0) {
    $text .= $clubtxt;
} elseif ($user_id > 1) {
    $inner_page_title = "$username's Bookmarks";

    if($canchange && $user_id != 'all'){

        $text .= '<p class="genmed">Categories: ';

        if(!empty($category)) {
            $text .= "[<A HREF='$fname'>All</A>] ";
        }

        if(!empty($bookmark_tags)){
            if($category == 'null') {
                $text .= "[<B>None</B>] ";
            } else {
                $text .= "[<A HREF='$fname?category=null'>None</A>] ";
            }
        }

        foreach($bookmark_tags as $btag => $tag) {
            $tmp = ($edit_categories) ? " (<A HREF='$fname?editcategory=1&delcategory=$btag'>delete</A>)" : "";
            $text .= ($btag == $category) ? "[<B>$tag</B>$tmp] ": "[<A HREF=\"$fname?category=$btag\">$tag</A>$tmp] ";
        }

        if($edit_categories) {
            $text .= " <a href='$fname'>Done</A><br>";
            $text.= "<form method='get' action='$fname'>";
            $text.=     '<SPAN class="genmed">New Category:';
            $text.=     '<input class="post" type="text" name="addcategory" size="25" maxlength="30" value="">';
            $text.=     '<input type="hidden" name="editcategory" value="1">';
            $text.=     '<input type="submit" value="Add" class="button">';
            $text.=     '</span>';
            $text.= '</form>';
        } else {
            $text .= " <a href='$fname?editcategory=1'>Edit</A>";
        }

        $text .= "</p>";
    }
}

if($club >= 0) {
    $text .= "<h4>";
    if($paper_status == $status_read) {
        $text .= "Old Papers";
        $text .= " [<a href='$fname?club=$club&status=0&sort_by=$sort_by'>Current papers</a>]";
        $text .= " [<a href='$fname?club=$club&status=$status_ignore&sort_by=$sort_by'>Ignored papers</a>]";
    } elseif ($paper_status == $status_ignore) {
        $text .= "Ignored Papers";
        $text .= " [<a href='$fname?club=$club&status=0&sort_by=$sort_by'>Current papers</a>]";
        $text .= " [<a href='$fname?club=$club&status=$status_read&sort_by=$sort_by'>Old  papers</a>]";
    } else {
        $status = '(ps.status is null || ps.status=0)';

        $text .= "Current Papers";
        $text .= " [<a href='$fname?club=$club&status=$status_read&sort_by=$sort_by'>Old  papers</a>]";
        $text .= " [<a href='$fname?club=$club&status=$status_ignore&sort_by=$sort_by'>Ignored papers</a>]";
    }
    $opposite_sort = ($sort_by == 'bookmark_date') ? 'paper_date' : 'bookmark_date';
    $sort_text = ($sort_by == 'bookmark_date') ? 'Sort by paper date' : 'Sort by bookmark date';
    $text .= " (<a href='{$fname}?club=$club&status=$paper_status&sort_by={$opposite_sort}'>$sort_text</a>)";
    $text .= "</h4><p class='genmed'>";

    if($paper_status > 0) {
        $status = "ps.status=$paper_status";
    }

    // Get bookmark data from MySQL first (without ARXIV_NEW join)
    // Original query selected: notes,n.arxiv_tag,n.title,n.authors,n.date,ac,who, bookdate
    $bookmark_sql = "select temp.arxiv_tag, temp.ac, temp.who, temp.notes, temp.bookdate, temp.book_id from
    (select b.arxiv_tag, count(*) as ac,group_concat(u.username order by u.username SEPARATOR '\n') as who,
    group_concat(IFNULL(b.note,'') order by u.username SEPARATOR '\n') as notes, MAX(b.bookmarked_date) AS bookdate,MAX(b.bookmark_id) AS book_id from bookmarks b,club_members as c,
    phpbb_users as u where b.club_id=$club and u.user_id=c.user_id and c.user_id=b.user_id and c.club_id=$club
    group by b.arxiv_tag) as temp left join club_paper_status as ps on (ps.arxiv_tag=temp.arxiv_tag and ps.club_id=$club)
    where $status LIMIT $startc,$maxrows";

    $bookmark_result = $db->sql_query($bookmark_sql);
    $bookmark_rows = $db->sql_fetchrowset($bookmark_result);
    $db->sql_freeresult($bookmark_result);

    // Merge with paper details from SQLite
    $rows = ArxivDatabase::mergeBookmarkWithPaperData($bookmark_rows, $arxiv_db);

    // Sort the merged results
    $sort_by_date = ($sort_by != 'bookmark_date');
    usort($rows, function($a, $b) use ($sort_by_date) {
        if ($sort_by_date) {
            // Sort by paper date DESC, then bookmark date DESC
            $date_cmp = strcmp($b['date'], $a['date']);
            if ($date_cmp !== 0) return $date_cmp;
            return strcmp($b['bookdate'], $a['bookdate']);
        } else {
            // Sort by bookmark date DESC, then paper date DESC
            $bookdate_cmp = strcmp($b['bookdate'], $a['bookdate']);
            if ($bookdate_cmp !== 0) return $bookdate_cmp;
            return strcmp($b['date'], $a['date']);
        }
    });

} else {
    $text .= '<p class="genmed">';
    $usercond = "user_id = $user_id and ";

    if($user_id == 'all') {
        $usercond = '';
        $countcond = $request->variable('min_count', 0);

        // For "all users" view, we need to handle date filtering differently
        // since we can't do cross-database joins. We'll get more data and filter in PHP.
        $having_clause = '';
        if ($countcond) {
            $having_clause = " having ac >= $countcond";
        }

        // Get a larger set of bookmark data to account for date filtering
        $fetch_limit = $top_months ? ($startc + $maxrows) * 3 : $maxrows;
        $bookmark_sql = "select b.arxiv_tag, count(*) as ac from bookmarks as b where 1=1 group by b.arxiv_tag $having_clause ORDER BY ac DESC LIMIT $fetch_limit";
        $bookmark_result = $db->sql_query($bookmark_sql);
        $bookmark_rows = $db->sql_fetchrowset($bookmark_result);
        $db->sql_freeresult($bookmark_result);

        // Merge with paper details from SQLite
        $all_rows = ArxivDatabase::mergeBookmarkWithPaperData($bookmark_rows, $arxiv_db);

        // Filter by date if needed
        if($top_months) {
            $cutoff_date = date('Y-m-d', strtotime("-$top_months months"));
            $all_rows = array_filter($all_rows, function($row) use ($cutoff_date) {
                return isset($row['date']) && $row['date'] >= $cutoff_date;
            });
        }

        // Sort results
        if($top_months) {
            // Sort by bookmark count DESC, then date DESC
            usort($all_rows, function($a, $b) {
                $ac_cmp = $b['ac'] - $a['ac'];
                if ($ac_cmp !== 0) return $ac_cmp;
                return strcmp($b['date'], $a['date']);
            });
        } else {
            // Sort by date DESC, then bookmark count DESC
            usort($all_rows, function($a, $b) {
                $date_cmp = strcmp($b['date'], $a['date']);
                if ($date_cmp !== 0) return $date_cmp;
                return $b['ac'] - $a['ac'];
            });
        }

        // Apply pagination after filtering and sorting
        $rows = array_slice($all_rows, $startc, $maxrows);

    } else {
        $catcond = "";
        $othertab = "";
        if(!empty($category)) {
            if($category == 'null') {
                $catcond = "pbt.tag_id is null and ";
            } else {
                $othertab = ", paper_bookmark_tags as pbt2";
                $catcond = "pbt2.tag_id = $category and b.bookmark_id = pbt2.bookmark_id and ";
            }
        }

        // Get bookmark data from MySQL (without ARXIV_NEW join)
        $bookmark_sql = "select group_concat(pbt.tag_id) as book_tags,b.bookmark_id,b.note,b.arxiv_tag,
        j.shortname,b.club_id, count(*) as ac from (bookmarks as b$othertab) left join journal_clubs as j on (b.club_id=j.club_id) left join paper_bookmark_tags as pbt on (pbt.bookmark_id=b.bookmark_id)
        where $usercond $catcond 1=1 group by b.arxiv_tag,pbt.bookmark_id LIMIT $startc,$maxrows";

        $bookmark_result = $db->sql_query($bookmark_sql);
        $bookmark_rows = $db->sql_fetchrowset($bookmark_result);
        $db->sql_freeresult($bookmark_result);

        // Merge with paper details from SQLite
        $rows = ArxivDatabase::mergeBookmarkWithPaperData($bookmark_rows, $arxiv_db);

        // Sort results
        usort($rows, function($a, $b) use ($addref, $user_id) {
            // Priority sort for newly added bookmark
            if(!empty($addref) && $user_id > 1) {
                if ($a['arxiv_tag'] === $addref && $b['arxiv_tag'] !== $addref) return -1;
                if ($b['arxiv_tag'] === $addref && $a['arxiv_tag'] !== $addref) return 1;
            }
            // Then by date DESC, then by bookmark count DESC
            $date_cmp = strcmp($b['date'], $a['date']);
            if ($date_cmp !== 0) return $date_cmp;
            return $b['ac'] - $a['ac'];
        });

    }
}

// $rows is now populated by the new logic above

foreach($rows as $row) {
    $count = $row['ac'];
    $tag = $row['arxiv_tag'];
    $date = $row['date'];
    $bookmark_id = $row['bookmark_id'] ?? '';

    if(isset($do_export)) {
        $types = explode(",", $do_export);
        $txt = '';

        foreach ($types as $type){
            if($txt != '') $txt .= $separator;
            if($type == 'arxiv') {
                $txt .= "$tag";
            } elseif($type == 'pdf') {
                $txt .= "https://arxiv.org/pdf/$tag";
            } elseif($type == 'date') {
                $txt .= $date;
            } elseif ($type == 'authors') {
                $txt .= $row['authors'];
            } elseif ($type == 'title') {
                $txt .= $row['title'];
            } elseif ($type == 'tags') {
                $tags = explode(',', $row['book_tags']);
                $tagtxt='';
                if(!empty($tags)) {
                    foreach($tags as $btag) {
                        if($tagtxt != '') $tagtxt .= ';';
                        $tagtxt .= $bookmark_tags[$btag];
                    }
                }
                $txt .= $tagtxt;
            } elseif ($type == 'note') {
                $txt .= $row['note'];
            } 
        }
        $text .= trim($txt).'<br>';
        continue;
    }

    $text .=  '<a name="'.$tag.'"></a><p class="postbody2">'. "$date " . '<a href="/discuss/' . $tag . '">'. $tag .  '</a> ';

    if($user_id == 'all') {
        $text .= "[$count] ";
    }

    if($user_id != 'all' && $club < 0) {
        $text .= '[<a href="/'.$fname.'?delete='.$tag.'">X</a>] ';
    }

    $text .=  '[<a href="https://arxiv.org/pdf/' .$tag. '">PDF</A>]';
    $pdfs = "https://arxiv.org/pdf/$tag\n";

#    if(!defined('IPHONE')) {
#        $text.=' [<a href="https://arxiv.org/ps/' .$tag.'">PS</A>]';
#    }
    if($user_id == 'all' && $canchange) {
        $text .= " [<a href=\"/bookmark.php?add=$tag\">Bookmark</a>]";
    }
    if($club < 1 && $hasclubs && $user_id != 'all') {
        $text .= ' Club: ';
        $paper_club = $row['club_id'];
        if($paper_club > 0) {
            $text .= ' '. $row['shortname'] . " [<a href=\"$fname?noclub=$tag\">Clear</a>]";
        } else {
            for($i = 1; $i <= count($clubs_id); $i++) {
                $text .= "<a href=\"$fname?paper=$tag&addclub=".$clubs_id[$i]."\">add to  ".$clubs_shortname[$i]."</a> ";
            }
        }
    }
    if($isadmin == 1 && $paper_status == 0) {
        $text .= " [<a href=\"$fname?club=$club&change_status=$tag&flag=$status_read\">Mark old</A>] [<a href=\"$fname?club=$club&change_status=$tag&flag=$status_ignore\">Ignore</A>]";
    }
    if($isadmin == 1 && $paper_status > 0 ) {
        $text .= " [<a href=\"$fname?club=$club&change_status=$tag&flag=0\">Make current</A>]";
    }
    $text .= '<br /><b>Title:</b> ' . $row['title'].'<br /><b>Authors:</b> ' . $row['authors'] ;

    if(!empty($row['who'])){
        $people = explode("\n", $row['who']);
        $notes = explode("\n", $row['notes']);
        $text .= '<br /><span class="gensmall">';
        for($i = 0; $i < count($people); $i++) {
           $text .= $people[$i];
           if($notes[$i] != '') {
               $text .= ' [Note: ' .$notes[$i] .']<br />' ;
           } elseif ($i < count($people)-1) {
               $text .= ', ';
           }
        }
        $text .= '</span>'; 
        if (!is_null($row['bookdate'])) {
            $text .= ' (' . date("Y-m-d", strtotime($row['bookdate'])) . ')';
         }       
    }

    if($club < 0 && $canchange == 1 && $user_id != 'all') {
        $note = $row['note'];
        $tagtxt = '';

        if(!empty($row['book_tags'])) {
            $tags = explode(',',$row['book_tags']);
            $tagtxt = '';

            if(!empty($tags)) {
                foreach($tags as $btag) {
                    if ($tagtxt <>'') $tagtxt.=', ';

                    $tagtxt .=  $bookmark_tags[$btag] .
                    " [<A hREF=\"$fname?book_id=$bookmark_id&deltag=$btag&category=$category&editnote=".($HTTP_GET_VARS['editnote'] ?? '')."#$tag\">X</A>]";
                }
            }
            $tagtxt="<br /><span  class=\"genmed\"><font color=\"navy\">Tag: $tagtxt</font></span>";
        }

        if($editnote == 1 || $addref == $tag || $paper == $tag) {
            $text .= $tagtxt;

            $text .= '<form method="post" action="'."$fullfname#$tag".'" TARGET="_top"><SPAN class="genmed">Note: </SPAN>
            <input class="post" type="text" name="note" size="50" maxlength="255" value="'.$note.'">
            <input type="hidden" name="notepaper" value="'.$tag.'">';

            if(!empty($bookmark_tags)) {
                $text .= '<SPAN class="genmed">Add tags: </SPAN><select name="add_book_tag"><option value="none" selected></option>'.$category_sel.'</select> <select name="add_book_tag2"><option value="none" selected></option>'.$category_sel.'</select>';
                $text .= '<input type="hidden" name="book_id" value="'.$bookmark_id.'">';
            }

            if(!empty($category)) {
                $text .= '<input type="hidden" name="category" value="'.$category.'">';
            }
            $text.=' <input type="submit" value="Save" class="button"></form>';

        } else {
            $tagtxt .= " <span class=\"genmed\"><A HREF=\"".makeUrl($fname, $request->server('QUERY_STRING'), "deltag=&book_id=&paper=$tag#$tag") . "\">+</A>";

            if(empty($row['book_tags'])) {
                $tagtxt = '<br />'.$tagtxt;
            }
            $text .= $tagtxt;

            if(!empty($note)) {
                $text.="<br />Note: $note";
            }
        }
    }

    $text.= '</p>';
}

if($club >= 0) {
    $status = "&club=$club&status=$paper_status";
} else {
    $status = '&user_id='.$user_id;
    if(!empty($category)) {
        $status .= "&category=$category";
    }
}

$text .= '<table width="100%">';
$text .= '<tr>';
$text .= '<td class ="genmed">';

if(count($rows) == $maxrows) {
    $text .= '<p>[<a href ="/'.$fname.'?start=' . ($startc + $maxrows) .$status .'">Next '.$maxrows.'</a>]</p>';
}

if($startc > 0){
    $text .= '<p>[<a href ="/'.$fname.'?start=' . ($startc - $maxrows) .$status . '">Previous '.$maxrows.'</a>]</p>';
}

$text .= '</td>';
$text .= '<td  class ="genmed" align="right">';

$text .= 'Export List: [<a href ="?export=pdf'.$status.'">PDFs</a>]';
$text .= ' [<a href ="?export=arxiv'.$status.'">IDs</a>]';
$text .= ' [<a href ="?export=arxiv,date,pdf,tags,note'.$status.'">All</a>]';

$text .= '</td>';
$text .= '</tr>';
$text .= '</table>';





page_header($page_title);
$template->set_filenames(array(
    'body' => 'message_body.html',
));

$template->assign_vars(array(
    'MESSAGE_TEXT'	=> $text,
    'MESSAGE_TITLE'	=> $inner_page_title
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();


function get_arXiv_ref_html() {
    global $request;
    return '<center>
                <form method="get" action="' . $request->server('SCRIPT_NAME') . '" TARGET="_top">
                    <span class="genmed">Bookmark arXiv ref: </span>
                    <input class="post" type="text" name="add" size="18" maxlength="40" value="">
                    <input type="submit" value="Add" class="button">
                </form>
            </center>
            <hr>';
}

function makeUrl($path, $qs = false, $qsAdd = false) {
    $var_array = array();
    $varAdd_array = array();
    $url = $path;

    if($qsAdd) {
        $varAdd = explode('&', $qsAdd);
        foreach($varAdd as $varOne) {
            $name_value = explode('=', $varOne);
            $varAdd_array[$name_value[0]] = $name_value[1];
        }
    }

    if($qs) {
        $var = explode('&', $qs);
        foreach($var as $varOne) {
            $name_value = explode('=', $varOne);

            //remove duplicated vars
            if($qsAdd) {
                if(!array_key_exists($name_value[0], $varAdd_array)) {
                    $var_array[$name_value[0]] = $name_value[1];
                }
            } else {
                $var_array[$name_value[0]] = $name_value[1];
            }
        }
    }

    //make url with querystring
    $delimiter = "?";

    foreach($var_array as $key => $value) {
        $url .= $delimiter.$key."=".$value;
        $delimiter = "&";
    }

    foreach($varAdd_array as $key => $value) {
        $url .= $delimiter.$key."=".$value;
        $delimiter = "&";
    }

    return $url;
}




