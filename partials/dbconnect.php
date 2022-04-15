<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gca_quora";

$conn = mysqli_connect($servername , $username , $password , $database);
if(!$conn){
    die("Connection was not successful" . mysqli_connect_errno());
}
// else{
//     echo "Connection was successful.";
// }
?>