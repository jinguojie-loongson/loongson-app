#!/bin/sh

CMD=chromium-browser

#中标32位桌面
if [ -f /usr/bin/chrome.sh ]; then
  CMD="/opt/chrome31/chrome --no-sandbox"

  if [ `whoami` == "root" ]; then
    CMD="$CMD --user-data-dir=/tmp"
  fi
fi

$CMD $*
