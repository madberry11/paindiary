<?php
$dbc = mysqli_connect("ap-cdbr-azure-east-c.cloudapp.net", "bcac3dbe9c1d06", "32d91723", "booksapp", "3306") //Connect to your Database (Localhost IP, Username, Password, Databasename, LocalPort)
OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );


mysqli_set_charset($dbc, 'utf8');

?>