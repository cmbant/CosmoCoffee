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


$data = $request->is_set('a') ? $request->variable('a', '') : null;
$abs = $request->is_set('abs') ? $request->variable('abs', '') : null;
$file = $request->is_set('file') ? $request->variable('file', '') : null;

$mirror = ($user->profile_fields['pf_user_mirror']) ? $user->profile_fields['pf_user_mirror'] : $config['default_mirror'];

if (!empty($file)) {
    header('Location: ' . "https://$mirror/$file");
    exit;
} elseif (!empty($abs)) {
    header('Location: ' . "https://$mirror/abs/$abs");
    exit;
}

$sql = "select
            phpbb_topics.topic_id 
        from 
            phpbb_topics, phpbb_papers 
        where 
            phpbb_papers.paper_id = phpbb_topics.paper_id 
        and 
            phpbb_papers.arxiv_tag = '$data'";

if (!($result = $db->sql_query($sql))) {
    trigger_error('Could not query new paper information');
}

if ($row = $db->sql_fetchrow($result)) {    
    redirect("/viewtopic.php?t=" . $row['topic_id']);
}

if (strpos($data, 'new')) {
    $arxiv = "https://$mirror/list/$data";
} else {
    $arxiv = "https://$mirror/abs/$data";
}

#no frame in arXiv
 header('Location: ' . $arxiv);
 exit;
     

$alternative_text = "Your browser doesn't support frames: Click on the link below to proceed to the<br><a href='$arxiv'>Arxiv</a>";
$text = "<iframe src='$arxiv' style='border:0; height: 63vh; width:100%'>$alternative_text</iframe>";

page_header("CosmoCoffee :: $data");
$template->set_filenames(array(
    'body' => 'message_body.html',
));

$template->assign_vars(array(
    'ARXIV_LINKS' => get_arxiv_view_links($data),
    'MESSAGE_TEXT' => $text
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();















//var_dump($arxiv);

// /arxiv_view.php?r=1403.398500new
// /var/www/phpBB/cosmocoffee.loc/arxiv_view.php
ob_start();
?>

<frameset rows="155,*" frameborder="1">
   <frame src="/arxiv_view.php" name="fr_top" scrolling="no" border="0" noresize>
   <frame src="https://arxiv.org/list/astro-ph/new" name="fr_bottom">
 </frameset>

<?php
echo ob_get_clean();

die('--80--');

$text = '<HEAD><TITLE>CosmoCoffee :: ' . $data . '</TITLE></HEAD>
<FRAMESET ROWS="155,*" FRAMEBORDER=1>
<FRAME NAME="fr_top" SRC="/arxiv_view.php?r=' . $data . '" SCROLLING=NO BORDER=0 
marginheight=0 marginwidth=0>
<FRAME NAME="fr_bottom" SRC="' . $arxiv . '">
</FRAMESET>
<NOFRAMES>
<BODY BGCOLOR="#cccc99" TEXT="#000000" LINK="#000066" VLINK="#000066" 
topmargin=5 bottomMargin=0 leftMargin=0 BORDER=0>
<CENTER>
<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 COLS=1 WIDTH="500" >
<TR>
<td width="500" Height=80><CENTER></CENTER></TD>
</TR>
<TR>
<TD> <P>Your browser doesn\'t support frames: Click on the link below to proceed to the<BR> <A HREF="' . $arxiv . ' 
" TARGET="_blank">Arxiv</A>.
</TD>
</TR>
</center>
<TR>
<TD>
</TD>
</TR>
</TABLE>

</BODY>
</NOFRAMES>
</HTML>';

echo $text;
?>

