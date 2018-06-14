<?php

define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);

anti_hack($phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();
$user->get_profile_fields($user->data['user_id']);

$watches = array();

if (!($result = $db->sql_query("SELECT * FROM WATCHES"))) {
    trigger_error('Could not query watches information');
}

while ($row = $db->sql_fetchrow($result)) {
    $watches[$row['name']] = $row['md5'];
}

//AStro rumour mill

$url = "http://meltingpot.fortunecity.com/enfield/207/";
$html = get_url($url);

if (preg_match('/Faculty Positions(.*)General gossip/is', $html, $matches)) {
    $md5 = md5($matches[1]);

    if ($md5 != $watches['ast_rumour']) {
        $text = '';
        if (preg_match('/\<H2\>\s*(.*?news from.*?)\</is', $html, $matches)) {
            $text = $matches[1];
        }
        $subject = 'Astro rumour mill update';
        $message = "Astro rumour mill updated:\n\n" . "http://meltingpot.fortunecity.com/enfield/207/\n\n" . $text;
        add_post($subject, $message, 'ast_rumour', $md5, 8);
    }
}

//Lambda

$url = "http://lambda.gsfc.nasa.gov/outreach/whatsnew.cfm";
$html = get_url($url);
$id = 'lambda';
if (preg_match('/tableheader.*?\<tr.*?\<td.*?\<td.*?\>(.*?)\<\/td.*?(\d\d\-\w\w\w\-\d\d)/is', $html, $matches) && !
    preg_match('/There have been no recent changes to LAMBDA/', $html)) {
    $md5 = md5($matches[1]);
    if ($md5 != $watches[$id]) {
        $text = $matches[1];
        $text = str_replace('<br', "\n<br", $text);
        $text = preg_replace("'\<[\/\!]*?[^\<\>]*?\>'si", "", $text);
        $subject = 'LAMBDA update: ' . $matches[2];
        $message = "What's New on LAMBDA: " . $matches[2] . "\n\n" . "$url\n\n" . $text;
        add_post($subject, $message, $id, $md5, 4);
    }
}

function add_post($subject, $message, $name, $md5, $forum_id) {
    global $db;

    $message .= "\n\n(This is an automated web monitor message)";    

    $user_id = 5; // CoffeePot

    $sql = "update WATCHES set md5 = '$md5' where name = '$name'";
    if (!$db->sql_query($sql)) {
        print( 'Error adding new date');
    }

// initialise the userdata
    $sql = "SELECT * FROM phpbb_users WHERE user_id = $user_id";
    if (!($result = $db->sql_query($sql))) {
        trigger_error('Could not obtain lastvisit data from user table');
    }
    $userdata = $db->sql_fetchrow($result);

    // variables to hold the parameters for submit_post
    $poll = $bitfield = $options = ''; 

    generate_text_for_storage($subject, $user_id, $bitfield, $options, false, false, false);
    generate_text_for_storage($message, $user_id, $bitfield, $options, true, true, true);

    $data = array( 
        'forum_id'      => 2,
        'icon_id'       => false,

        'enable_bbcode'     => true,
        'enable_smilies'    => true,
        'enable_urls'       => true,
        'enable_sig'        => true,

        'message'       => $message,
        'message_md5'   => md5($message),

        'bbcode_bitfield'   => $bitfield,
        'bbcode_uid'        => '',

        'post_edit_locked'  => 0,
        'topic_title'       => $subject,
        'notify_set'        => false,
        'notify'            => false,
        'post_time'         => 0,
        'forum_name'        => '',
        'enable_indexing'   => true,
    );

    $postUrl = submit_post('post', $subject, $userdata['username'], POST_NORMAL, $poll, $data);
}
