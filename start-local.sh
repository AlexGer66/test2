#!/bin/sh
# simple helper to start local services without docker
# assumes mysql and php are available on PATH (Debian/Ubuntu style)

# start mysql server if not running
if ! systemctl is-active --quiet mysql; then
    echo "starting MySQL..."
    sudo systemctl start mysql
fi

# if you prefer mariadb replace mysql with mariadb

# run built-in PHP web server (listens on 8000)
# application files are in src/
echo "starting PHP built-in server on http://localhost:8000"
php -S 0.0.0.0:8000 -t src
