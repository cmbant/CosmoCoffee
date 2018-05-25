<?php 

date_default_timezone_set( "EST" );

define('IN_PHPBB', true);
define('EXT_ROOT_PATH', __DIR__ . '/');

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

include(EXT_ROOT_PATH . 'includes/functions_arxiv.'.$phpEx);
include(EXT_ROOT_PATH . 'includes/constants.'.$phpEx);


include($phpbb_root_path . 'includes/bbcode.'.$phpEx); //////////////////// ОЧЕНЬ ПОМЕНЯЛСЯ!!!!!!!!!!!!!!!!!

$scriptname = 'arxiv_new.php'; //////////////////// //////////////////// //////////////////// //////////////////// //////////////////// //////////////////// //////////////////// 

if (strpos($request->server('REQUEST_URI'), "eval(") ||      
  strpos($request->server('REQUEST_URI'), "CONCAT") ||
  strpos($request->server('REQUEST_URI'), "UNION+SELECT") ||
  strpos($request->server('REQUEST_URI'), "base64"))
{ 
    redirect(append_sid("/index.$phpEx"));
}

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if ($user->data['user_id'] == ANONYMOUS) { // something from old logic
//cache the un-logged-in version
//  include($phpbb_root_path . 'cache/latest_arxiv_new.html');
//  exit;
}


$user_id = $user->data['user_id'];


// set page title 
//$page_title = 'Arxiv New'; 
$text = '';


////////////////////////////////////////////////////////////////////

page_header('Arxiv New');



$match_str = '';
$neg_match = '';
$scores = array();
$items = array();
$arxive_arr = array();



$arxivesString = ($user->data['user_arxives']) ? $user->data['user_arxives'] : DEFAULT_ARXIVES;
$arxives = to_array($arxivesString);





function to_array($string, $delimiter = ',') { 
    $array = explode($delimiter, $string);
    return array_map(function($item) {
        return trim($item);
    }, $array);
}

$keywords = ($user->data['user_keywords']) ? $user->data['user_keywords'] : $config['default_arxiv_keys'];
$keywords = to_array($keywords);



$text = '';

if(!$user->data['user_arxives']) {
    $text .= '<p class="gen" style="text-align: center; color: #FF0000">Log in to use a customized arxiv and keyword list set in your profile.<br />You can then also make bookmarks and set up or join journal clubs.</p>';
}



$day_secs= (60 * 60 * 24);


$starttime = microtime_float();

$date = ($request->is_set('d')) ? $request->variable('d', '') : '';
$month = ($request->is_set('m')) ? $request->variable('m', 0) : '';
$year = ($request->is_set('y')) ? $request->variable('y', 0) : '';

$interval = ($request->is_set('i')) ? $request->variable('i', 0) : 1;
$interval = min(30, $interval);





$new_date = ($date) ? $date : $config['arxiv_new_date'];
$arxiv_latest = strtotime($config['arxiv_new_date']);

$newDate = new DateTime($new_date);   
$latestArxiv = new DateTime($config['arxiv_new_date']);

$date = strtotime($new_date);
$dateTimestamp = $newDate->getTimestamp();

if (!empty($month)){
    if (empty($year)) {
        $year = date("Y",$date);        
    }
    $date_str =  date("F Y", strtotime($year . '-' . $month));  
} else {
    $date_str =  date("l, jS F Y", $date);
    if($interval > 1) {
        $date_str = "$interval days to " . $date_str;        
    }
}

$text .= '<span class="gen" style="font-weight: bold;">Filtered abstracts for '. trim($orig_arxives) . ': '. $date_str . '</span><hr>';



    $m = date("m", $arxiv_latest);
    $y = date("Y", $arxiv_latest);

    $monthlinks = '';

    for($yr = 2007; $yr <= $y; $yr++) {
        $monthlinks .= '<p>'. $yr .': ';        
        for ($mn = 1; $mn <= 12 ; $mn++) {
            if($yr == $y && $mn > $m) break;
            $monthlinks .= '[<A HREF="' . $request->server('PHP_SELF') . '?y=' . $y . '&m=' . $mn . '">' . date('F', strtotime("$y-$mn")) . '</A>] ';
        }        
        $monthlinks .= '</p>';
    }

///////////////////////////
///////////////////////////
///////////////////////////

    

