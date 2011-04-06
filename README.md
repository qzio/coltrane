# Coltrane - small framework for the small hacks

coltrane comes out of need for some kind of simple mvc structure for small rest-like php apps.
Without much overhead or fancy features.

everything in lib/ is required automatically, just drop whatever libs or modules you have there.

## directory structure 

		public/									# document root of the project
			| - posts.php					# blog posts controller
			| -	other static files, css, images etc

		templates/							# template files (views)
			| - posts.php

		lib/										# everything here is auto required by bootstrap.php
			| - helpers.php				# default helpers
			| - restish.php				# defines the is_get is_post is_put is_delete functions..
			| - other library, helper and model files


# TODO
"With rewrite" is the preffered way to go if possible, nicer urls is also a nice addition ;)
	- see rewrite rule for different http deamons at the bottom of this readme


# some examples with comments

## public/hello.php (controller)

		<?php
		require '../bootstrap.php';

		function on_before( $params = array() ) {
			// before filter
			return $params;
		}

		function on_get( $params = array() ) {
			$p['title'] = 'Hello World';

			if ( $params['name'] ) {
				$p['name'] = $params['name'];
			} else {
				$p['name'] = 'Unknown';
			}

			return render( basename(__FILE__), $p );
		}

		function on_post( $params = array() ) {
				// create a resource

		}

		function on_put($params = array() ) {
				// update a resource
		}

		function on_delete( $params = array() ) {
				// delete a resource

		}

		run(basename(__FILE__,'.php')); // this is the dispatcher


## templates/hello.php (template)

		<h1><?=h( $p['title'] )?></h1>
		<p>
			greetings <?=h( $p['name'] )?>, or did I get your name correctly?
    </p>

		<?php
			/**
			 * form_start with method = put will actually create a <form method="post">
			 *	and add a <input type="hidden" name="_method" value="put"/> in order return correct method.
			 */
			?>
		<?= form_start(array('method'=> 'get')) ?>
			<fieldset>
				<input type="text" name="name"/>
				<input type="submit"/>
			</fieldset>
		</form>

## templates/layout.php (autoincluded if the first argument to template() doesn't start with _

		<!DOCTYPE html !>
		<html>
			<head>
				<title><?=h( $p['title'] )?></title>
			<body>
				<?= $p['_content'];?>
			</body>
		</html>
