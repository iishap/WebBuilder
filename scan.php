<?php
$scandir = __DIR__ . '/media/';

//Run the recursive function
//this function scans the files and folders

$scan = function ($dir) use ($scandir, &$scan){
		$files = [];
		if (file_exists($dir)){
			foreach (scandir($dir) as $f) {
				if (! $f || $f[0] == '.'){
					continue; //ignore hidden files
				}
				if (is_dir($dir . '/' . $f)) {
					// the is a folder
					$files[] = [
							'name'  => $f
							'type'  => 'folder',
							'path'  => str_replace($scandir, '', $dir) . '/' . $f,
							'items' => $scan($dir . '/' . $f),
					];
				}else{
					$files[] = [
							'name'  => $f
							'type'  => 'file',
							'path'  => str_replace($scandir, '', $dir) . '/' . $f,
							'size'  => filesize($dir . '/' . $f),

					];
				}
			}
		}
		return $files; 
};

$reponse = $scan($scandir);

//output

header('content-type: application/json');
echo json_encode([
				'name'  => ''
				'type'  => 'folder',
				'path'  =>''
				'items' => $reponse
])		