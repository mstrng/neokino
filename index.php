<!DOCTYPE html>
<html lang="ca">
<head>	
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Dusk Kino</title>
	<link rel="icon" type="image/png" href="./favicon.apng" sizes="32x32">
</head>
<body>

<?php

function link_from_file(string $filename, string $name = null, string $css_class = null ) : string {
	// Check if css_class is null
	$css_class = $css_class ? "class=\"$css_class\"" : '';
	// Check if name is null
	$name = $name ?: basename($filename);
	return sprintf('<a href=%s %s>%s</a>', $filename, $css_class, $name);
}

function filter_files_dir($files_array, string $path) : array {
	$ret_array = ['dir' => [], 'file' => []];
	foreach($files_array as $file) {
		if(is_dir($path . $file)) {
			// Append dir to array
			$ret_array['dir'][] = $file;
		}
		else {
			// Append file to array
			$ret_array['file'][] = $file;
		}
	}
	return $ret_array;
}

// Debug
//var_dump($_SERVER);
// Debug

// Debug
//var_dump($files_in_folder);
// Debug

$not_found_error = '<h1>File not found, error 404</h1>';

if(!$files_in_folder) {
	echo($not_found_error);
	die();
}

$basedir = 'content';
$request_uri = $_SERVER['REQUEST_URI'];

$path = $basedir . $request_uri;
$files_in_folder = scandir($path);

$resource_array = filter_files_dir($files_in_folder, $path);

// Show folder links
{
	foreach($resource_array['dir'] as $dir) {
		if(substr($dir, 0, 1) == '.') {
			continue;
		}
		echo(link_from_file($request_uri . $dir));
		echo('<br/>');
	}
	echo('<hr/>');
}

//Show file links
{
	foreach($resource_array['file'] as $file) {
		if(substr($file, 0, 1) == '.') {
			continue;
		}
		echo(link_from_file($request_uri . $file));
		echo('<br/>');
	}
	echo('<hr/>');
}

?>

</body>
</html>
