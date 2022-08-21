#!/bin/bash
set -e

./exit-on-uncommitted-changes.sh
echo "Updating web app"
WEB_APP_PATH="/Applications/XAMPP/xamppfiles/htdocs/slimapp"
cwd=$(pwd)


index_dest_path="${WEB_APP_PATH}/index.php"

cp ./src/index.php ${index_dest_path}

(cd ${WEB_APP_PATH} && "./${cwd}/init-venv.sh")
