<?php

define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include_once($phpbb_root_path . 'includes/arxiv_db.' . $phpEx);

anti_hack($phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();
$user->get_profile_fields($user->data['user_id']);

$date = '';

// Initialize ArXiv SQLite database
$arxiv_db = new ArxivDatabase();

//do_arxiv('astro-ph');
//do_arxiv('hep-ph');
//do_arxiv('hep-th');
//do_arxiv('gr-qc');

arxiv_traceback('astro-ph/0209489');
arxiv_traceback('astro-ph/0211653');
arxiv_traceback('astro-ph/0305341');
arxiv_traceback('astro-ph/0307080');
arxiv_traceback('astro-ph/0311381');
arxiv_traceback('astro-ph/0401513');
arxiv_traceback('astro-ph/0405462');
arxiv_traceback('astro-ph/0406096');
arxiv_traceback('astro-ph/0406354');
arxiv_traceback('astro-ph/0407028');
arxiv_traceback('astro-ph/0408279');
arxiv_traceback('astro-ph/0408547');
arxiv_traceback('astro-ph/0409275');
arxiv_traceback('astro-ph/0409451');
arxiv_traceback('astro-ph/0409513');
arxiv_traceback('astro-ph/0409569');
arxiv_traceback('astro-ph/0409574');
arxiv_traceback('astro-ph/0409594');
arxiv_traceback('astro-ph/0409615');
arxiv_traceback('astro-ph/0409652');
arxiv_traceback('astro-ph/0409655');
arxiv_traceback('astro-ph/0409768');
arxiv_traceback('astro-ph/0410032');
arxiv_traceback('astro-ph/0410281');
arxiv_traceback('astro-ph/0410360');
arxiv_traceback('astro-ph/0410421');
arxiv_traceback('astro-ph/0410541');
arxiv_traceback('astro-ph/0410680');
arxiv_traceback('astro-ph/0411013');
arxiv_traceback('astro-ph/0411027');
arxiv_traceback('astro-ph/0411273');
arxiv_traceback('astro-ph/0411633');
arxiv_traceback('astro-ph/0411673');
arxiv_traceback('astro-ph/0411737');
arxiv_traceback('astro-ph/0412066');
arxiv_traceback('astro-ph/0412581');
arxiv_traceback('astro-ph/0501104');
arxiv_traceback('astro-ph/0501171');
arxiv_traceback('astro-ph/0501366');
arxiv_traceback('astro-ph/0501672');
arxiv_traceback('astro-ph/0502243');
arxiv_traceback('astro-ph/0503103');
arxiv_traceback('astro-ph/0503166');
arxiv_traceback('astro-ph/0503213');
arxiv_traceback('astro-ph/0503277');
arxiv_traceback('astro-ph/0503296');
arxiv_traceback('astro-ph/0503416');
arxiv_traceback('astro-ph/0504188');
arxiv_traceback('astro-ph/0504290');
arxiv_traceback('astro-ph/0504452');
arxiv_traceback('astro-ph/0505173');
arxiv_traceback('astro-ph/0505253');
arxiv_traceback('astro-ph/0505518');
arxiv_traceback('astro-ph/0506112');
arxiv_traceback('astro-ph/0506478');
arxiv_traceback('astro-ph/0506534');
arxiv_traceback('astro-ph/0507110');
arxiv_traceback('astro-ph/0507147');
arxiv_traceback('astro-ph/0507170');
arxiv_traceback('astro-ph/0507184');
arxiv_traceback('astro-ph/0507263');
arxiv_traceback('astro-ph/0507439');
arxiv_traceback('astro-ph/0507494');
arxiv_traceback('astro-ph/0507503');
arxiv_traceback('astro-ph/0507573');
arxiv_traceback('astro-ph/0508047');
arxiv_traceback('astro-ph/0508048');
arxiv_traceback('astro-ph/0508572');
arxiv_traceback('astro-ph/0508624');
arxiv_traceback('astro-ph/9812387');
arxiv_traceback('gr-qc/0410054   ');
arxiv_traceback('hep-ph/0505250  ');
arxiv_traceback('hep-th/0503117  ');
arxiv_traceback('physics/0506056 ');


function do_clean($text) {

    $text = str_replace("\n", ' ', $text);
    $text = clean_sql($text);
    return( $text);
}

function parse_post($post) {

    global $db, $date;

    $match = '#oai:arXiv.org:(.*?)\<.*?\<datestamp\>(.*?)\<\/.*?dc:title\>(.*?)\<\/.*?(\<dc:creator\>.*\<\/dc:creator\>).*?(\<dc:description\>.*\<\/dc:description\>).*?(\<dc:date\>.*\<\/dc:date\>)#s';

    if (preg_match($match, $post, $ref)) {
        $arxiv_tag = $ref[1];
        $datestamp = $ref[2];
        list($arxiv, $number) = explode('/', $arxiv_tag);
        $title = do_clean($ref[3]);
        $authors = $ref[4];
        $abstract = $ref[5];
        $date = $ref[6];

        $match_count = preg_match_all('#\<dc:creator\>(.*?)\<\/dc:creator\>#s', $authors, $matches);
        $authors = '';
        for ($i = 0; $i < $match_count; $i++) {
            $auth = trim($matches[1][$i]);
            $auth = preg_replace('#(.*), (.*)#', '\\2 \\1', $auth);
            if (!empty($authors)) {
                $authors .= ', ';
            }
            $authors .= $auth;
        }

        $authors = do_clean($authors);
        $comments = '';
        $match_count = preg_match_all('#\<dc:description\>(.*?)\<\/dc:description\>#s', $abstract, $matches);
        if (!$match_count) {
            return;
        }
        $abstract = do_clean($matches[1][0]);
        if ($match_count > 1) {
            if (preg_match('#Comment:\s*(.*)#is', $matches[1][1], $ref)) {
                $comments = do_clean($ref[1]);
            }
        }

        $match_count = preg_match_all('#\<dc:date\>(.*?)\<\/dc:date\>#s', $date, $matches);
        if (!$match_count) {
            return;
        }
        $date = $matches[1][0];
        $isreplace = ($match_count > 1);
        if ($match_count > 1) {
            $date = $matches[1][$match_count - 1];
        }

        $days = (strtotime($datestamp) - strtotime($date)) / (60 * 60 * 24);
        if ($days > 4 || $days < 1) {
            return;
        }

        if ($match_count == 1) {
            $date = $datestamp;
        }

        $adate = strtotime($date);
        $day = date("w", $adate);
        if ($day == '0') {
            $date = date('Y-m-d', $adate + (60 * 60 * 24));
        }
        if ($day == '6') {
            $date += date('Y-m-d', $adate + (60 * 60 * 24) * 2);
        }

//  print ("OK: $date\n$arxiv_tag\n$title\n$authors\n$comments\n$abstract\n\n");

        if ($isreplace) {
            if (!$arxiv_db->replaceArxivReplace($arxiv_tag, $date, $arxiv, $number, $title, $authors, $comments)) {
                print($date . ": Error in adding replacement paper to db\n");
            }
        } else {
            if (!$arxiv_db->replaceArxivNew($arxiv_tag, $date, $arxiv, $number, $title, $authors, $comments, $abstract)) {
                print($date . ": Error in adding new paper to db\n");
            }
        }
    } else {

        $match = '#<header status=\"deleted\".*?oai:arXiv.org:(.*?)\<#is';
        if (preg_match($match, $post, $ref)) {
            $arxiv_tag = $ref[1];
            $arxiv_db->deleteArxivNew($arxiv_tag);
            $arxiv_db->deleteArxivReplace($arxiv_tag);
        } else {
            echo "No match: $post\n\n";
        }
    }
}

function do_section($chunk) {

    $match_count = preg_match_all('#\<record>(.*?)\<\/record\>#s', $chunk, $matches);

    for ($i = 0; $i < $match_count; $i++) {
        $post = $matches[1][$i];
        parse_post($post);
    }
}

function do_arxiv($arxiv) {

    global $date;

    $from = '2005-04-01';
    $to = $from;
    $from_date = strtotime($from);

    while (1) {
        $url = "http://arxiv.org/oai2?verb=ListRecords&from=$from&set=physics:$arxiv&metadataPrefix=oai_dc";
        $html = get_url($url);
        if (preg_match('#^.*503\s*Retry#i', $html)) {
            echo "$from : Sleeping\n";
            exit;
            $now = date;
            while (date - $now < 60) {
                $i = tan(0.9);
            }
        } else {
            do_section($html);
            if (preg_match('#<resumptionToken>(.*?)\|(.*?)\|.*<\/resump#is', $html, $ref)) {
                $from = $ref[1];
                echo "Resume: " . $ref[1] . "\n";
            } else {
                return;
            }
        }
    }
}

