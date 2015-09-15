#!/usr/bin/env perl

use v5.10;

use strict;
use warnings;

use Date::Parse;
use POSIX qw( strftime );

use constant BASE => 'https://github.com/AndyA/rf2/commit/';

my $verb = shift // 'summary';

my %itm  = ();
my @rec  = ();
my $base = BASE;
while (<>) {
  chomp;
  if (/^#!\s+(\S+)/) {
    $base = $1;
  }
  if (/^commit\s+(\S+)/) {
    push @rec, {%itm} if keys %itm;
    %itm = ( commit => $1, base => $base, msg => [] );
    next;
  }
  elsif (/^Author:\s+(.+)/) {
    $itm{author} = $1;
  }
  elsif (/^Date:\s+(.+)/) {
    $itm{date} = str2time($1);
  }
  else {
    push @{ $itm{msg} }, $_;
  }
}
push @rec, {%itm} if keys %itm;

$_->{msg} = _clean( $_->{msg} ) for @rec;

@rec = grep { $_->{author} =~ /smoo|sam/ } @rec;

my %by_day = ();
for my $itm (@rec) {
  my $day = int( $itm->{date} / ( 60 * 60 * 24 ) );
  push @{ $by_day{$day} }, $itm;
}

if ( $verb eq 'summary' ) {
  for my $day ( sort { $a <=> $b } keys %by_day ) {
    my $date = strftime '%Y/%m/%d', gmtime $day * 60 * 60 * 24;
    print "$date\n";
    for my $itm ( sort { $a->{date} <=> $b->{date} } @{ $by_day{$day} } ) {
      print '  ', strftime( '%H:%M:%S', gmtime $itm->{date} ), ' ',
       $itm->{author}, "\n";
    }
  }
}
elsif ( $verb eq 'html' ) {
  print "<html><head><title>Smoodays</title></head><body>\n";
  print "<table>\n";
  for my $day ( sort { $a <=> $b } keys %by_day ) {
    my $date = strftime '%Y/%m/%d', gmtime $day * 60 * 60 * 24;
    my @slot = sort { $a <=> $b } map { $_->{date} } @{ $by_day{$day} };
    my $hours = sprintf '%.2g',  ( $slot[-1] - $slot[0] ) / 3600;
    print '<tr><th colspan="2">', "$date ($hours hours)", '</th></tr>';
    for my $itm ( sort { $a->{date} <=> $b->{date} } @{ $by_day{$day} } ) {
      print '<tr><td>', strftime( '%H:%M:%S', gmtime $itm->{date} ), '</td>';
      print '<td><a href="', $itm->{base}, $itm->{commit}, '">',
       $itm->{msg},
       "</a></td></tr>\n";
    }
  }
  print "</table>\n";
  print "</body></html>\n";
}
elsif ( $verb eq 'csv' ) {
  for my $day ( sort { $a <=> $b } keys %by_day ) {
    my $date = strftime '%Y/%m/%d', gmtime $day * 60 * 60 * 24;
    my @slot = sort { $a <=> $b } map { $_->{date} } @{ $by_day{$day} };
    my $hours = ( $slot[-1] - $slot[0] ) / 3600;
    print join( ',', map { qq{"$_"} } ( $date, sprintf '%.2g', $hours ) ),
     "\n";
  }
}
else {
  die "Bad verb $verb";
}

sub _clean {
  my $msg = shift;
  my $txt = join ' ', @$msg;
  $txt =~ s/^\s+//;
  $txt =~ s/\s+$//;
  $txt =~ s/\s+/ /;
  return $txt;
}

# vim:ts=2:sw=2:sts=2:et:ft=perl
