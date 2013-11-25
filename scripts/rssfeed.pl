#!/usr/bin/perl -w
# Generate a rss feed file from the News site
# Copyright (c) 2009 Barton L. Phillips
# Dual licensed under the MIT and GPL licenses.
# http://www.bartonphillips.com/License
# Mon April 27,2009

use strict;
use File::Copy;
use File::Basename;
use File::Spec;
use File::Spec::Link;
use Getopt::Long qw(GetOptions);
use Pod::Usage;

my $help = 0;
my $man = 0;
my $config = "";
my $noesc = 0;
my $resetDate = 0;

GetOptions('help|?' => \$help,
	   'man' => \$man,
           'config=s' => \$config,
           'noesc' => \$noesc,
           'resetdate' => \$resetDate
          ) or pod2usage(2);

pod2usage(1) if $help;
pod2usage(-exitval => 0, -verbose => 2) if $man;

my ($newsfile, $tmpfile, $rssfile, $backupfile, $baseUrl, $headerTags);

# Modify these variables for your site layout
# !!!! OR copy the area between the #--- lines into another file and edit that file. Name the file
# rssfeed.config and put it in the directory where rssfeed.pl resides.
# There is also a command line option to read a config file:
# rssfeed.pl --config=filename

#-------------------------------------------------------------------------
# Start of configuration section (copy this area into a new file)

# $newsfile if the web page file that contains your news items
$newsfile = "/home/barton/granbyrotary/htdocs/news.php";
# $workfile is a temp file to hold the modified $newsfile. This could
# be called temp.$$ and kept in your /tmp directory if you like.
$tmpfile = "/tmp/rssnews.$$";
# $rssfile is the name of the rss feed xml file. Probably put in the
# same directory as your news page.
$rssfile = "/home/barton/granbyrotary/htdocs/rssfeed.xml";
# $backup is the name of the file where the old $newsfile is moved
$backupfile = "$newsfile.old";
# $baseUrl plus $page plus $anchor go in the <item><link> for a news story.
$baseUrl = "http://www.granbyrotary.org/";
# $headerTags is the xml that goes at the start after the <channel>
# tag. Customize for your site.
$headerTags = <<'EOF';
  <title>Granby Rotary Club</title>
  <link>http://www.granbyrotary.org</link>
  <description>Granby Rotary Club News</description>
EOF

# End of Config section
#-------------------------------------------------------------------------

# Did we have a --config= option.
# Check to see if the configuration file is pressent. If so then read
# the config from there instead of using the values above.

my $configfile = ($config eq "") ? "rssfeed.config" : $config;
if(!(-e $configfile)) {
  my $x = File::Spec::Link->relative_to_file($configfile, $0);
  if(-f $x && (-r _) ) {
   $configfile = $x;
  }
}

if(-f $configfile && -r _) {
  print "Reading Config Info from $configfile\n";
  
  open(FILE, "<$configfile") or die "error: $!\n";
  my $x;
  ($x) = join "", <FILE>;
  eval $x;
} else {
  print "Using default configuration\n";
}

chomp $headerTags;

# End of configuration
#-------------------------------------------------------------------------

my $stdin = 0;
my ($rin, $rout) = "";

# Check to see if input is from a pipe or from a redirect

vec($rin, fileno(STDIN), 1) = 1;
$stdin = select $rout=$rin, undef, undef, 0;

if($stdin) {
  if(defined $ARGV[0]) {
    $newsfile = $ARGV[0];
  }
  if(defined $ARGV[1]) {
    $rssfile = $ARGV[1];
  }
  open(NEWS, "<-") or die "Can't open STDIN: $!\n";
} else {
  open(NEWS, "<$newsfile") or die "Can't open $newsfile: $!\n";
}    

# Check for command arguments

open(OUT, ">$tmpfile") or die "Can't open $tmpfile: $!\n";
open(RSS, ">$rssfile") or die "Can't open $rssfile: $!\n";

# Get the name of the page for the <item><link>
my $mainPage = fileparse($newsfile);

my ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = gmtime;
my $day = (qw(Sun Mon Tue Wed Thu Fri Sat Sun))[$wday];
my $mo = (qw( Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec ))[$mon];

my $date = sprintf("%s, %d %s %d %02d:%02d:%02d GMT", $day, $mday, $mo, $year+1900, $hour, $min, $sec);

print RSS <<EOF;
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
 <channel>
$headerTags
  <lastBuildDate>$date</lastBuildDate>
  <generator>rssfeed.pl by Barton Phillips</generator>
EOF

my $linecnt = 0;
my $line;

