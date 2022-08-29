<?php
//This sscript is used for upload image for your website in our server.
if (isset($_POST['submit']))
{
	$file = $_FILES['file'];
	print_r($file);
	$fileName = $_FILES['file']['name'];
}