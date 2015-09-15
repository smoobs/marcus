#!/bin/bash

git log | perl tools/days.pl summary > smoodays.txt
git log | perl tools/days.pl csv > smoodays.csv
git log | perl tools/days.pl html > smoodays.html

# vim:ts=2:sw=2:sts=2:et:ft=sh

