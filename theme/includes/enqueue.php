<?php

	function enqueue_stuff() {

		$templatedir = get_template_directory_uri();
		$enqueList = [	
			[
				"name" => 'select-2.css', 
				"type" => 'css',
				"path" => 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
				"version" => '4.1.0'
			],
			[
				"name" => 'style.css', 
				"type" => 'css',
				"path" => $templatedir . '/style.css',
				"version" => filemtime(get_theme_file_path('/style.css'))
			],
			[
				"name" => 'jquery.js', 
				"type" => 'js',
				"path" => 'https://code.jquery.com/jquery-3.3.1.min.js',
				"version" => '3.3.1',
				"loadInFooter" => false
			],
			[
				"name" => 'select-2.js', 
				"type" => 'js',
				"path" => 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
				"version" => '4.1.0',
				"loadInFooter" => true
			],
			[
				"name" => 'products.js', 
				"type" => 'js',
				"path" => $templatedir . '/assets/js/products.js',
				"version" => '1.0.0',
				"loadInFooter" => true
			],
		];
		
		foreach($enqueList as $asset) {	
			if ($asset['type'] === 'css') {
				wp_enqueue_style( 
					'ff_'.$asset['name'],  	// handle
					$asset['path'], 			// src
					null, 						// deps
					$asset['version'] 			// ver
				);	
			}	
			if ($asset['type'] === 'js') {
				wp_enqueue_script( 
					'ff_'.$asset['name'],  	// handle
					$asset['path'], 			// src
					array(), 					// deps
					$asset['version'], 			// ver
					$asset['loadInFooter']		// in footer
				);	
			}
		}
	} 
	
	add_action( 'wp_enqueue_scripts', 'enqueue_stuff' );
	
	
	// Function to defer or asynchronously load scripts for SEO Performance
	
	function js_async_attr($tag){	
		if (true == strpos($tag, 'defer') ) {
			 return str_replace( ' src', '  defer="defer" src', $tag ); 
		}
		return $tag;
	}
	add_filter( 'script_loader_tag', 'js_async_attr', 1 );


?>
