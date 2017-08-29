# 停止后台服务
SERVICE=loongson-app
service $SERVICE stop

chkconfig loongson-app off

rm -f /etc/init.d/*loongson-app*
rm -f /etc/rc3.d/*loongson-app*
rm -f /etc/rc5.d/*loongson-app*

# 注意：由于是使用root运行的，所以一定要获得实际登录用户
ALL_HOME=`cut -d: -f6 /etc/passwd | grep -E   'root|home' | sort | uniq`

for home in $ALL_HOME; do
  USER=`basename $home`

  for dir in "桌面"  "Desktop" ; do
    if [ -d "$home/$dir/" ]; then
      rm -f HOME/*  $home/$dir/loongson-app.desktop
    fi
  done
done

rm -f  /etc/skel/Desktop/loongson-app.desktop
rm -f  /etc/skel/桌面/loongson-app.desktop

# 删除安装文件
cd /opt/app
rm -rf localserver favicon.png find-chrome.sh
cd -
