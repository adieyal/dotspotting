<?php

	#
	# $Id$
	#

	#################################################################

	function formats_valid_import_map($key_by_extension=0){

		$map = array(
			'text/csv' => 'csv',
			'application/x-javascript' => 'json',
			'application/vnd.google-earth.kml+xml' => 'kml',
			'application/rss+xml' => 'rss',
			'application/vnd.ms-excel' => 'xls',
		);

		# TODO: fix me so that this will work for mime-types
		# with multiple valid extensions (20101215/straup)

		if ($key_by_extension){
			$map = array_flip($map);
		}

		return $map;
	}

	#################################################################

	function formats_valid_export_map($key_by_extension=0){

		$map = array(
			'text/csv' => 'csv',
			'application/x-javascript' => 'json',
			'application/vnd.google-earth.kml+xml' => 'kml',
			'application/rss+xml' => 'rss',
			'application/vnd.ms-excel' => 'xls',
			# 'foo/bar' => 'pdf',
		);

		# Ensure that we can actually generate PNG files

		if (function_exists('imagecreatetruecolor')){
			$map['image/png'] = 'png';
		}

		if ($key_by_extension){
			$map = array_flip($map);
		}

		return $map;
	}

	#################################################################

	function formats_valid_import_list($sep=', '){

		$map = formats_valid_import_map('key by extension');

		$things_with_geo = array(
			'json',
			'rss',
		);

		$list = array();

		foreach (array_keys($map) as $format){

			$prefix = '';

			if (in_array($format, $things_with_geo)){
				$prefix = 'Geo';
			}

			$list[] = $prefix . strtoupper($format);
		}

		sort($list);

		return implode($sep, $list);
	}

	#################################################################
?>