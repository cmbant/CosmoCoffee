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

$bookfname = 'bookmark.php';


$text = '<br>';

if ($result = $db->sql_query("select j.name,j.shortname,j.club_id,j.description from journal_clubs as j")) {
    while ($row = $db->sql_fetchrow($result)) {

        $text .= '<h3><a class="maintitle" href="' . $bookfname . '?club=' . $row['club_id'] . '">' . $row['name'] . '</a></h3>';

        $text .= '<p class="gen">Description: ' . $row['description'] . '</p>';
        $text .= '<p class="gen">Short name: ' . $row['shortname'] . '</p>';
    }
}



page_header('Journal club list');
$template->set_filenames(array(
    'body' => 'message_body.html',
));

$template->assign_vars(array(
    'MESSAGE_TEXT'	=> $text,
    'MESSAGE_TITLE'	=> 'Journal club list'
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();
