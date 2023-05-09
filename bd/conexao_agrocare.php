
<?php
    global $servername ;
    global $username;
    global $password;
    global $database;

    $servername = "localhost";
    $username = "agrocare";
    $password = " ";
    $database = "agrocarefinal";


    $connectbd=mysqli_connect($servername, $username, $password, $database);
    if(!$connectbd) {
        die('Erro de conexão: '.mysqli_connect_error());
    } 
?>



