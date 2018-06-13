#!/usr/bin/perl

	if ($ENV{'REQUEST_METHOD'} eq "POST"){
		#Determine the length of the POST'd data.
		$len = $ENV{'CONTENT_LENGTH'};
		#Read the forms data from the standard input
		read(STDIN, $data, $len);
	}
	elsif ($ENV{'REQUEST_METHOD'} eq "GET") {
		$data = $ENV{'QUERY_STRING'};
	}



$data =~ s/\+/ /g;
$data =~ s/\'/\'\'/g;
$OK = 0;

use DBI;
$database = "wordweb1_coffee";
$username = "wordweb1_cosmo";
$password = "SD3FJFr9fVA";
$hostname = "localhost";
$db = DBI->connect("DBI:mysql:$database:$hostname", $username, $password); 

  $query = $db->prepare("select phpbb_topics.topic_id,phpbb_topics.forum_id from phpbb_topics,phpbb_papers where phpbb_papers.paper_id=phpbb_topics.paper_id and phpbb_papers.arxiv_tag='$data'");
  $query->execute;
   if ($query->rows > 0) {

      ($topic,$forum) = $query->fetchrow;
      $OK=1; 
  }
  $query->finish;
$db->disconnect;


if ($OK){

print "Location: http://cosmocoffee.info/viewtopic.php?t=$topic\n\n"; 
exit;
}

if ($data =~ m/new/){
$arxiv = "http://arxiv.org/list/$data"
} else{
$arxiv = "http://arxiv.org/abs/$data";
}

print "Content-type: text/html\n\n";
print <<EOM;
<HEAD><TITLE>CosmoCoffee :: $data</TITLE></HEAD>

<FRAMESET ROWS="155,*" FRAMEBORDER=1>
<FRAME NAME="fr_top" SRC="/arxiv_view.php?r=$data" SCROLLING=NO BORDER=0 
marginheight=0 marginwidth=0>
<FRAME NAME="fr_bottom" SRC="$arxiv">
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
<TD>
                <P>Your browser doesn't support frames: Click on the link 
below to proceed to the<BR> <A HREF="$arxiv" TARGET="_blank">Arxiv</A>.
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
</HTML>
EOM

