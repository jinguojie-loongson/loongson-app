VERSION=`ls opt/app/db/999999:* | cut -d: -f2`
O=app-client-${VERSION}.sh

echo "Buidling $O..."

# header
# https://zhangge.net/266.html
cat _header.sh > $O

# data
FILES="opt etc HOME install.sh"
tar zcfh /tmp/INSTALL.tgz ${FILES}

cat /tmp/INSTALL.tgz >> $O

chmod +x $O
exit 0
