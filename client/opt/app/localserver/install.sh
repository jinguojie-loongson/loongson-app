#!/bin/bash

# 参数
# id，version，download_url，download_file, md5sum，install_script


ID=$1
VERSION=$2
DOWNLOAD_URL=$3
DOWNLOAD_FILE=$4
MD5=$5
INSTALL_SCRIPT=$6


# 文件名： id
# 内  容： id:version:状态:时间
STATUS_FILE=/opt/app/db/${ID}

echo "Installing $ID, $VERSION..."
rm -f  $STATUS_FILE*

log_status()
{
    echo "${ID}:${VERSION}:$1:`date`" > $STATUS_FILE
}

download()
{
    log_status "downloading"

    if [ -d $2 ]; then
      return 1
    fi

    rm -rf $2
    wget -r -p $1  -O $2
    return $?
}

check()
{
    log_status "checking-download-file"

    m=` md5sum $1 `

    if [ $? -ne 0 ]; then
      log_status "checking-download-file-error"
      return 1
    fi

    if [[ "$m" =~ "$2" ]]; then
        # 子串
        echo "md5值匹配"
        return 0
    fi

    log_status "checking-download-file-error"
    return 1
}

install()
{
    log_status "installing"

    sh -c "$1"
    if [ $? -ne 0 ]; then
        log_status "installing-error"
        return 1
    fi

    return 0
}

register_installed()
{
    log_status "installed"
}

#### Begin ###

download $DOWNLOAD_URL $DOWNLOAD_FILE

check $DOWNLOAD_FILE $MD5

if [ $? != 0 ]; then
    exit 1
fi

install "${INSTALL_SCRIPT}"

if [ $? -ne 0 ]; then
    exit 1
fi

register_installed


exit 0
