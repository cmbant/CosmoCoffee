<?php 

// standard hack prevent 
define('IN_PHPBB', true); 
$phpbb_root_path = './'; 
include($phpbb_root_path . 'extension.inc'); 
include($phpbb_root_path . 'common.'.$phpEx); 
include($phpbb_root_path . 'includes/functions_arxiv.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);

function microtime_float() 
{ 
   list($usec, $sec) = explode(" ", microtime()); 
   return ((float)$usec + (float)$sec); 
} 

$date = '';
$interval = 1;
$starttime = microtime_float();

if ( isset($HTTP_GET_VARS['d']) || isset($HTTP_POST_VARS['d']) )
{
        $date  = ( isset($HTTP_GET_VARS['d']) ) ? $HTTP_GET_VARS['d'] : $HTTP_POST_VARS['d'];
}

if ( isset($HTTP_GET_VARS['i']) ) {$interval = $HTTP_GET_VARS['i']; }
 else if (isset($HTTP_POST_VARS['i']) ) {$interval = $HTTP_POST_VARS['i'];}

$interval = min(30,$interval);


// standard session management 
$userdata = session_pagestart($user_ip, PAGE_TEMPLATE); 
init_userprefs($userdata); 

// set page title 
$page_title = 'Arxiv New Keywords'; 
$text = '';

// standard page header 
include($phpbb_root_path . 'includes/page_header.'.$phpEx); 

$match_str = '';
$neg_match = '';


function array_trim($arr){
   foreach($arr as $key => $value){
       if (is_array($value)) $result[$key] = array_trim($value);
       else $result[$key] = trim($value);
   }
   return $result;
} 

$sql = "SELECT username,user_arxives,user_keywords FROM phpbb_users where user_keywords <> ''";
if( !($result = $db->sql_query($sql)) )
{
        message_die(CRITICAL_ERROR, "Could not query new paper information", "", __LINE__, __FILE__, $sql);
}

$text = '<span class="maintitle">Arxiv New keyword strings</span>';

$text .='<P><TABLE border=1 cellpadding = 2 class = "genmed">';

$text .=  '<TR><TD> Default </TD><TD>' . $board_config['default_arxives'] .
 '</TD><TD>' . $board_config['default_arxiv_keys'] . '</TD></TR>';

while ( $row = $db->sql_fetchrow($result) )
{
  $text .= '<TR><TD>' . $row['username'] . '</TD><TD>' . $row['user_arxives'] . '</TD><TD>' . $row['user_keywords'] .
   '</TD></TR>'; 

}


$text .= '</TABLE><HR>';

echo $text;

// standard page footer 
include($phpbb_root_path . 'includes/page_tail.'.$phpEx); 

?>
