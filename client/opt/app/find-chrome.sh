#!/bin/sh

CMD=chromium-browser

#普华桌面5.0
if [ -f /opt/chrome39/chrome ]; then
  CMD="/opt/chrome39/chrome"
fi

#中标32位桌面
if [ -f /usr/bin/chrome.sh ]; then
  CMD="/opt/chrome31/chrome --no-sandbox"

  if [ `whoami` == "root" ]; then
    CMD="$CMD --user-data-dir=/tmp"
  fi
fi

$CMD $*