$links = ($interval > 1) ? '[<A HREF="' . $request->server('PHP_SELF') . '?d=' . $newDate->format('Y-m-d') . '">' . $newDate->format('j M') . '</A>] ' : '' ;

$dateDaysForLink = new DateTime($new_date);
for($i = 1; $i <= 7; $i++) {
    $dateDaysForLink->modify('-1 day');
    if($dateDaysForLink->format('w') === '0' || $dateDaysForLink->format('w') === '6') continue;
    
    $links .= '[<A HREF="' . $request->server('PHP_SELF') . '?d=' . $dateDaysForLink->format('Y-m-d') . '">' . $dateDaysForLink->format('j M') . '</A>] ';
}

if($latestArxiv > $newDate) { 
    $dateDaysForLink = new DateTime($new_date);
    
    for($i = 1; $i <= 7; $i++) {
        $dateDaysForLink->modify('+1 day');
        if($dateDaysForLink > $latestArxiv) break;   
        if($dateDaysForLink->format('w') === '0' || $dateDaysForLink->format('w') === '6') continue;

        $links .= '[<A HREF="' . $request->server('PHP_SELF') . '?d=' . $dateDaysForLink->format('Y-m-d') . '">' . $dateDaysForLink->format('j M') . '</A>] ';
    }
}

$dateDaysForLink = new DateTime($new_date);
if ($interval > 1) {
    $dateDaysForLink->modify("-$interval day"); 
}
$links .= '[<A HREF="' . $request->server('PHP_SELF') . '?i=7&d=' . $dateDaysForLink->format('Y-m-d') . '">Week to ' . $dateDaysForLink->format('jS M') .'</A>] ';

if ($user->data['user_id'] != ANONYMOUS) {
    $links .= '[<A HREF="' . BOOKMARK_LINK . '">Bookmarks</A>]';
}

if($latestArxiv == $newDate) { 
    ob_start();
?>
    <TABLE BORDER=0 CELLPADDING=0 WIDTH=100%>
        <TR>
            <TD class="genmed"><?= $links ?></TD>
            <TD align="right" class ="genmed">
                <?php foreach($arxives as $arxivItem): ?>                
                    [<A TARGET="_blank" HREF="http://arxiv.org/list/<?= $arxivItem ?>/new"><?= $arxivItem ?></A>]
                <?php endforeach; ?>
            </TD>
        </TR>
    </TABLE>
<?php    
    $links .= ob_get_clean();
}


///////////////////////////
///////////////////////////
///////////////////////////

$text .= $links; 
$text .= '<DL>'; 


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

$scores = [];
$items = [];

while($row = $db->sql_fetchrow($result)) {
    
echo "<hr>";

    $rowResult = print_relevant($row, false, $keywords, $arxives);
    if($rowResult) {
        $scores[] = $rowResult['score'];
        $items[] = $rowResult['item'];
    }
    
    
    var_dump($rowResult);  
}
echo "<hr>";
echo "<hr>";
echo "<hr>";
var_dump($scores);  
exit;









array_multisort($scores,SORT_NUMERIC ,SORT_DESC ,$items, SORT_STRING);

$text .= implode('',$items);
echo $text;
$text = '<DT><HR><H3>Replacements</H3></DT><HR>';
$items = array();
$scores = array();

//$sql = "SELECT * FROM ARXIV_REPLACE WHERE $date_range $arxiv_sql";
$sql = "SELECT phpbb_papers.paper_id,a.arxiv_tag,a.title,a.authors,a.comments FROM ARXIV_REPLACE as a left join phpbb_papers using(arxiv_tag) WHERE $date_range_replace $arxiv_sql";

if( !($result = $db->sql_query($sql)) )
{
        message_die(CRITICAL_ERROR, "Could not query replacement paper information", "", __LINE__, __FILE__, $sql);
}

while ( $row = $db->sql_fetchrow($result) )
{
  print_relevant($row, true);
}

array_multisort($scores,SORT_NUMERIC ,SORT_DESC ,$items, SORT_STRING);
$extime = (microtime_float() - $starttime);
$links .= "<P>$monthlinks</P>";
$links .= '<P><span class ="gensmall">Search time: '. number_format($extime, 3, '.', '') . ' seconds</span>';
$links .= '<BR><span class="gensmall">Papers matching: '. htmlspecialchars(implode(', ',$keywords)) .'</span>';

