#!/bin/sh

CMD=chromium-browser

if [ -f /usr/bin/chrome.sh ]; then
  CMD="/opt/chrome31/chrome --no-sandbox"
fi

$CMD $*
