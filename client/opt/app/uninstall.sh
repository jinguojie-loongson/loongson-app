# 停止后台服务
SERVICE=loongson-app
service $SERVICE stop

rm -f /etc/init.d/*loongson-app*
rm -f /etc/rc3.d/*loongson-app*
rm -f /etc/rc5.d/*loongson-app*

# 注意：由于是使用root运行的，所以一定要获得实际登录用户
rm -f /home/$LOGNAME/桌面/loongson-app.desktop

# 删除安装文件
cd /opt/app
rm -rf localserver favicon.png find-chrome.sh
cd -