if ($user_id>1){
$links .= '<P><span class ="genmed">[<A HREF="/">CosmoCofee Home</A>] 
[<A HREF="/bookmark.php">Bookmarks</A>] 
[<A HREF="/search.php?search_id=newposts">New posts</A>] [<A HREF="/search.php?search_id=unanswered">Unanswered posts</A>]</span></P>';
 }
$text .= implode('',$items);
$text .= '</DL><HR>' . $links .'</span></TD></TR></TABLE></BODY></html>';

echo $text;

// standard page footer 
//include($phpbb_root_path . 'includes/page_tail.'.$phpEx); 

//////////////// functions ////////////////

function microtime_float() 
{ 
   list($usec, $sec) = explode(" ", microtime()); 
   return ((float)$usec + (float)$sec); 
} 




function print_relevant($row, $replace, array $keywords, array $arxives) {
    global $user;   
    
    $match_strings = get_match_strings($keywords);    
    
    $mirror = ($user->data['user_mirror']) ? $user->data['user_mirror'] : $config['default_mirror'];   

    
    
   

    
    $text = '';


    $title = preg_replace($match_strings['match_str'], '\rm{<span class="key">\\0</span>}', $row['title']);
    $authors = preg_replace($match_strings['match_str'], '\rm{<span class="key">\\0</span>}', $row['authors']);
    $abstract = ($replace) ? '' : preg_replace($match_strings['match_str'], '\rm{<span class="key">\\0</span>}', $row['abstract']);

    $addlen = 25; //////////

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
        $arxivSubject = $row['arxiv']; 
        
        $titleLinks = " [";        
        $titleLinks .= "<a href='http://$mirror/abs/$arxivTag' target='_blank'>abs</a>, ";
        $titleLinks .= "<a href='http://$mirror/pdf/$arxivTag'>pdf</a>";

        if(!defined('IPHONE')) {
            $titleLinks .= ", <a href='http://$mirror/ps/$arxivTag'>ps</a>] [<a href='/bibtex.php?arxiv=$arxivTag'>BibTex</a>] ";
        } else {
            $titleLinks .= "] ";  
        }

        if ($user->data['user_id'] != ANONYMOUS) {
            $titleLinks .= "[<a href='/bookmark.php?add=$arxivTag' target='_blank'>Bookmarks</a>]";
        }

        if($row['paper_id']) {
            $titleLinks .= " [<a href='/arxiv_start.pl?$arxivTag' target='_blank'>discuss</a>]";
        } else {
            $titleLinks .= " [<a href='/discuss/$arxivTag' target='_blank'>View discussion</a>]";
        }
        
        $text .= "<dt><h3 class='arxiv_title'><b>$arxivTag</b>$titleLinks</h3></dt>";
        
        $text .= "<dd>";
        $text .= '<b>Title:</b> '. arxiv_tex($title) .'<br>';        
        
        $authors = tex_accents($authors);
        $authors = preg_replace('#\\\rm\{(.+?)\}#s','\\1', $authors);        
        $text .= "<b>Authors:</b> $authors<br>";
        
        $comments = make_clickable_cosmocoffee($row['comments']);      
        $comments = preg_replace('#(\<a\s*href=.*?\>).*?(\<\/a)#is', '\\1this URL\\2', $comments);
        $comments = preg_replace('#\\\rm\{(.+?)\}#s','\\1', $comments);
        if($comments) {
            $text .= "<b>Comments:</b> $comments<br>";
        }
          
        if(!$replace) {
            $abs_matches = $abs_matches * 1000 / max(1000, strlen($abstract));
            $abstract = preg_replace('/\\\\cite\{([^\{]*?)\}/', '[$1]', $abstract);
            $abstract = arxiv_tex($abstract);
            $abstract = make_clickable_cosmocoffee($abstract);
            $text .= "<p class='postbody'>$abstract<br></p>";
        }
        $text .= "</dd>";
        
        return [
            'item' => $text,
            'score' => $tit_matches * 3 + $abs_matches + (count($arxives) - array_search($arxivSubject, $arxives)) * 3
        ];
    }
    return false;
}




////////////////////////////////////////////////////////////////











