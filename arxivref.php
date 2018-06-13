<?php

// standard hack prevent
define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

if ( isset($HTTP_GET_VARS['a']) ) {$data = $HTTP_GET_VARS['a']; }
 else if (isset($HTTP_POST_VARS['a']) ) {$data = $HTTP_POST_VARS['a'];}

if ( isset($HTTP_GET_VARS['abs']) ) {$abs = $HTTP_GET_VARS['abs']; }
 else if (isset($HTTP_POST_VARS['abs']) ) {$abs = $HTTP_POST_VARS['abs'];}

if ( isset($HTTP_GET_VARS['file']) ) {$file = $HTTP_GET_VARS['file']; }
 else if (isset($HTTP_POST_VARS['file']) ) {$file = $HTTP_POST_VARS['file'];}


if (!empty($abs) || !empty($file)){
  $userdata = session_pagestart($user_ip, PAGE_TEMPLATE);
  init_userprefs($userdata);
  $mirror = $userdata['user_mirror'];
  if (empty($mirror)) {$mirror = 'arxiv.org';}
  if (!empty($file)){
  header('Location: ' . "http://$mirror/$file");
  } else {
  header('Location: ' . "http://$mirror/abs/$abs");
  }
 exit;
}


$sql = "select phpbb_topics.topic_id from phpbb_topics,phpbb_papers where phpbb_papers.paper_id=phpbb_topics.paper_id and phpbb_papers.arxiv_tag='$data'";

if( !($result = $db->sql_query($sql)) )
{
        message_die(CRITICAL_ERROR, "Could not query new paper information", "", __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
 redirect("/viewtopic.php?t=" . $row['topic_id']);
}



// standard session management
$userdata = session_pagestart($user_ip, PAGE_TEMPLATE);
init_userprefs($userdata);

$mirror = $userdata['user_mirror'];
if (empty($mirror)) {$mirror = 'arxiv.org';}
 
if (strpos($data, 'new')){
$arxiv = "http://$mirror/list/$data";
} else{
$arxiv = "http://$mirror/abs/$data";
}

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
<TD> <P>Your browser doesn\'t support frames: Click on the link below to proceed to the<BR> <A HREF="' . $arxiv. ' 
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

