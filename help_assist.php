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

$page_title = 'Code Help Assistant';

// Check if user is logged in (adjust condition as needed)
if (empty($user->profile_fields['pf_user_arxives'])) {
    // --- User Not Logged In ---
    // Show standard login message using PHPBB template
    page_header($page_title);
    $template->set_filenames(array(
        'body' => 'message_body.html',
    ));

    $text =  '<p class="gen" style="text-align: center; color: #FF0000">Log in to access the CAMB/GetDist/Cobaya code help assistant.</p>';

    $template->assign_vars(array(
        'MESSAGE_TEXT'	=> $text,
        'MESSAGE_TITLE'	=> ''
    ));

    make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
    page_footer();

} else {
    // --- User Logged In ---
    // Output minimal HTML with full-page iframe and exit

    // Call page_header minimally just to ensure user setup, sessions etc. are done,
    // but we won't use its output. Suppress headers already sent warnings if needed.
    @page_header($page_title, false); // 'false' might suppress HTML output in some versions/setups

    // Style for full viewport coverage
    $iframe_style = "position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; border: none; margin: 0; padding: 0; z-index: 9999; background-color: #fff;"; // Added background color
    $iframe_html = '<iframe style="' . $iframe_style . '" src="https://help.cosmologist.info" title="Help Assistant"></iframe>';

    // Basic HTML structure
    echo '<!DOCTYPE html>';
    echo '<html>';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>' . htmlspecialchars($page_title) . '</title>';
    echo '<style>';
    echo '  body, html {';
    echo '    margin: 0;';
    echo '    padding: 0;';
    echo '    overflow: hidden; /* Prevent scrolling of the main page body */';
    echo '  }';
    echo '</style>';
    echo '</head>';
    echo '<body>';
    echo $iframe_html;
    echo '</body>';
    echo '</html>';

    // Stop script execution to prevent PHPBB footer, jumpbox, etc.
    exit;
}

?>

