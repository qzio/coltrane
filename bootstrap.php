<?php
define('BOOTSTRAP_DIR', dirname(__FILE__));
require BOOTSTRAP_DIR.'/config.php';

function require_libs($path = '')
{
	foreach ( glob( $path.'/*' ) as $p ) {
		if (is_dir($p))
			require_libs( $p );
		else if ( is_file($p) && substr(basename($p),-4,4) == '.php')
			require $p;
	}

}

require_libs(BOOTSTRAP_DIR.'/lib'); // require all the libraries recursevly

db::setConnectionInfo(cfg::db_name, cfg::db_user, cfg::db_password);
$p = array(); // use this var, it will be automatically extracted upon default render 
