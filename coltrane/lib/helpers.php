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

