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
	$template_paths = BOOTSTRAP_DIR.'/templates';
	$template = basename($file);
	$render_me = $template_paths.'/'.$template;
	ob_start();
		if ( (strpos($render_me, '..') === false) && is_file($render_me) ) {
			$p = $params;
			require $render_me;
		} else {
			require $template_paths.'/error.php';
		}
	$content = ob_get_clean();
	return $content;
}
