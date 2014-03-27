#!/usr/bin/env bash

FIND_DIR="/srv"
DOMAIN_PREFIX=""
DOMAIN_SUFFIX=".getfobia.ru"

[[ -n "$1" ]] && FIND_DIR="$1"
[[ -n "$2" ]] && DOMAIN_SUFFIX="$2"
[[ -n "$3" ]] && DOMAIN_PREFIX="$3"

# ===========================================================


echo "FIND_DIR: ${FIND_DIR}"
echo "DOMAIN_PREFIX: ${DOMAIN_PREFIX}"
echo "DOMAIN_SUFFIX: ${DOMAIN_SUFFIX}"
echo "------------"

TMP_FILE="$(dirname $0)/$(basename $0).tmp"
rm -f "$TMP_FILE"
touch  "$TMP_FILE"

# Use VHost smart-queue.loc /var/www/smart-queue

#
# Vhosts begin
#

#
# Vhosts end
#

find "$FIND_DIR" -maxdepth 1 -type d -printf "%p\n" | grep -e "^$FIND_DIR/" | while read hdir; do
    DocumentRoot="$hdir"
    DOMAIN="${DOMAIN_PREFIX}${hdir/${FIND_DIR}\//}${DOMAIN_SUFFIX}"

    [[ -d "$hdir/web" ]]         && DocumentRoot="$hdir/web"
    [[ -d "$hdir/html" ]]        && DocumentRoot="$hdir/html"
    [[ -d "$hdir/webroot" ]]     && DocumentRoot="$hdir/webroot"
    [[ -d "$hdir/public_html" ]] && DocumentRoot="$hdir/public_html"
    [[ -d "$hdir/public" ]]      && DocumentRoot="$hdir/public"

    echo "Use VHost $DOMAIN  $DocumentRoot" >> "$TMP_FILE"
done

/usr/bin/php -r '
$file = __DIR__."/$argv[1]/dnsmasq.conf";
$content = file_get_contents(__DIR__ . "/" . $argv[2]);

$pattern = "/(#
# Vhosts begin
#)(.*)(#
# Vhosts end
#)/is";

echo preg_replace($pattern, "$1\n$content\n$3", file_get_contents($file));
' "$(dirname $0)" "$TMP_FILE"

rm -f "$TMP_FILE"