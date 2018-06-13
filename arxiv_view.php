<?php
define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

anti_hack($phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();

page_header('Arxiv view');
$template->set_filenames(array(
    'body' => 'message_body.html',
));

$ref = $request->variable('r', '');

$links = "<center>[<a target='_top' href='/arxiv_start.pl?$ref'>Discuss $ref</a>]&nbsp;&nbsp;";
if ($user->data['user_id'] != ANONYMOUS) {
    $links .= "[<a target='_top' href='/bookmark.php?add=$ref'>Bookmark $ref</a>]&nbsp;&nbsp;";
}
$links .= "[<a target='_top' href='/bibtex.php?arxiv=$ref'>BibTex</a>]</center>";

$template->assign_vars(array(
    'ARXIV_LINKS' => $links
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

