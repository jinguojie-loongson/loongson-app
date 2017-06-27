# 主程序文件
cp -rf opt /

# 注意：由于是使用root运行的，所以一定要获得实际登录用户
DEST=/home/$LOGNAME/桌面
cp HOME/*  $DEST
chown $LOGNAME:$LOGNAME $DEST/*

# 自动运行后台服务
cp -rf etc/init.d/* /etc/init.d
cd /etc/rc3.d
ln -s ../init.d/loongson-app S99loongson-app
cd /etc/rc5.d
ln -s ../init.d/loongson-app S99loongson-app

SERVICE=loongson-app
service $SERVICE restart
