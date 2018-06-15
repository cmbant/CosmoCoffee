<?php

define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_download.' . $phpEx);

anti_hack($phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();

$upload_path = 'files';

$physical_filename = ($request->is_set('file')) ? $request->variable('file', '') : null;

if (!$physical_filename) exit;

$filename = $phpbb_root_path . "$upload_path/$physical_filename";

$path_parts = pathinfo($filename);
$real_filename = $path_parts['basename'];
$extension = $path_parts['extension'];

$mimetype = mime_content_type($filename);
$filesize = @filesize($filename);
$filetime = time();

$attachment = array(
    'attach_id' => 0,
    'post_msg_id' => 0,
    'topic_id' => 0,
    'in_message' => 0,
    'poster_id' => 0,
    'is_orphan' => 1,
    'physical_filename' => $physical_filename,
    'real_filename' => $real_filename,
    'extension' => $extension,
    'mimetype' => $mimetype,
    'filesize' => $filesize,
    'filetime' => $filetime
);

$extensions = array();
extension_allowed(2, $extension, $extensions);
$display_cat = $extensions[$extension]['display_cat'];

send_file_to_browser($attachment, $upload_path, $display_cat);

exit;


//    /cosmo_files.php?file=YinZhe_Ma/pgfig1.pdf
//    /cosmo_files.php?file=YinZhe_Ma/diff.jpg
//    /cosmo_files.php?file=YinZhe_Ma/diff.eps