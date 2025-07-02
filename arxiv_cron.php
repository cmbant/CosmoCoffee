<?php


define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_admin.' . $phpEx);

anti_hack($phpEx);

#error_reporting(E_ALL); // Report all PHP errors
#ini_set('display_errors', 1); // Display all errors on the web page



$date = '';
$firstpaper = true;
$arxiv = '';

do_arxiv('astro-ph');
do_arxiv('hep-ph');
do_arxiv('hep-th');
do_arxiv('gr-qc');

if (!empty($date)) {
    $sql = "update phpbb_config set config_value = '$date' where config_name = 'arxiv_new_date'";
    if (!$db->sql_query($sql)) {
        print( 'Error adding new date');
    }
}
do_arxiv('quant-ph');
do_arxiv('physics');
do_arxiv('math');
do_arxiv('math-ph');
do_arxiv('hep-ex');
do_arxiv('cs');
do_arxiv('stat');

delete_forum_cache();


function do_arxiv($in) {
    global $date, $arxiv;

    $arxiv = $in;

    $url = "http://arxiv.org/list/$arxiv/new";
    $html = get_url($url);
 
    $parts = explode('<h3>', $html, 5);
  
    if (preg_match('#new listings for.*?(\d+ \w* \d*)#is', $parts[1], $date_file)) {

        $adate = date("Y-m-d", strtotime($date_file[1]));

        if ($date && $adate < $date) {
            return;
        }

        print "$arxiv ".$adate;

        $date = $adate;

        $posts = $parts[2];

       if (preg_match('#.*Cross submissions#is', $parts[3])) {
            $rest = $parts[4];
        } else {
            $rest = $parts[3];
        }

        do_section($posts, false);
   
        if (preg_match('#.*?Replacement submissions.*?(\<dt\>.*?)\<\/dl#is', $rest, $parts)) {
   
            $replace = $parts[1];
            do_section($replace, true);
        }

    } else {
        print ("no match: $url\n");
    }
}

function do_section($chunk, $isreplace) {
    $match_count = preg_match_all("#\<DT\>(.*?)\<\/DD\>#is", $chunk, $matches);

    for ($i = 0; $i < $match_count; $i++) {
        $post = $matches[0][$i];
        parse_post($post, $isreplace);
    }
}

function parse_post($post, $isreplace) {
    global $db, $date, $firstpaper, $arxiv;

    if ($isreplace) {
#        $match = '#arxiv:(.*?)<\/a.*?Title\:.*?\>\s*(.*?)\<.*?Authors\:.*?\>\s*(.*?)\<\/div(.*?\<\/div)#is';
         $match = '#arxiv:(.*?)<\/a.*?Title\:.*?\>\s*(.*?)\<.*?\<div class=.list\-authors.\>\s*(.*?)\<\/div.*?(.*?<\/div\>)#is';
} else {
#        $match = '#arxiv:(.*?)<\/a.*?Title\:.*?\>\s*(.*?)\<.*?Authors\:.*?\>\s*(.*?)\<\/div(.*?\<\/div).*?\<p .*?\>(.*?)\<\/p#is';
         $match = '#arxiv:(.*?)<\/a.*?Title\:.*?\>\s*(.*?)\<.*?\<div class=.list\-authors.\>\s*(.*?)\<\/div.*?(<div.*?<\/div\>).*?\<p.*?\>\s*(.*?)\s*\<\/p#is';
    }

    if (preg_match($match, $post, $ref)) {

        $formats = trim($ref[1]);
        $title = doclean($ref[2]);

        $authors = $ref[3];
        $authors = preg_replace("'\<[\/\!]*[^\<\>]*?\>'si", "", $authors);
        $authors = doclean($authors);
        
        $extra = $ref[4];
        
        if ($isreplace) {
            $abstract = '';
        } else{
        $abstract = preg_replace('#\<a href\s*=\s*\"(.*?)\".*?\>\s*this https? URL\s*\<\/a\s*\>#is', '\\1', $ref[5]);
        $abstract = preg_replace("'\<[\/\!]*?[^\<\>]*?\>'si", "", $abstract);
        $abstract = doclean($abstract);
        }
#print "$authors\n$title\n$abstract\n$extra\n\n";
#exit;

        if (preg_match('#Comments:.*?\>\s*(.*?)\<\/div#is', $extra, $ref)) {
            $comments = $ref[1];
            $comments = preg_replace('#\<a href\s*=\s*\"([^\"]*?)\"\>\s*this https? URL\s*\<\/a\s*\>#is', '\\1', $comments);
 	    $comments = doclean(preg_replace('#\<[\/\!]*?[^\<\>]*?\>#si', '', $comments));
	} else {
            $comments = '';
        }

#print "$authors\n$title\n$abstract\n$comments\n\n";
#exit;



        //if (preg_match('#\/abs\/([0-9a-zA-Z\.\-\/]*)#s',$formats,$ref)){
        if (true) {
            $arxiv_tag = $formats;
            $number = $arxiv_tag;

            if ($firstpaper && !$isreplace) {
                $firstpaper = false;
                $sql = "select arxiv_tag from ARXIV_NEW where arxiv_tag ='" . $arxiv_tag . "';";
                if (!$db->sql_query($sql)) {
                    print( 'Error looking old');
                }
            }
##	    $title = (strlen($title) > 255) ? substr($title,0,252).'...' : $title;		

            if ($isreplace) {
                $sql = "REPLACE INTO ARXIV_REPLACE (arxiv_tag, date, arxiv, number,title,authors,comments) values" .
                    " ('$arxiv_tag','$date','$arxiv','$number','$title','$authors','$comments');";
	#	    echo $sql; exit;
            } else {
	        
                $sql = "REPLACE INTO ARXIV_NEW (arxiv_tag, date, arxiv, number,title,authors,comments,abstract) values" .
                    " ('$arxiv_tag','$date','$arxiv','$number','$title','$authors','$comments','$abstract');";
#                 echo $sql;   
}
            if (!$db->sql_query($sql)) {
                print( 'Error in adding paper to db');
            }
//print ("$arxiv_tag\n$formats\n$title\n$authors\n$comments\n$abstract"); 
        } else {
            print("arxiv tag fail\n");
        }
    } else {
        print("Post fail match\n");
        exit;
    }
}


function doclean($text) {
  # echo $text;
    $text = preg_replace('/(\s)\s+/s', '$1', $text);
    $text = preg_replace('/\<\/b\>/is', '', $text);
   # $text = iconv("utf-8", "ascii//ignore", $text);
 
    $text = clean_sql($text);
    return $text;
}

function delete_forum_cache() {
    global $config, $cache, $phpbb_container, $auth, $phpbb_log, $db;
        
    $config->increment('assets_version', 1);
    $cache->purge();

    // Remove old renderers from the text_formatter service. Since this
    // operation is performed after the cache is purged, there is not "current"
    // renderer and in effect all renderers will be purged
    $phpbb_container->get('text_formatter.cache')->tidy();

    // Clear permissions
    $auth->acl_clear_prefetch();
    phpbb_cache_moderators($db, $cache, $auth);
    
    $phpbb_log->add('admin', ANONYMOUS, '', 'LOG_PURGE_CACHE');
}
