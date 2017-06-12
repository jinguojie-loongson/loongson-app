cp -rf opt usr /


# 注意：由于是使用root运行的，所以一定要获得实际登录用户
sudo -u $LOGNAME xdg-desktop-icon install HOME/*

# 自动运行后台服务
SERVICE=loongson-app.service
systemctl daemon-reload
systemctl enable  $SERVICE
systemctl stop    $SERVICE
systemctl restart $SERVICE
