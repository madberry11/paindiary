<?php
$dbc = mysqli_connect("127.0.0.1", "root", "", "booksapp", "3306") //Connect to your Database (Localhost IP, Username, Password, Databasename, LocalPort)
OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );


mysqli_set_charset($dbc, 'utf8');

?>