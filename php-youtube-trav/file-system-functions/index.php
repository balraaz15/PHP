<?php
	# FILE SYSTEM FUNCTIONS

	$path = '/dir1/dir2/dir3/myfile.php';
	$file = 'file1.txt';

	// Return filename
	echo basename($path); // myfile.php
	echo "<br>";
	// Return filename without extension
	echo basename($path, '.php'); // myfile
	echo "<br>";

	// Return the directory name from the path
	echo dirname($path); // /dir1/dir2/dir3
	echo "<br>";

	// Check if the specific file exists
	// file_exists() - checks boths files and folders
	echo file_exists($file); // returns true(1)
	echo "<br>";

	// Get absolute path
	echo realpath($file);
	echo "<br>";

	// Check to see if file
	// is_file() - only checks the existence of files not folders
	echo is_file($file); // returns true(1)
	echo "<br>";

	// Check if file is writable
	echo is_writable($file);
	echo "<br>";
	// Check if the file is readable
	echo is_readable($file);
	echo "<br>";

	// Get file size
	echo filesize($file);
	echo "<br>";


	# MANIPULATE FILE SYSTEM

	// Create directory
	// mkdir('test-directory');
	// Remove directory - removes if there are no files
	// rmdir('test-directory');

	// Copy file
	// copy('file1.txt', 'file2.txt');

	// Rename file
	// rename('file2.txt', 'myfile.txt');

	// Delete file
	// unlink('myfile.txt');

	// Write from file to string
	// echo file_get_contents($file);

	// Write string to file - replaces file content
	// echo file_put_contents($file, 'Goodbye World');

	// Write string to file - Append
	/*$current = file_get_contents($file);
	$current .= ' Goodbye World';
	file_put_contents($file, $current);*/

	/*
	// Open file for reaading
	$handle = fopen($file, 'r');
	$data = fread($handle, filesize($file));
	echo $data;
	fclose($handle);
	*/

	/*
	// Open file for writing
	$handle = fopen('file2.txt', 'w'); // creates a new file
	$txt = "John Doe\n";
	fwrite($handle, $txt);
	// Continuoulsy write:
	$txt = "Steve Smith\n";
	fwrite($handle, $txt);
	fclose($handle);
	*/
?>