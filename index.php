<?php

error_reporting(1);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require 'common.php';
require 'rb.php';
R::setup('mysql:host=localhost;dbname=white_agency', 'whiteagencytest','r7SzsbnLvqYvefJA'); //for both mysql or mariaDB
R::freeze( true ); //will freeze redbeanphp
// R::debug( TRUE );

$error = array(); // set the error array to null
$fields = array('name', 'email', 'comment');

//print debug_all();

$params = get_params();

require 'error_check.php';
?>


<html>
<head>
<title>White Agency Example</title>
</head>
<body>

<?php require 'form.php'; ?>

<?php require 'comments.php'; ?>


</body>
</html>
