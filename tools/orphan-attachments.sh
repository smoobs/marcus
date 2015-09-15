#!/bin/bash

wproot="$PWD/www"
uploads="wp-content/uploads"
wpuploads="$wproot/$uploads"
work="$PWD/work.tmp"
orphans="$PWD/orphan-media"

# make sure we have the work dirs and they're empty
rm -rf "$work" "$orphans"
mkdir -p "$work" "$orphans"

# export current attachments
wp --path="$wproot" export --post_type=attachment --dir="$work"

# get their relative paths
find "$work" -name '*.wordpress.*.xml' | while read exp; do
  perl -ln -e "print './', \$1 if m{<wp:attachment_url>https?://[^/]+/$uploads/(.+)</wp:attachment_url>}" "$exp" | sort > "$work/known"
done

# find the actual files
pushd "$wpuploads" > /dev/null
find . -type f \(  \
     -iname '*.png'        \
  -o -iname '*.jpeg'       \
  -o -iname '*.jpg'        \
  -o -iname '*.gif'        \
\) -print | perl -ln -e 'print unless m{\d+x\d+\.\w+$}' | sort > "$work/actual"
popd > /dev/null

# find the residue; they're the orphans
diff "$work/known" "$work/actual" | perl -ln -e 'print $1 if m{^> (.*)}' > "$work/orphans"

# make hard links to the orphan files
pushd "$wpuploads" > /dev/null
cpio -pld "$orphans" < "$work/orphans"
popd > /dev/null

# import them
find "$orphans" -type f | while read orphan; do
  title="$( basename "$orphan" )"
  wp --path="$wproot" --title="$title" media import "$orphan"
done

# vim:ts=2:sw=2:sts=2:et:ft=sh

