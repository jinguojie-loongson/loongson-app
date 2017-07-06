#INSTALL_ROOT=/root/livecd

echo "Installing loongson-app to ${INSTALL_ROOT}"

# 主程序文件
INSTALL_FILE=${INSTALL_ROOT}/root/loongson-app-install.sh
wget http://app.loongnix.org/app/php/downloadClient.php -O $INSTALL_FILE
chmod +x $INSTALL_FILE

# 建立后台服务
cat <<HERE   > ${INSTALL_ROOT}/etc/init.d/loongson-app-install
echo "Starting loongson-app-install"

if [ -f /root/loongson-app-install.log ]; then
  echo "Loongson app has been installed."
else
  /root/loongson-app-install.sh 2&> /root/loongson-app-install.log
fi

exit 0
HERE

chmod a+x ${INSTALL_ROOT}/etc/init.d/loongson-app-install
cd ${INSTALL_ROOT}/etc/rc3.d
ln -s ../init.d/loongson-app-install S88loongson-app-install
cd ${INSTALL_ROOT}/etc/rc5.d
ln -s ../init.d/loongson-app-install S88loongson-app-install

