<?php

function anti_hack($phpEx) {
    global $request;

    if (strpos($request->server('REQUEST_URI'), "eval(") ||
        strpos($request->server('REQUEST_URI'), "CONCAT") ||
        strpos($request->server('REQUEST_URI'), "UNION+SELECT") ||
        strpos($request->server('REQUEST_URI'), "base64")) {
        redirect(append_sid("/index.$phpEx"));
    }
}

function get_username_by_id($user_id) {
    global $db;

    $result = $db->sql_query("SELECT username FROM phpbb_users WHERE user_id = " . (int) $user_id . " LIMIT 1");
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return ($row) ? $row['username'] : false;
}

/**
 * - Goes through the given string, and replaces xxxx://yyyy with an HTML <a> tag linking
 * 	to that URL
 * - Goes through the given string, and replaces www.xxxx.yyyy[zzzz] with an HTML <a> tag linking
 * 	to http://www.xxxx.yyyy[/zzzz]
 * - Goes through the given string, and replaces xxxx@yyyy with an HTML mailto: tag linking
 * 		to that email address
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
        $ret = preg_replace("~<a .*?href=[\'|\"]mailto:(.*?)[\'|\"].*?>.*?</a>~", "[<FONT COLOR=\"FF0000\">Log in to view email</FONT>]", $ret);
//        $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1[<FONT COLOR=\"FF0000\">Log in to view email</FONT>]", $ret);
    } else {
        $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
    }

    //astro-ph etc
    $ret = preg_replace("#(?<![\[\/\"])\b([ampncqhg][a-zA-Z\.\-]{3,}/[0-9v]{6,9})\b#i", "<a href=\"/discuss/\\1\" target=\"_blank\">\\1</a>", $ret);
    $ret = preg_replace("#(?<![\[\/\"\.\-a-z0-9;])\b(?:arxiv\:)?([0-9]{4,4}\.[0-9]{4,5}(v.)?)\b#i", "<a href=\"/discuss/\\1\" target=\"_blank\">\\1</a>", $ret);
    $ret = preg_replace("#\[([a-z][a-zA-Z\.\-]{3,}/[0-9v]{6,9})\]#i", "[<a href=\"/arxivref.php?abs=\\1\" target=\"_blank\">\\1</a>]", $ret);
    $ret = preg_replace("#\[(?:arxiv\:)?([0-9]{4,4}\.[0-9]{4,5}(v.)?)\b]#i", "[<a href=\"/arxivref.php?abs=\\1\" target=\"_blank\">\\1</a>]", $ret);
    $ret = preg_replace("#(http://[^\s]*)\&minus;#", "\\1-", $ret);

    // Remove our padding..
    $ret = substr($ret, 1);
    
    // http://cosmocoffee.info/files/Antony_Lewis/nT.png
    $ret = preg_replace('/http:\/\/cosmocoffee.info\/files\/(.[^\'"]+)/', '/cosmo_files.php?file=\\1', $ret);

    return simpletex($ret);
}

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}

function get_match_strings(array $keywords) {
    $match_str = '';
    $neg_match = '';

    foreach ($keywords as $keyword) {
        if ($keyword) {
            if (substr($keyword, 0, 1) === '-') {
                $neg_match .= substr($keyword, 1) . '|';
            } else {
                $match_str .= $keyword . '|';
            }
        }
    }

    if (!empty($match_str)) {
        $match_str = '#\b(' . trim($match_str, '|') . ').*?\b#is';
    }
    if (!empty($neg_match)) {
        $neg_match = '#\b(' . trim($neg_match, '|') . ')#is';
    }

    return [
        'match_str' => $match_str,
        'neg_match' => $neg_match
    ];
}

function arxiv_tex($text) {
    $realtex = false;

    if (!(strpos($text, '$') === false)) {
        $realtex = true;
        $text = preg_replace('/\$(.*?)\$/s', ' \$(\\1)\$ ', $text);
    }

    $text = preg_replace('/\b(?<!\\\)Omega/', '\\\Omega', $text);
    $text = preg_replace('/\b(?<!\\\)sigma/', '\\\sigma', $text);
    $text = preg_replace('/(?<!\\\)Lambda\b/', '\\\Lambda', $text);

    $text = str_replace('\\it', '', $text);
    $text = str_replace(array('+/-', '+-'), '&plusmn;', $text);
    $text = str_replace(array('~&lt;', '&lt;~'), '\alt', $text);
    $text = str_replace(array('~&gt;', '&gt;~'), '\agt', $text);
    $text = str_replace('&lt;&lt;', '\\ll ', $text);
    $text = str_replace('&gt;&gt;', '\\gg ', $text);
    $text = simpletex_noBB($text, $realtex);
    $text = str_replace(array('\\rm', '\\emph', '\\em'), '', $text);

    if ($realtex) {
        $text = preg_replace('/ \$\((.*?)\)\$ /s', '\\1', $text);
    }

    return $text;
}

function simpletex_noBB($text, $realtex = false) {
    //Replace A_a, \greek etc with html
    //Remove things that look like URLs, input_parameters, etc
    // \sch\"odinger etc
    
    if (
        preg_match('/\$/', $text) ||
        preg_match('/\[tex\]/', $text) ||
        preg_match('/\[latex\]/', $text) ||
        preg_match('/\[math\]/', $text) ||
        preg_match('/\\\\begin{equation}/', $text) ||
        preg_match('/\\\\end{equation}/', $text) ||
        preg_match('/\\\\label{[0-1]+}/', $text)
    ) {
        return $text;
    }
    
    $text = tex_accents($text);

    $specs = array('\\\\', '\\{', '\\}', '\\^', '\\_', '\\$', '^\\circ', '^{\\circ}', '\Lambda CDM');
    $html = array('&#92;', '&#123;', '&#125;', '&#94', '&#95;', '$', '&deg;', '&deg;', '&Lambda;CDM');

    $text = str_replace($specs, $html, $text);

    //Subscripts
    $text = preg_replace('/_\{([^\}]{1,30}?\{[^\{]{0,30}?\}[^\{]{0,30}?|[^\{]{1,30}?)\}/', '<span class="texhtml"><sub>{$1}</sub></span>', $text);

    if ($realtex === true) {
        $text = preg_replace('/_(\\\[a-zA-Z]+|[^\{])/', '<span class="texhtml"><sub>$1</sub></span>', $text);
    } else {
        $text = preg_replace('/(\\\[a-zA-Z]+|[^a-zA-Z%\/][A-Za-z]|[ ;\)]|\{\})_([\-0-9][0-9\.]*|[^\{]{1,10}?)(?=(\W|$))/S', '$1<span class="texhtml"><sub>$2</sub></span>', $text);
    }

    //Superscripts
    $text = preg_replace('/\^\{([^\}]{1,30}?\{[^\{]{0,30}?\}[^\{]{0,30}?|[^\{]{1,30}?)\}/', '<span class="texhtml"><sup>{$1}</sup></span>', $text);
    if ($realtex === true) {
        $text = preg_replace('/\^(\\\[a-zA-Z]+|[^\{])/', '<span class="texhtml"><sup>$1</sup></span>', $text);
    } else {
        $text = preg_replace('/\^\(([^\(]{1,30}?)\)/', '<span class="texhtml"><sup>({$1})</sup></span>', $text);
        $text = preg_replace('/\^([\-0-9][0-9\.]*|[^\{]{1,10}?)(?=(\W|$))/', '<span class="texhtml"><sup>$1</sup></span>', $text);
    }

    //texify things in {}, but not \rm{} etc,\frac{}{}
    $text = preg_replace_callback('/(?<![a-zA-Z]{2})(?<!\})\{((?!\\\(it|rm|sc|text))[^\{]{1,30}?)\}/', "mathItalic", $text);

    //Single maths letters
    $text = preg_replace('/\b([b-zB-HJ-Z]\b|A(?<![\.\?\"\!\:] .|[\.\?\"\!]  .|\n.))(?<=[\s=>\+\-\/\)\[\(,~].|&[gl]t;.)(?<!\<\/.)(?=([ \\\\&<~,\^=\+\-\/\)\(]|\W\W))(?!(\-(ray|mail)|&.(gra|acu|circ|tild|uml)))/', '<span class="texit">$1</span>', $text);
    $text = preg_replace('/([\s=>\+\-\/\)\[\(~]|&[gl]t;)([b-zB-HJ-Z]|(?<![\.\?\"\!\:] |[\.\?\"\!]  |\n)A)(?=([ \\\\&<_~\^=\+\-\/\)\(]|\W\W))(?!(\-ray|&.(uml|gra|acu|circ|tild|uml)))/', '$1<span class="texit">$2</span>', $text);
    $text = preg_replace('/\b([aI])(?<=[=>\+\-\/\)\(\[ \n\|].)(?<!\<.|\<\/.|(in|of) a)\b(?=! \\rm)(?=([\&<_\^=\+\-\/\)\(]|\W(?!&quot)[^\"\w\<`\' ]))/', '<span class="texit">$1</span>', $text);
    $text = preg_replace('/\\\(prime|euro|dagger|deg|eth|times|alpha|Alpha|beta|Beta|chi|Chi|delta|Delta|epsilon|Epsilon|eta|Eta|gamma|Gamma|iota|Iota|kappa|Kappa|lambda|Lambda|mu|Mu|nu|Nu|omega|Omega|omicron|Omicron|phi|Phi|pi|Pi|psi|Psi|rho|Rho|sigma|Sigma|sigmaf|tau|Tau|theta|Theta|upsilon|Upsilon|xi|Xi|zeta|Zeta|and|ang|asymp|cap|cong|cup|empty|equiv|exist|forall|ge|infin|isin|le|lowast|minus|nabla|ne|ni|notin|nsub|oplus|or|otimes|part|perp|prod|prop|radic|sub|sube|sup|supe)(?=(\W|\d|$))/', '<span class="texhtml">&$1;</span>', $text);

    // \a\b italic latex letters
    $text = preg_replace('/\\\(\w)(?=[\W_])/', '<span class="texit">$1</span>', $text);

    //Roman text
    $text = preg_replace('/\\\\(rm|text)\{([^\{]{1,30}?)\}/', '<span class="postbody2">$2</span>', $text);
    $text = preg_replace('/\{\\\\(rm|text) ([^\{]{1,30}?)\}/', '<span class="postbody2">$2</span>', $text);
    $text = preg_replace('/\{\\\\sc ([^\{]{1,30}?)\}/', '<span class="texsc">$1</span>', $text);

    //Caligraphic text
    $text = preg_replace('/\\\\mathcal\{([^\{]{1,30}?)\}/', '<span class="texcal">$1</span>', $text);

    // \bar
    $text = preg_replace('/\\\\bar\{([^\{]{1,30}?)\}/', '<span class="texbar">$1</span>', $text);

    // \emph
    $text = preg_replace('/\\\\emph\{([^\{]{1,30}?)\}/', '<I>$1</I>', $text);

    // \sqrt
    $text = preg_replace('/\\\\sqrt\{([^\{]{1,60}?)\}/', '&radic;($1)', $text);
    $text = preg_replace('/\\\\(exp|\%|s(in|ec)h?|co[st]h?|tanh?|l(og|n))(?=[^a-z])/', '<span class="postbody2">$1</span>', $text);
    $text = preg_replace('/\\\(l(l|esssim|angle)|ga|hbar|sum|a(lt|gt)|odot|g(g|t?r?sim)|ell|int|rangle)(?=([^a-zA-Z]|$))/', '<img class="tex" src="/png/$1.png">', $text);

    $texstrs = array('\arcsec', '\wedge', '\grad', '\~', '\simeq', '``', '\dots', '\quad', '\qquad', '\ ', '\pounds', '---', '--', '\circ', '\cdot', '\AA', '\sim', '\approx', '\geq', '\leq', '\infty', '\pm', '\propto', '\rightarrow', '\partial');
    $htmstrs = array("&Prime;", "&and;", "&nabla;", "~", "&asymp;", "&quot;", "&hellip;", "&nbsp;&nbsp;&nbsp;", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", "&nbsp;", "&pound;", "&mdash;", "&ndash;", "&deg;", "&middot;", "&Aring;", "~", "&asymp;", "&ge;", "&le;", "&infin;", "&plusmn;", "&prop;", "&rarr;", '&part;');

    $text = str_replace($texstrs, $htmstrs, $text);

    // \frac
    $text = preg_replace('/\\\\frac\{([^\{]{1,160}?)\}{([^\{]{1,160}?)\}/', '{($1)&frasl;($2)}', $text);

    //Use minus to prevent word-breaking
    $text = preg_replace('/\-(?=[0-9])/', '&minus;', $text);

    // Remaining {} contain nothing {} or stuff we can't easily process 
    $text = preg_replace('/\{([^\{]*?)\}/', '$1', $text);

    return $text;
}

function simpletex($text) {

//Coffee: first remove all [] tags..
//       $match_count = preg_match_all("#(\[tex.*?\[/tex.*?\])#si", $text, $matches);
    $match_count = preg_match_all("#\[(?!quote)([^\s]*?)(\=|\]).*?\[/\\1\]#s", $text, $matches);


    for ($i2 = 0; $i2 < $match_count; $i2++) {
        $str_to_match = $matches[0][$i2];
        $text = str_replace($str_to_match, 'ZTTEX' . $i2 . 'TEX', $text);
    }

    $text = simpletex_noBB($text);

//Put [tex] etc back

    for ($i2 = 0; $i2 < $match_count; $i2++) {
        $str_to_match = $matches[0][$i2];
        $text = str_replace('ZTTEX' . $i2 . 'TEX', $str_to_match, $text);
    }

    return $text;
}

function tex_accents($text) {
    $texstrs = array('\"' => 'uml', '`' => 'grave', '\'' => 'acute', '^' => 'circ', '~' => 'tilde', '&quot;' => 'uml');
    $text = preg_replace('/\\\([\'\"\`\^\~]|&quot;)[\{]?([oeaUOAINEuni])[\}]?/e', "'&\\2'.\$texstrs['\\1'].';'", $text);
    return $text;
}

function mathItalic($matches) {
    // two or more condescutive letters in {} that are not specials or parts of HTML tags 
    return preg_replace('/(?!\\\[a-zA-Z]*)(?![\/&\<\"][a-zA-Z]*[\"=;\>])(^|[^a-zA-Z])([A-Za-z]{2,})/', '$1<I>$2</I>', $matches[1]);
}

function to_array($string, $delimiter = ',') {
    $array = explode($delimiter, $string);
    return array_map(function($item) {
        return trim($item);
    }, $array);
}

function get_url($url) {
    $user_agent = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/125.5 (KHTML, like Gecko) Safari/125.9';

    $ch = curl_init();
    //curl_setopt( $ch, CURLOPT_PROXY, $proxy );
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    //curl_setopt( $ch, CURLOPT_COOKIEJAR, "c:\cookie.txt" );
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function clean_sql($str) {
    return addslashes(trim($str));
}

function coffee_validate_email($email) {
    global $db;

    $sql = "SELECT valid_domain FROM VALID_DOMAINS";
    if ($result = $db->sql_query($sql)) {
        if ($row = $db->sql_fetchrow($result)) {
            do {
                $match_email = str_replace('*', '.*?', $row['valid_domain']);
                if (preg_match('/^' . $match_email . '$/is', $email)) {
                    $db->sql_freeresult($result);
                    return false;
                }
            } while ($row = $db->sql_fetchrow($result));
        }
    }
    $db->sql_freeresult($result);

    return true;
}

// 1403.3985
// 1806.05022
// astro-ph/0311381
function prepare_post_subject_cosmocoffee($subject, $save_to_db = false) {
    $result = array(
        'subject' => $subject,
        'paper_id' => NULL
    );
    
    $arxiv_tag = is_arxiv_tag($subject) ? $subject : get_arxiv_tag_from_post_subject($subject);

    if ($arxiv_tag) {
        $arxiv_info = get_arxiv_paper_info($arxiv_tag);
        if ($arxiv_info) {
            $result['subject'] = '[' . $arxiv_info['tag'] . '] ' . $arxiv_info['title'];
            if ($save_to_db) {
                $result['paper_id'] = add_arxiv_paper_to_db($arxiv_info);
            }
        }
    }
    return $result;
}

function is_arxiv_tag($str) {
    if (preg_match('|^[a-z][a-zA-Z\.\-]{3,}/[0-9v]{6,}$|', $str) == 1 ||
        preg_match('|^(arxiv:)?[0-9]{4,4}\.[0-9]{4,5}(v.)?$|i', $str))
        return TRUE;
    else
        return FALSE;
}

function get_arxiv_tag_from_post_subject($subject) {
    $arxiv_tag = '';

    $found = preg_match('#^\[([a-z][a-zA-Z\.\-]{3,}/[0-9v]{6,})\]#i', $subject, $matches);
    if (!$found) {
        $found = preg_match('#^\[([0-9]{4,4}\.[0-9]{4,5})\]#i', $subject, $matches);
    }
    
    if ($found) {
        $arxiv_tag = $matches[1];
    }
    
    return $arxiv_tag;    
}

function get_arxiv_paper_info($arxiv_in) {

    $arxiv_tag = str_replace('arxiv:', '', $arxiv_in);
    $arxiv_tag = preg_replace("'arxiv\:'si", "", $arxiv_tag);
    $arxiv_tag = preg_replace("'v[1-9]'si", "", $arxiv_tag);

    $url = 'http://arxiv.org/abs/' . $arxiv_tag;
    $html = get_url($url);
    $info = array('url' => $url, 'tag' => $arxiv_tag, 'html' => $html);

    $found = preg_match('|Title:</span>(.*)<|sUi', $html, $matches);
    if (!$found)
        return FALSE;
    $info['title'] = $matches[1];

    $found = preg_match('|Authors:.*>(.*)<\/div>|isU', $html, $matches);
    if (!$found) {
#		$found = preg_match( '|Authors:(.*)<BLOCKQUOTE>|isU',
#			$html, $matches );
        if (!$found)
            return FALSE;
    }
    $raw_authors = $matches[1];
    // remove html tags
    $authors = preg_replace("'<[\/\!]*?[^<>]*?>'si", "", $raw_authors);
    $info['authors'] = $authors;

    $found = preg_match('|Abstract:.*>(.*)<\/BLOCKQUOTE>|isU', $html, $matches);

    if (!$found)
        return FALSE;
    $info['abstract'] = $matches[1];

    $found = preg_match('|Comments:.*/div>.*<div.*>(.*)<\/div|isU', $html, $matches);
    //if ( !$found ) return FALSE;
    $info['comments'] = $matches[1];

    return $info;
}

