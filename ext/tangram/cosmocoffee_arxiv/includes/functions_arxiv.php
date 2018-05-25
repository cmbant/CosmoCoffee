<?php

function get_url( $url )
{
	$user_agent = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/125.5 (KHTML, like Gecko) Safari/125.9';

	$ch = curl_init(); 
	//curl_setopt( $ch, CURLOPT_PROXY, $proxy );
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_USERAGENT, $user_agent );
	//curl_setopt( $ch, CURLOPT_COOKIEJAR, "c:\cookie.txt" );
	curl_setopt( $ch, CURLOPT_HEADER, 1 ); 
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); 
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
	curl_setopt( $ch, CURLOPT_TIMEOUT, 120 );
	$result = curl_exec( $ch );
	curl_close( $ch );
	return $result;
}

function arxiv_traceback($arxiv)
{
       $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, 'http://arxiv.org/trackback/' . $arxiv );
//        $header[] = "Content-Type: application/x-www-form-urlencoded; charset=utf-8";
        $urlstring = "title=Discussion&url=http://cosmocoffee.info/discuss/" . $arxiv . "&blog_name=CosmoCoffee";
//        curl_setopt( $ch, CURLOPT_HEADER, $header );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_USERAGENT, 'CosmoCoffee' ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $urlstring); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_REFERER,"http://CosmoCoffee.info");
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 20 );
        $result = curl_exec( $ch );
        curl_close( $ch );
 
}

function is_arxiv_tag( $str )
{
//	if ( preg_match('|[a-z]{4,}-[a-z]{2,}/\d{7}|',$str) == 1 )
        if ( preg_match('|^[a-z][a-zA-Z\.\-]{3,}/[0-9v]{6,}$|',$str) == 1 || 
             preg_match('|^(arxiv:)?[0-9]{4,4}\.[0-9]{4,4}(v.)?$|i',$str))
		return TRUE;
	else
		return FALSE;
}

function get_arxiv_paper_info( $arxiv_in )
{
       
        $arxiv_tag =  str_replace('arxiv:','',$arxiv_in);
        $arxiv_tag = preg_replace("'arxiv\:'si","",$arxiv_tag);
	$arxiv_tag = preg_replace("'v[1-9]'si","",$arxiv_tag);

        $url = 'http://arxiv.org/abs/' . $arxiv_tag;
	$html = get_url( $url );
	$info = array( 'url'=>$url, 'tag'=>$arxiv_tag, 'html'=>$html );

	$found = preg_match( '|Title:</span>(.*)<|sUi', $html, $matches );
	if ( !$found ) return FALSE;
	$info['title'] = $matches[1];

	$found = preg_match( '|Authors:.*>(.*)<\/div>|isU',
		$html, $matches );
	if ( !$found )
	{
#		$found = preg_match( '|Authors:(.*)<BLOCKQUOTE>|isU',
#			$html, $matches );
		if ( !$found ) return FALSE;
	}
	$raw_authors = $matches[1];
	// remove html tags
	$authors = preg_replace( "'<[\/\!]*?[^<>]*?>'si", "", $raw_authors );
	$info['authors'] = $authors;

	$found = preg_match( '|Abstract:.*>(.*)<\/BLOCKQUOTE>|isU',
		$html, $matches );

	if ( !$found ) return FALSE;
	$info['abstract'] = $matches[1];

	$found = preg_match( '|Comments:.*/div>.*<div.*>(.*)<\/div|isU',$html, $matches );
	//if ( !$found ) return FALSE;
	$info['comments'] = $matches[1];

	return $info;
}

function clean_sql( $str )
{
	return addslashes(trim($str));
}

function get_x_from_table_where_y( $db, $x, $table, $y )
{
	$sql = "SELECT $x from $table where $y";

	if ($result = $db->sql_query($sql))
		if ($row = $db->sql_fetchrow($result))
			if ( !empty($row[$x]) )
				return $row[$x];

	return FALSE;
}

/*
function get_paper_id_from_arxiv_tag( $arxiv_tag )
{
	$sql = "SELECT paper_id from ". PAPERS_TABLE ." where arxiv_tag='$arxiv_tag'";
	if ($result = $db->sql_query($sql))
		if ($row = $db->sql_fetchrow($result))
			if ( !empty($row['paper_id']) )
				return intval($row['paper_id']);

	return FALSE;
}
*/

function add_arxiv_paper_to_db( $db, $arxiv_info )
{
	$arxiv_tag = clean_sql($arxiv_info['tag']);
	$paper_authors = clean_sql(str_replace("\n"," ",$arxiv_info['authors']));
	$paper_title = clean_sql($arxiv_info['title']);
	$paper_url = clean_sql($arxiv_info['url']);
	$paper_abstract = clean_sql($arxiv_info['abstract']);
	$paper_comments = clean_sql($arxiv_info['comments']);

	// check if it's already in the table
	$paper_id = get_x_from_table_where_y( $db, 'paper_id', PAPERS_TABLE,
		"arxiv_tag='$arxiv_tag'" );
	if ( $paper_id != FALSE ) return intval($paper_id);

	$sql  = "INSERT INTO " . PAPERS_TABLE . " (arxiv_tag, paper_authors, paper_title, paper_url, paper_abstract, paper_comments) VALUES ('$arxiv_tag', '$paper_authors', '$paper_title', '$paper_url', '$paper_abstract', '$paper_comments');";

	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Error in adding paper to db', '', __LINE__, __FILE__, $sql);
	}

	$paper_id = $db->sql_nextid();

       arxiv_traceback($arxiv_tag);

	return $paper_id;
}

?>
