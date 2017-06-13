#!/bin/bash

# 参数
# id，install_script


ID=$1
VERSION=
UNINSTALL_SCRIPT=$2


# 文件名： id
# 内  容： id:version:状态:时间
STATUS_FILE=/opt/app/db/${ID}

echo "Unnstalling $ID, $VERSION..."
rm -f  $STATUS_FILE*

log_status()
{
    echo "${ID}:${VERSION}:$1:`date`" > $STATUS_FILE
}

uninstall()
{
    log_status "uninstalling"

    sh -c "$1"
    if [ $? -ne 0 ]; then
        log_status "uninstalling-error"
        return 1
    fi

    return 0
}

unregister_installed()
{
    rm -f  $STATUS_FILE*
}

#### Begin ###

log_status "uninstalling"
uninstall "${UNINSTALL_SCRIPT}"

if [ $? -ne 0 ]; then
    exit 1
fi

unregister_installed

exit 0
