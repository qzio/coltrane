<?php
define('PROJECT_PATH', dirname(__FILE__));
if (is_dir(PROJECT_PATH . '/coltrane')) {
	require PROJECT_PATH . '/coltrane/coltrane.php';
} else {
	require 'coltrane/coltrane.php';
}
if (is_file(PROJECT_PATH . '/config.php')) {
	require PROJECT_PATH . '/config.php';
}
