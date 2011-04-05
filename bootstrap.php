<?php
define('BOOTSTRAP_DIR', dirname(__FILE__));
session_start();
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