function get_match_strings(array $keywords) {
    $match_str = '';
    $neg_match = '';
    
    foreach ($keywords as $keyword) {
        if($keyword) {
            if(substr($keyword, 0, 1) === '-') {
                $neg_match .= substr($keyword, 1) . '|';
            } else {
                $match_str .= $keyword . '|';
            }
        }
    }    
    
    if(!empty($match_str)) {
        $match_str = '#\b(' . trim($match_str, '|') . ').*?\b#is';
    }    
    if(!empty($neg_match)) {
        $neg_match = '#\b(' . trim($neg_match, '|') . ')#is';
    }
    
    return [
        'match_str' => $match_str,
        'neg_match' => $neg_match
    ];
}


function arxiv_tex($text) {
    $realtex = false; 
    
    if (!(strpos($text,'$') === false) ) {
        $realtex = true; 
        $text = preg_replace('/\$(.*?)\$/s',' \$(\\1)\$ ', $text);
    } 
    
    $text = preg_replace('/\b(?<!\\\)Omega/','\\\Omega', $text);
    $text = preg_replace('/\b(?<!\\\)sigma/','\\\sigma', $text);
    $text = preg_replace('/(?<!\\\)Lambda\b/','\\\Lambda', $text);  

    $text = str_replace('\\it','', $text);
    $text = str_replace(array('+/-','+-'), '&plusmn;', $text);
    $text = str_replace(array('~&lt;','&lt;~'), '\alt', $text);
    $text = str_replace(array('~&gt;','&gt;~'), '\agt', $text);
    $text = str_replace('&lt;&lt;', '\\ll ', $text);
    $text = str_replace('&gt;&gt;', '\\gg ', $text);
    $text = simpletex_noBB($text, $realtex);
    $text = str_replace(array('\\rm','\\emph','\\em'), '', $text);
    
    if($realtex) {
        $text = preg_replace('/ \$\((.*?)\)\$ /s', '\\1', $text);
    }
    
    return $text;
}

