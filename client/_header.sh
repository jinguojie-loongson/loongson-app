#!/bin/bash   
rm -rf /tmp/INSTALL ; mkdir /tmp/INSTALL
line=`wc -l $0|awk '{print $1}'`   
line=`expr $line - 10`    
tail -n $line $0 |tar zx -C /tmp/INSTALL
cd /tmp/INSTALL
./install.sh   
ret=$?   
#以下注释行(含此行)由代码中$line-10的10(假如叫n)来决定,应该补齐代码总行数为n+1行,这里即为11行   
#   
exit $ret
