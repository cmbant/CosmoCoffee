#!/usr/bin/perl


sub trim {
    my @out = @_;
    for (@out){
	s/^\s+//;
        s/\s+$//;
    }
    return wantarray ? @out : $out[0];
}


	if ($ENV{'REQUEST_METHOD'} eq "POST"){
		#Determine the length of the POST'd data.
		$len = $ENV{'CONTENT_LENGTH'};
		#Read the forms data from the standard input
		read(STDIN, $data, $len);
	}
	elsif ($ENV{'REQUEST_METHOD'} eq "GET") {
		$data = $ENV{'QUERY_STRING'};
	}

@pairs = split(/&/, $data);

foreach $pair (@pairs) {
($name, $value) = split(/=/, $pair);
$value =~ tr/+/ /;
$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
$value =~ s/\'/\'\'/g;
            #put ' to '' for SQL
$variable{$name} = trim($value);
$count++;
}

$ref = $variable{'r'};


if ($ref =~ m/.+\/([0-9v]{3,})|new/){
print "Location: http://cosmocoffee.info/discuss/$ref\n\n"; 
} elsif ($ref =~ m/([0-9v]{3,}\.[0-9v]{3,})/){

    print "Location: http://cosmocoffee.info/discuss/$ref\n\n";

} elsif ($ref =~ m/([0-9v]{3,})/){

    print "Location: http://cosmocoffee.info/discuss/astro-ph/$ref\n\n";
} elsif(1) { 
 
if ($ref =~ m/(.+)\/(.+)/){
    $archive = $1;
    $ref = $2;
} else {$archive = 'grp_physics';}


if ($ref =~m/ /){

    $search = $ref;
    $search =~ tr/ /+/;
    $search = 'AND+'. $search;

} else {$search = $ref;} 

print "Location: http://arxiv.org/find/$archive/1/au:+$search/0/1/0/all/0/1\n\n";

}
else {

print "Content-type: text/html\n\n";
print <<END1;
<HTML><head><TITLE>Search</TITLE></head><body BGCOLOR="#ffffff">
<H2>Not a valid arxiv ref: $ref</H2>
</BODY></HTML>
END1

}

exit;
#end of job

