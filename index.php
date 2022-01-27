<!DOCTYPE html>
<html>
<?php

include 'include/header.php';

function link_from_file(string $filename, string $name = null, string $css_class = null ) : string {
	// Check if css_class is null
	$css_class = $css_class ? " class=\"$css_class\"" : '';
	// Check if name is null
	$name = $name ?: basename($filename);
	return sprintf('<a href=%s%s>%s</a>', $filename, $css_class, $name);
}

function filter_files_dir($files_array, string $path) : array {
	$ret_array = ['dir' => [], 'file' => []];
	foreach($files_array as $file) {
		// Hidden Files are not shown
		if(substr($file, 0, 1) == '.') {
			continue;
		}
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

echo($header);
echo("\n");

?>
<body>
	<h1>Magatzem de Dusk</h1>
<?php

// Debug
//var_dump($_SERVER);
// Debug

// Debug
//var_dump($files_in_folder);
// Debug

$not_found_error = '<h1>File not found, error 404</h1>';

$basedir = 'content';
$request_uri = $_SERVER['REQUEST_URI'];

$path = $basedir . $request_uri;

if(!is_dir($path)) {
	echo($not_found_error);
	die();
}

$files_in_folder = scandir($path);
$resource_array = filter_files_dir($files_in_folder, $path);

// Show folder links
{
	if(!empty($resource_array['dir'])) {
		echo('<h2>Directoris</h2>');
	}
	echo('<ul>');
	foreach($resource_array['dir'] as $dir) {
		echo('<li>' . link_from_file($request_uri . $dir, null, "dir_link") . '</li>');
		echo('<br/>');
	}
	echo('</ul>');
}

echo("\n");

//Show file links
{
	if(!empty($resource_array['file'])) {
		echo('<h2>Fitxers</h2>');
	}
	echo('<ul>');
	foreach($resource_array['file'] as $file) {
		echo('<li>' . link_from_file($request_uri . $file, null, 'file_link') . '</li>');
		echo('<br/>');
	}
	echo('</ul>');
}

echo("\n");

?>
</body>
</html>
