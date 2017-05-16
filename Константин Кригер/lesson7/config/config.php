<?php
define('SITE_ROOT', "../");
define('WWW_ROOT', SITE_ROOT . '/public');

/* DB config */
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'test');

define('DATA_DIR', SITE_ROOT . 'data');
define('LIB_DIR', SITE_ROOT . 'engine');
define('TPL_DIR', SITE_ROOT . 'templates');

define('SALT2', 'awOIHO@EN@Oine q2enq2kbkb');

define('SITE_TITLE', '���� 5');


error_reporting( E_ERROR );



require_once(LIB_DIR . '/functions.php');
require_once(LIB_DIR . '/db.php');

