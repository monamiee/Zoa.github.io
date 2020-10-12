<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "userlogindata";

$connection = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$connection)
{
    die("Connection Failed : ".mysqli_connect_error());
}