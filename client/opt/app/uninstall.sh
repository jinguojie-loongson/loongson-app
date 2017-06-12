# 停止后台服务
SERVICE=loongson-app.service
systemctl stop    $SERVICE
systemctl disable  $SERVICE
systemctl daemon-reload

# 注意：由于是使用root运行的，所以一定要获得实际登录用户
sudo -u $LOGNAME xdg-desktop-icon uninstall loongson-app.desktop

# 删除安装文件
cd /opt/app
rm -rf localserver favicon.png
cd -

rm -rf /usr/lib/systemd/system/loongson-app.service
