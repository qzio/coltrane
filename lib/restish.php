<?php

function is_get() {
	return (empty($_POST));
}

function is_put() {
	if (isGet()) return false;
	return (isset($_POST['_method']) && $_POST['_method'] == 'put');
}

function is_delete() {
	if (isGet()) return false;
	return (isset($_POST['_method']) && $_POST['_method'] == 'delete');
}

function is_post() {
	return ( is_get() || is_update() || is_delete() ) ? false : true;
}

function request_method()
{
	if ( is_get() ) return 'get';
	else if ( is_put() ) return 'put';
	else if ( is_delete() ) return 'delete';
	else if ( is_post() ) return 'post';
	else return 'unkown';
}

function run( $controller )
{
	if ( defined('USE_REWRITES') ) {
		require BOOTSTRAP_DIR.'/controllers/'.$controller.'.php';
	}

	$params = $_REQUEST;

	$output = '';

	switch( request_method() ) {
	case 'put':
		if (function_exists('on_put')) $output = on_put($params);
		break;
	case 'post':
		if (function_exists('on_post')) $output = on_post($params);
		break;
	case 'delete':
		if (function_exists('on_delete')) $output = on_delete($params);
		break;
	case 'get':
		if (function_exists('on_get')) $output = on_get($params);
		break;
	default:
		$output = template('error.php', array('error' =>'no request_method'));
	}

	return $output;
}