while(<NEWS>) {
  ++$linecnt;
  
  if(!/<rssfeed/) {
    print OUT;
    next;
  }

  my $newsdate;
  my ($attrTitle, $attrDate, $attrUrl, $attrPage, $attrAnchor) = "";
  my $attrNoesc = 0;
  my $page = $mainPage;
  my $url = $baseUrl;
  my $attrs = "";
  my ($rssStart, $rssEnd);
  
  if(/<rssfeed(.*)/) {
    $rssStart = $_;
    chomp $rssStart;
    
    if($1) {
      $attrs = $1;
    }

    if($attrs !~ /.*?>/) {
      # need to get rest of stuff from next lines

      while(<NEWS>) {
        my $x = $_;
        chomp $x;
        
        if(/(.*?)>/) {
          $attrs .= " $1";
          last;
        }
        $attrs .= " $x";
      }
    }
    /\s*(>)(\s*-->)*/;

    $rssEnd = $1;
    if($2) {
      $rssEnd .= $2;
    }

    if($attrs =~ /noesc/) {
      $attrNoesc = 1;
    }
    if($attrs =~ /title=['"](.*?)['"]/) {
      $attrTitle = $1;
    }
    if($attrs =~ /url=['"](.*?)['"]/) {
      $attrUrl = $1;
    }
    if($attrs =~ /page=['"](.*?)['"]/) {
      $attrPage = $1;
    }
    if($attrs =~ /anchor=['"](.*?)['"]/) {
      $attrAnchor = $1;
    }
    if($attrs =~ /date=['"](.*?)['"]/) {
      $attrDate = $1;
    }
  }

  if($resetDate) {
    $newsdate = $date;
    my $rssLine = ($rssStart =~ /<rssfeed.*?>/) ? "$rssStart\n" : "$rssStart $attrs $rssEnd\n";
    $rssLine =~ s/ date=['"].*?['"]//gsm;
    $rssLine =~ s/rssfeed/rssfeed date='$date'/gsm;
    print OUT $rssLine;
  } else {
    if($attrDate) {
      $newsdate = $attrDate;
      print OUT ($rssStart =~ /<rssfeed.*?>/) ? "$rssStart\n" : "$rssStart $attrs $rssEnd\n";
    } else {
    # This is the rssfeed line.
    # Add the date time and write it out.
      $newsdate = $date;
      my $rssLine = ($rssStart =~ /<rssfeed.*?>/) ? "$rssStart\n" : "$rssStart $attrs $rssEnd\n";
      $rssLine =~s/rssfeed/rssfeed date='$date'/gsm;
      print OUT $rssLine;
    }
  }
  my $anchor = "";
  my $title = "";
  my $description = "";

  my $section = "";
  
  while(<NEWS>) {
    ++$linecnt;
    $line = $_;
    
    last if /<\/rssfeed>/;

    if(/<rssfeed/) {
      print "ERROR: looking for end tag and found another start tag! Line=$linecnt\n";
      exit(1);
    }

    $section .= $_;
    print OUT;
  }

  if(eof(NEWS)) {
    print "ERROR: at end of file and no </rssfeed> end tag! Line=$linecnt\n";
  }
  
  # Now parse section

  if($attrAnchor) {
    $anchor = $attrAnchor;
  } else {
    if($section =~ s/<a\s+name\s*=\s*['"](.*?)['"].*?>.*?<\/a>//smg) {
      $anchor = $1;
    }
  }
  if($attrTitle) {
    $title = $attrTitle;
  } else {
    if($section =~ s/<h2>(.*?)<\/h2>//smg) { 
      $title = ($attrNoesc || $noesc) ? $1 : htmlencode($1);
    }
  }
  
  $section =~ /^\s*(.*)\s*$/smg;

  $description = ($attrNoesc || $noesc) ? $1 : htmlencode($1);

  # change lf to space

  my $reg = qr/\s+/smo;

  $title =~ s/$reg/ /g;
  $anchor =~ s/$reg/ /g;
  $description =~ s/$reg/ /g;

  if($anchor ne "") {
    $anchor = "#$anchor";
  }

  if($title eq "") {
    print "WARNING: No title found near line $linecnt\n";
  }

  if($description eq "") {
    print "WARNING: No description found near line $linecnt\n";
  }

  if($anchor eq "") {
    # not necessarily a problem
    
    print "INFO: No archor found near line $linecnt\n";
  }

  if($attrUrl) {
    $url = ($attrUrl =~ /\/$/) ? $attrUrl : "$attrUrl/";
  }
  if($attrPage) {
    $page = $attrPage;
  }
  if($attrAnchor) {
    $anchor = "#$attrAnchor";
  }

  print RSS <<EOF;
   <item>
     <title>$title</title>
     <link>${url}${page}${anchor}</link>
     <description>$description</description>
     <pubDate>$newsdate</pubDate>
   </item>
EOF
  
  print OUT unless eof(NEWS);
}

close(NEWS);
close(OUT);

print RSS <<EOF;
 </channel>
</rss>
EOF

close(RSS);

copy($newsfile, $backupfile);
move($tmpfile, $newsfile);

print "Done\n";

# Sub to encode html characters

sub htmlencode {
  my ($value) = @_;
  $value =~ s/&lt;/&amp;lt;/gsm;
  $value =~ s/&gt;/&amp;gt;/gsm;
  
  $value =~ s/<(.*?)>/&lt;$1&gt;/gsm;
  return $value;
}

__END__

=head1 NAME

 rssfeed.pl - Generate RSS feed from web pages 

=head1 SYNOPSIS

option 1: rssfeed [<newsfile> [<rssfile>]]

  If a workfile name is given then that file is read instead of the
  filename given in the config section.
  If an rssfile name is given then output is written to that file.

option 2: rssfeed [<newsfilename> [<rssfilename>]] < <newsfile>

  newsfilename is optional if not present then output goes to workfile
  named in config section.
  If rssfilename is pressent that file is used for the rss output else
  from config section.

option 3: cat xx | rssfeed [<newsfilename> [<rssfilename>]]

  like option 2 just from a pipe

=head1 OPTIONS

-h --help

   Display help

-m --man

   Display a full man page

-c configfile --config=configfile

   use the named file as the configuration file. For example: rssfeed.pl --config=path/test.config

-n --noesc

   do not escape < or >. If not set then < = &lt; and > = &gt;

-r --resetdate

   do not use the value in date="..." if it exists, instead use todays date-time.

=head1 DESCRIPTION

This program reads a new (html) file and looks for <rssfeed> tags
that should be inside html comments like this:

   <!-- <rssfeed> --> some html <!-- </rssfeed> -->

Strictly speaking the rssfeed tag does not need to be inside
comments, also you can have:

   <!-- <rssfeed> then html which is inside the comment </rssfeed> -->

which lets you have code that does not appear on the web page.

This program extracts the <h2> element as the <title> element of the
rss.

If there is a <a name=... tag the text of the name is appended
to the link with a so the link goes directly to the anchor.

The program creates a temp file news.php.rss which has the <rssfeed>
tag replaced with <rssfeed date='...'> which has the date this
program was run. If the news.php file has the date='...' attrubute on
the rssfeed tag then that date is used instead of the current date.
After the program is done it copies the news.php file to news.php.old
and then moves the news.php.rss file to replace news.php.

The <rssfeed> tag can take several other attributes:

  date="..."     article date
  title="..."    article title
  url="..."      the base url of the target page
  page="..."     the page file name
  anchor="..."   the anchor name
  noesc          do not escape html codes

each of these attributes takes the place of tag item between the <rssfeed> tag. For example:

  <rssfeed url="http://www.xyz.com" page="XYZ.php" anchor="this" title="XYZ test" date="Sun, 26 Apr 2009 19:58:59 GMT">
  <h2>Some text here</h2>
  <p>Some more text as a description</p>
  </rssfeed>

This section of code would produce the following <item> sectoin in the rssfeed.xml file:

  <item>
    <title>XYZ test</title>
    <link>http://www.xyz.com/XYZ.php#this</link>
    <description><h2>Some text here</h2><p>Some more text as a description</p> </description>
    <pubDate>Sun, 26 Apr 2009 19:58:59 GMT</pubDate>
  </item>

The <h2> tag is ignored as a title if the title attribute is provided. The same goes for the other attributes. The link
attribute takes the place of the default link set in the configuration section, this lets you have <rssfeed> tags in
one file that reference another file or site.

=head1 EXAMPLES

rssfeed.pl

   The default behavior, the files mentioned in the configuration file or the defaults are used.

rssfeed.pl def.html

  The file 'def.html' is read instead of the 'newsfile' mentioned in the configuration file or default. The file 'def.html' is
  updated and a 'def.html.old' is the backup. The rss feed goes into the file mentioned in the configuration.

rssfeed.pl def.html abc.xml

  Like above but the rss feed goes into 'abc.xml'.

rssfeed.pl xyz.html < def.html

  The file to be parsed is 'def.html', the rss feed output goes to the file mentioned in the configuration file or defaults,
  the new html goesss to 'xyz.html'.    

rssfeed.pl xyz.html abc.xml < def.html

  The file to be parsed is 'def.html', the rss feed output will go to 'abc.xml', the new html goes to 'xyz.html'.

wget -O - http://localhost/def.php | rssfeed.pl

  If you have rssfeed tags that at generated dynamically you can pipe the output from the webpage to rssfeed.pl.
  Assumming the configuration file or defaults are set to 'newsfile=webpath/def.php', 'rssfile=webpath/abc.xml'
  the rss output would go to webpath/abc.xml, the file webpath/def.php would be updated and a backup file
  webpath/def.php.old would be created.

=head1 FILES

rssfeed.config             default configuration file. Should be in the same directory as the rssfeed.pl.
                           Can be created by cutting and pasting the default configuration from the script
                           and changing the variables to fit your site.

=head1 SEE ALSO

http://www.bartonphillips.com


=head1 NOTES

The <rssfeed ...> can be split over several lines; however, the ending MUST be on a line by itself. If the <rssfeed> tag
is inside a comment the end comment can be on the same line as the ending > of the tag.

This is OK:

   <--
   <rssfeed
   title="Hi There">
   -->

This is NOT OK:

   <-- <rssfeed title="Hi There"> --> <p>Some html on the same line</p>

I guess this could be thought of as a BUG but I like to think of it as a feature:)                      

=head1 BUGS

Probably, if you find any please let me know at the email addresses below. Thanks.

=head1 AUTHOR

Barton Phillips

=over

=item * barton@bartonphillips.com

=item * bartonphillips@gmail.com

=item * http://www.bartonphillips.com

=back

=cut
