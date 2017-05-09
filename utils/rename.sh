#!/bin/bash

FILES=./*.yml
SUFFIX=".yml"
TARG = ""

for f in $FILES

do
  line=$(head -n 1 $f)
  echo "Processing $f file... $line"
  TARG=$(echo $line$SUFFIX | sed 's/://' | sed 's/\\/\./g')
  echo "renaming $f to $TARG"
  mv $f $TARG

done
