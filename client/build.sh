VERSION=`cat ../VERSION`

STATUS_FILE=opt/app/db/999999
rm -f $STATUS_FILE
echo "999999:${VERSION}:installed:`date`" > $STATUS_FILE

O=app-client-${VERSION}.sh

echo "Buidling $O..."

# data
FILES="opt usr HOME install.sh"
tar zcfh /tmp/INSTALL.tgz ${FILES}

# header
# https://zhangge.net/266.html

cat _header.sh /tmp/INSTALL.tgz > $O

chmod +x $O
exit 0
