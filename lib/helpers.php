<?php
/**
 * return a form tag
 */
function form_start($params = array()) {
	$r = '<form method="post" action="'.h($params['action']).'">';
	if ($params['method'] &&
	   	in_array($params['method'], array('put', 'delete'))) {

		$r .= '<input type="hidden" class="hidden" '.
			'name="_method" value="'.$params['method'].'"/>';
	}
	return $r;
}

/**
 * return a sanitized html safe string
 */
function h($str) {
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8', false);
}
/**
 * simple template function which will inclide the $file from /templates if found
 * @param string $file to look for
 * @param array $params variables to extract
 * @return void
 */
function template($file,$params = array()) {
	$use_layout = (substr(basename($file),0,1) !== '_' && ! isset($params['_no_layout']) ) ? true : false;
	$template_paths = BOOTSTRAP_DIR.'/templates';
	//$template = basename($file);
	$template = $file;
	$render_me = $template_paths.'/'.$template;
	ob_start();
		if ( (strpos($render_me, '..') === false) && is_file($render_me) ) {
			$p = $params;
			require $render_me;
		} else {
			require $template_paths.'/error.php';
		}
	$p['_content'] = ob_get_clean();
	$p['_no_layout'] = true;
	return ($use_layout) ? template('layout.php',$p) : $p['_content'];
}

