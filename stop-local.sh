#!/bin/sh
# stop/shutdown local services started by start-local.sh

if systemctl is-active --quiet mysql; then
    echo "stopping MySQL..."
    sudo systemctl stop mysql
fi

echo "you may need to kill the php built-in server process manually (CTRL-C)"
