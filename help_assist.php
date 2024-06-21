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

page_header('Code Help Assistant');
$template->set_filenames(array(
    'body' => 'message_body.html',
));

$starttime = microtime_float();

if(!$user->profile_fields['pf_user_arxives']) {
   $text =  '<p class="gen" style="text-align: center; color: #FF0000">Log in to access the CAMB/GetDist/Cobaya code help assistant.</p>';

} else {
    $text = '<iframe style="display:block; width: 100%; height: 60vh; transform: scale(80%)" src="https://help.cosmologist.info" title="Help Assistant"></iframe>';
}

$template->assign_vars(array(
    'MESSAGE_TEXT'	=> $text,
    'MESSAGE_TITLE'	=> ''
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

