#!/bin/bash
./exit-on-uncommitted-changes.sh
echo "Updating web app"
WEB_APP_PATH="/Applications/XAMPP/xamppfiles/htdocs/slimapp"

index_dest_path="${WEB_APP_PATH}/index.php"

cp index.php index_dest_path