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

$f=2;

if ($data =~ m/new/){
    $subject='';
} else{
    $subject=$data;

use DBI;

$database = "cosmocoffee_cosmocoffee";
$username = "1015824_7_r";
$password = "7KzWVN32";
$hostname = "db85a.pair.com";

$db = DBI->connect("DBI:mysql:$database:$hostname", $username, $password); 
    $sql = "select arxiv from ARXIV_NEW where arxiv_tag = '$data'";
  $query = $db->prepare($sql);
  $query->execute;
   if ($query->rows > 0) {

      ($arxiv) = $query->fetchrow;
      if ($arxiv =~ m/astro-ph/){ $f=2 ;}
  }
  $query->finish;
 $db->disconnect;

}


print "Location: ./posting.php?mode=post&f=$f&subject=$subject\n\n"; 

exit;
