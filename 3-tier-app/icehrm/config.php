<?php
ini_set('error_log', 'data/icehrm.log');

define('APP_NAME', 'Acme HRM');
define('FB_URL', 'Ice Hrm');
define('TWITTER_URL', 'Ice Hrm');

define('CLIENT_NAME', 'app');
define('APP_BASE_PATH', '/var/www/icehrm/core/');
define('CLIENT_BASE_PATH', '/var/www/icehrm/app');
define('BASE_URL','/web/');
define('CLIENT_BASE_URL','/app/');

define('APP_DB', 'hrms');
define('APP_USERNAME', 'hrms_user');
define('APP_PASSWORD', 'This_is_my_pa$$w0rd');
define('APP_HOST', 'hrm-db');
define('APP_CON_STR', 'mysqli://'.APP_USERNAME.':'.APP_PASSWORD.'@'.APP_HOST.'/'.APP_DB);

//file upload
define('FILE_TYPES', 'jpg,png,jpeg');
define('MAX_FILE_SIZE_KB', 10 * 1024);
