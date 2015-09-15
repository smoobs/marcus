#!/usr/bin/env perl

use v5.10;

use autodie;
use strict;
use warnings;

use Getopt::Long;
use HTML::Parser;
use Path::Class;
use Text::CSV_XS;
use JSON;

use constant SYNTAX => <<EOT;
Syntax: $0 file|url
EOT

GetOptions() or die SYNTAX;
die SYNTAX unless @ARGV == 1;

my $html    = load_thing(@ARGV);
my $sitemap = parse_sitemap($html);

my $csv = Text::CSV_XS->new;
$csv->column_names( 'URL', 'Title' );
$csv->print( \*STDOUT, [$csv->column_names] );
print "\n";
for my $row (@$sitemap) {
  $csv->print( \*STDOUT, [$row->{href}, ('') x $row->{depth}, $row->{title}]);
  print "\n";
}

sub parse_sitemap {
  my $html = shift;

  my $p       = HTML::Parser->new;
  my $in_list = 0;
  my $depth   = 0;
  my $capture = 0;
  my @item    = ();
  my @text    = ();
  my @ul      = ();
  my $href    = undef;

  $p->handler( text => sub { push @text, $_[0] if $capture }, 'dtext' );

  $p->handler(
    start => sub {
      my ( $tag, $attr ) = @_;
      if ( $tag eq 'ul' ) {
        push @ul, $attr;
        $depth++;
        if ( exists $attr->{class} && $attr->{class} =~ /\bwsp-pages-list\b/ ) {
          $in_list = 1;
          $depth   = 0;
        }
      }
      elsif ( $tag eq 'a' ) {
        return unless $in_list;
        $capture = 1;
        $href    = $attr->{href};
      }
    },
    'tagname, attr',
  );

  $p->handler(
    end => sub {
      my $tag = shift;
      if ( $tag eq 'ul' ) {
        my $attr = pop @ul;
        $depth--;
        if ( exists $attr->{class} && $attr->{class} =~ /\bwsp-pages-list\b/ ) {
          $in_list = 0;
        }
      }
      elsif ( $tag eq 'a' ) {
        return unless $in_list;
        my $txt = join '', splice @text;
        $capture = 0;
        push @item,
         {depth => $depth,
          href  => $href,
          title => $txt,
         };
      }
    },
    'tagname'
  );

  $p->parse($html);
  $p->eof;
  return \@item;
}

sub load_thing {
  my $obj = shift;

  if ( $obj =~ m{^http://} ) {
    my $resp = LWP::UserAgent->new->get($obj);
    die $resp->status_line if $resp->is_error;
    return $resp->content;
  }

  return scalar file($obj)->slurp;
}

# vim:ts=2:sw=2:sts=2:et:ft=perl

