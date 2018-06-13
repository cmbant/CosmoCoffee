<?php

define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

anti_hack($phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();
$user->get_profile_fields($user->data['user_id']);


$sql = "SELECT
            `user_id`, `pf_user_arxives`, `pf_user_keywords`
        FROM 
            phpbb_profile_fields_data
        WHERE 
            `pf_user_keywords` IS NOT NULL 
        AND
            `pf_user_keywords` != ''";

if (!($result = $db->sql_query($sql))) {
    trigger_error('Could not query new paper information');
}

$text = '<table border=1 cellpadding = 2 class = "table-arxiv-info">';

$text .= '<tr>';
$text .=    "<td> Default </td>";
$text .=    "<td>{$config['default_arxives']}</td>";
$text .=    "<td>{$config['default_arxiv_keys']}</td>";
$text .= '</tr>';

while ($row = $db->sql_fetchrow($result)) {
    $text .= '<tr>';
    $text .=    "<td>" . get_username_by_id($row['user_id']) . "</td>";
    $text .=    "<td>{$row['pf_user_arxives']}</td>";
    $text .=    "<td>{$row['pf_user_keywords']}</td>";
    $text .= '</tr>';
}

$text .= '</table>';


page_header('Arxiv New Keywords');
$template->set_filenames(array(
    'body' => 'message_body.html',
));

$template->assign_vars(array(
    'MESSAGE_TEXT'	=> $text,
    'MESSAGE_TITLE'	=> 'Arxiv New Keywords'
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();






