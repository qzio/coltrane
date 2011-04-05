<?php

function is_get() {
	return (empty($_POST));
}

function is_put() {
	if (is_get()) return false;
	return (isset($_POST['_method']) && $_POST['_method'] == 'put');
}

function is_delete() {
	if (is_get()) return false;
	return (isset($_POST['_method']) && $_POST['_method'] == 'delete');
}

function is_post() {
	return ( is_get() || is_put() || is_delete() ) ? false : true;
}

function request_method()
{
	if ( is_get() ) return 'get';
	else if ( is_put() ) return 'put';
	else if ( is_delete() ) return 'delete';
	else if ( is_post() ) return 'post';
	else return 'unkown';
}

function redirect($uri) {
	header('location: ' . $uri);
	exit;
}

function run( $controller )
{
	if ( defined('USE_REWRITES') ) {
		require BOOTSTRAP_DIR.'/controllers/'.$controller.'.php';
	}

	$params = $_REQUEST;

	if (function_exists('on_before')) {
		$params = on_before($params);
	}

	$output = '';

	switch( request_method() ) {
	case 'put':
		if (function_exists('on_put'))
		   	$output = on_put($params);
		else
			$output = template('error.php', array('error' => 'on_put is not defined for this resource'));
		break;

	case 'post':
		if (function_exists('on_post'))
		   	$output = on_post($params);
		else
			$output = template('error.php', array('error' => 'on_post is not defined for this resource'));
		break;

	case 'delete':
		if (function_exists('on_delete'))
			$output = on_delete($params);
		else
			$output = template('error.php', array('error' => 'on_delete is not defined for this resource'));
		break;

	case 'get':
		if (function_exists('on_get'))
			$output = on_get($params);
		else
			$output = template('error.php', array('error' => 'on_get is not defined for this resource'));
		break;

	default:
		$output = template('error.php', array('error' =>'unable to dispatch'));
	}
	echo $output;
}
