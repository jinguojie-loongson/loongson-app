cp -rf opt etc /


# 注意：由于是使用root运行的，所以一定要获得实际登录用户
sudo -u $LOGNAME xdg-desktop-icon install HOME/*

# 自动运行后台服务
pid=`ps ax | grep app.py | grep python  | cut -b-5`
echo "Restart local server (pid $pid)"
kill -9  $pid

`grep Exec etc/xdg/autostart/app-autostart.desktop | cut -d= -f2` &>/dev/null &