// from /var/www/phpBB/test.cosmocoffee.loc/includes/Math.php
function simpletex_noBB($text, $realtex = false) {
    //Replace A_a, \greek etc with html
    //Remove things that look like URLs, input_parameters, etc
    // \sch\"odinger etc

    $text = tex_accents($text);
 
    $specs = array('\\\\','\\{','\\}','\\^','\\_','\\$','^\\circ','^{\\circ}','\Lambda CDM');
    $html = array('&#92;','&#123;','&#125;','&#94','&#95;','$','&deg;','&deg;','&Lambda;CDM');
    
    $text = str_replace($specs, $html, $text);

    //Subscripts
    $text = preg_replace('/_\{([^\}]{1,30}?\{[^\{]{0,30}?\}[^\{]{0,30}?|[^\{]{1,30}?)\}/', '<span class="texhtml"><sub>{$1}</sub></span>', $text);

    if($realtex === true) {
        $text = preg_replace('/_(\\\[a-zA-Z]+|[^\{])/' ,'<span class="texhtml"><sub>$1</sub></span>', $text);
    } else {
        $text = preg_replace('/(\\\[a-zA-Z]+|[^a-zA-Z%\/][A-Za-z]|[ ;\)]|\{\})_([\-0-9][0-9\.]*|[^\{]{1,10}?)(?=(\W|$))/S', '$1<span class="texhtml"><sub>$2</sub></span>', $text); 
    }

    //Superscripts
    $text = preg_replace('/\^\{([^\}]{1,30}?\{[^\{]{0,30}?\}[^\{]{0,30}?|[^\{]{1,30}?)\}/', '<span class="texhtml"><sup>{$1}</sup></span>', $text);
    if ($realtex === true){
        $text = preg_replace('/\^(\\\[a-zA-Z]+|[^\{])/' ,'<span class="texhtml"><sup>$1</sup></span>', $text);
    } else {
        $text = preg_replace('/\^\(([^\(]{1,30}?)\)/' ,'<span class="texhtml"><sup>({$1})</sup></span>', $text);
        $text = preg_replace('/\^([\-0-9][0-9\.]*|[^\{]{1,10}?)(?=(\W|$))/' ,'<span class="texhtml"><sup>$1</sup></span>', $text);
    }  

    //texify things in {}, but not \rm{} etc,\frac{}{}
    $text = preg_replace_callback('/(?<![a-zA-Z]{2})(?<!\})\{((?!\\\(it|rm|sc|text))[^\{]{1,30}?)\}/', "mathItalic", $text);

    //Single maths letters
    $text = preg_replace('/\b([b-zB-HJ-Z]\b|A(?<![\.\?\"\!\:] .|[\.\?\"\!]  .|\n.))(?<=[\s=>\+\-\/\)\[\(,~].|&[gl]t;.)(?<!\<\/.)(?=([ \\\\&<~,\^=\+\-\/\)\(]|\W\W))(?!(\-(ray|mail)|&.(gra|acu|circ|tild|uml)))/', '<span class="texit">$1</span>', $text);
    $text = preg_replace('/([\s=>\+\-\/\)\[\(~]|&[gl]t;)([b-zB-HJ-Z]|(?<![\.\?\"\!\:] |[\.\?\"\!]  |\n)A)(?=([ \\\\&<_~\^=\+\-\/\)\(]|\W\W))(?!(\-ray|&.(uml|gra|acu|circ|tild|uml)))/', '$1<span class="texit">$2</span>', $text);
    $text = preg_replace('/\b([aI])(?<=[=>\+\-\/\)\(\[ \n\|].)(?<!\<.|\<\/.|(in|of) a)\b(?=! \\rm)(?=([\&<_\^=\+\-\/\)\(]|\W(?!&quot)[^\"\w\<`\' ]))/' ,'<span class="texit">$1</span>', $text);
    $text = preg_replace('/\\\(prime|euro|dagger|deg|eth|times|alpha|Alpha|beta|Beta|chi|Chi|delta|Delta|epsilon|Epsilon|eta|Eta|gamma|Gamma|iota|Iota|kappa|Kappa|lambda|Lambda|mu|Mu|nu|Nu|omega|Omega|omicron|Omicron|phi|Phi|pi|Pi|psi|Psi|rho|Rho|sigma|Sigma|sigmaf|tau|Tau|theta|Theta|upsilon|Upsilon|xi|Xi|zeta|Zeta|and|ang|asymp|cap|cong|cup|empty|equiv|exist|forall|ge|infin|isin|le|lowast|minus|nabla|ne|ni|notin|nsub|oplus|or|otimes|part|perp|prod|prop|radic|sub|sube|sup|supe)(?=(\W|\d|$))/', '<span class="texhtml">&$1;</span>', $text);
  
    // \a\b italic latex letters
    $text = preg_replace('/\\\(\w)(?=[\W_])/', '<span class="texit">$1</span>', $text);

    //Roman text
    $text = preg_replace('/\\\\(rm|text)\{([^\{]{1,30}?)\}/', '<span class="postbody">$2</span>', $text);
    $text = preg_replace('/\{\\\\(rm|text) ([^\{]{1,30}?)\}/', '<span class="postbody">$2</span>', $text);
    $text = preg_replace('/\{\\\\sc ([^\{]{1,30}?)\}/' ,'<span class="texsc">$1</span>', $text);

    //Caligraphic text
    $text = preg_replace('/\\\\mathcal\{([^\{]{1,30}?)\}/', '<span class="texcal">$1</span>', $text);

    // \bar
    $text = preg_replace('/\\\\bar\{([^\{]{1,30}?)\}/', '<span class="texbar">$1</span>', $text);

    // \emph
    $text = preg_replace('/\\\\emph\{([^\{]{1,30}?)\}/', '<I>$1</I>', $text);

    // \sqrt
    $text = preg_replace('/\\\\sqrt\{([^\{]{1,60}?)\}/', '&radic;($1)', $text);
    $text = preg_replace('/\\\\(exp|\%|s(in|ec)h?|co[st]h?|tanh?|l(og|n))(?=[^a-z])/', '<span class="postbody">$1</span>', $text);
    $text = preg_replace('/\\\(l(l|esssim|angle)|ga|hbar|sum|a(lt|gt)|odot|g(g|t?r?sim)|ell|int|rangle)(?=([^a-zA-Z]|$))/', '<img class="tex" src="/png/$1.png">', $text);

    $texstrs = array('\arcsec','\wedge','\grad','\~','\simeq','``','\dots','\quad','\qquad','\ ','\pounds','---','--','\circ','\cdot','\AA','\sim','\approx','\geq','\leq','\infty','\pm','\propto','\rightarrow','\partial');
    $htmstrs = array("&Prime;","&and;","&nabla;","~","&asymp;","&quot;","&hellip;","&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;","&nbsp;","&pound;","&mdash;","&ndash;","&deg;","&middot;","&Aring;","~","&asymp;","&ge;","&le;","&infin;","&plusmn;","&prop;","&rarr;",'&part;');

    $text = str_replace($texstrs, $htmstrs, $text);

    // \frac
    $text = preg_replace('/\\\\frac\{([^\{]{1,160}?)\}{([^\{]{1,160}?)\}/', '{($1)&frasl;($2)}', $text);
 
    //Use minus to prevent word-breaking
    $text = preg_replace('/\-(?=[0-9])/', '&minus;', $text); 

    // Remaining {} contain nothing {} or stuff we can't easily process 
    $text = preg_replace('/\{([^\{]*?)\}/', '$1', $text);
           
    return $text;
} 

