VERSION=`cat ../VERSION`

rm -f opt/app/db/999999:*
date > opt/app/db/999999:${VERSION}

O=app-client-${VERSION}.sh

echo "Buidling $O..."

# data
FILES="opt etc HOME install.sh"
tar zcfh /tmp/INSTALL.tgz ${FILES}

# header
# https://zhangge.net/266.html

cat _header.sh /tmp/INSTALL.tgz > $O

chmod +x $O
exit 0
