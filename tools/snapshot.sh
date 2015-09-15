#!/bin/bash

out="sql"
mkdir -p "$out"
mysqldump -uroot newrfdb333 > "$out/newrfdb333.$( date '+%Y%m%d-%H%M%S' ).sql"

# vim:ts=2:sw=2:sts=2:et:ft=sh