function tex_accents($text) {
    $texstrs = array('\"' => 'uml', '`'=>'grave', '\''=> 'acute', '^' => 'circ', '~'=> 'tilde', '&quot;'=> 'uml');
    $text = preg_replace('/\\\([\'\"\`\^\~]|&quot;)[\{]?([oeaUOAINEuni])[\}]?/e', "'&\\2'.\$texstrs['\\1'].';'", $text);
    return $text;
}


/**
 * - Goes through the given string, and replaces xxxx://yyyy with an HTML <a> tag linking
 * 	to that URL
 * - Goes through the given string, and replaces www.xxxx.yyyy[zzzz] with an HTML <a> tag linking
 * 	to http://www.xxxx.yyyy[/zzzz]
 * - Goes through the given string, and replaces xxxx@yyyy with an HTML mailto: tag linking
 *		to that email address
 * - Only matches these 2 patterns either after a space, or at the beginning of a line
 *
 * Notes: the email one might get annoying - it's easy to make it more restrictive, though.. maybe
 * have it require something like xxxx@yyyy.zzzz or such. We'll see.
 */
function make_clickable_cosmocoffee($text) {
    global $user;
    
	$text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);

	// pad it with a space so we can match things at the start of the 1st line.
	$ret = ' ' . $text;

	// matches an "xxxx://yyyy" URL at the start of a line, or after a space.
	// xxxx can only be alpha characters.
	// yyyy is anything up to the first space, newline, comma, double quote or <
	$ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);

	// matches a "www|ftp.xxxx.yyyy[/zzzz]" kinda lazy URL thing
	// Must contain at least 2 dots. xxxx contains either alphanum, or "-"
	// zzzz is optional.. will contain everything up to the first space, newline, 
	// comma, double quote or <.
	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);

	// matches an email@domain type address at the start of a line, or after a space.
	// Note: Only the followed chars are valid; alphanums, "-", "_" and or ".".
    if ($user->data['user_id'] == ANONYMOUS) {
        $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1[<FONT COLOR=\"FF0000\">Log in to view email</FONT>]", $ret);
    } else {  
        $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
    } 

    //astro-ph etc
    $ret = preg_replace("#(?<![\[\/\"])\b([ampncqhg][a-zA-Z\.\-]{3,}/[0-9v]{6,9})\b#i", "<a href=\"/discuss/\\1\" target=\"_blank\">\\1</a>", $ret);
    $ret = preg_replace("#(?<![\[\/\"\.\-a-z0-9;])\b(?:arxiv\:)?([0-9]{4,4}\.[0-9]{4,5}(v.)?)\b#i", "<a href=\"/discuss/\\1\" target=\"_blank\">\\1</a>", $ret);
    $ret = preg_replace("#\[([a-z][a-zA-Z\.\-]{3,}/[0-9v]{6,9})\]#i", "[<a href=\"/arxivref.php?abs=\\1\" target=\"_blank\">\\1</a>]", $ret);
    $ret = preg_replace("#\[(?:arxiv\:)?([0-9]{4,4}\.[0-9]{4,5}(v.)?)\b]#i", "[<a href=\"/arxivref.php?abs=\\1\" target=\"_blank\">\\1</a>]", $ret);
    $ret = preg_replace("#(http://[^\s]*)\&minus;#","\\1-",$ret);

	// Remove our padding..
	$ret = substr($ret, 1);

	return($ret);
}



