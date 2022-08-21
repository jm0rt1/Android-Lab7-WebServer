#!/bin/bash
# --- gaurd --- #
set -e
./exit-on-uncommitted-changes.sh
echo "Updating web app"

# --- constants --- #
WEB_APP_PATH="/Applications/XAMPP/xamppfiles/htdocs/slimapp2"
cwd=$(pwd)

# --- variables --- #
index_dest_path="${WEB_APP_PATH}/index.php"
composer_dest_path="${WEB_APP_PATH}/composer.json"
htaccess_dest_path="${WEB_APP_PATH}/.htaccess"



cp ./src/index.php ${index_dest_path}
cp ./src/composer.json ${composer_dest_path}
cp ./src/.htaccess ${htaccess_dest_path}



(cd ${WEB_APP_PATH} && "${cwd}/init-venv.sh")