function add_arxiv_paper_to_db($arxiv_info) {
    global $db;
    $paper_id = false;

    $arxiv_tag = clean_sql($arxiv_info['tag']);
    $paper_authors = clean_sql(str_replace("\n", " ", $arxiv_info['authors']));
    $paper_title = clean_sql($arxiv_info['title']);
    $paper_url = clean_sql($arxiv_info['url']);
    $paper_abstract = clean_sql($arxiv_info['abstract']);
    $paper_comments = clean_sql($arxiv_info['comments']);

    if ($result = $db->sql_query("SELECT paper_id FROM phpbb_papers where arxiv_tag='$arxiv_tag'")) {
        if ($row = $db->sql_fetchrow($result)) {
            $sql = "UPDATE
                        phpbb_papers 
                    SET  
                        paper_authors = '$paper_authors', 
                        paper_title = '$paper_title', 
                        paper_url = '$paper_url', 
                        paper_abstract = '$paper_abstract', 
                        paper_comments = '$paper_comments'
                    WHERE 
                        paper_id = {$row['paper_id']}";
        } else {
            $sql = "INSERT INTO
                        phpbb_papers (arxiv_tag, paper_authors, paper_title, paper_url, paper_abstract, paper_comments) 
                    VALUES 
                        ('$arxiv_tag', '$paper_authors', '$paper_title', '$paper_url', '$paper_abstract', '$paper_comments')";
        }
        $db->sql_freeresult($result);
        if (!$result = $db->sql_query($sql)) {
            trigger_error('Error in saving paper to db');
        } else {
            $paper_id = isset($row['paper_id']) ? $row['paper_id'] : $db->sql_nextid();
        }
    }
    $db->sql_freeresult($result);

    arxiv_traceback($arxiv_tag);

    return $paper_id;
}

function arxiv_traceback($arxiv) {        
    $cosmoCoffeeUrl = 'http://cosmocoffee.info';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://arxiv.org/trackback/' . $arxiv);
//    $header[] = "Content-Type: application/x-www-form-urlencoded; charset=utf-8";
    $urlstring = "title=Discussion&url=$cosmoCoffeeUrl/discuss/$arxiv&blog_name=CosmoCoffee";
//    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'CosmoCoffee');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $urlstring);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_REFERER, "$cosmoCoffeeUrl");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    $result = curl_exec($ch);
    curl_close($ch);
}

function get_arxiv_view_links($ref) {
    if (!$ref)
        return false;

    $links = "<center>[<a target='_top' href='/arxiv_start.pl?$ref'>Discuss $ref</a>]&nbsp;&nbsp;";
    if ($user->data['user_id'] != ANONYMOUS) {
        $links .= "[<a target='_top' href='/bookmark.php?add=$ref'>Bookmark $ref</a>]&nbsp;&nbsp;";
    }
    $links .= "[<a target='_top' href='/bibtex.php?arxiv=$ref'>BibTex</a>]</center>";

    return $links;
}
