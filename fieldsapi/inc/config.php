<?php
require_once(PROJECT_ROOT_PATH . '/../config.php');

define("DB_HOST", $CFG->dbhost);
define("DB_USERNAME", $CFG->dbuser);
define("DB_PASSWORD", $CFG->dbpass);
define("DB_DATABASE_NAME", $CFG->dbname);
define("PREFIX", $CFG->prefix);