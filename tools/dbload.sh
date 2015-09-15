#!/bin/bash

perl tools/fix_wp_sql.pl                          \
  http://rf2.tthtesting.co.uk http://rf2.fenkle   \
  https://rf2.tthtesting.co.uk http://rf2.fenkle  \
  < sql/newrfdb333-data.sql |                     \
  mysql -uroot

# vim:ts=2:sw=2:sts=2:et:ft=sh

