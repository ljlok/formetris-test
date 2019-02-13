#!/bin/sh
SCRIPT=`readlink -f $0`
SCRIPTPATH=`dirname $SCRIPT`

php -S localhost:8000 --docroot "$SCRIPTPATH/src/public"
