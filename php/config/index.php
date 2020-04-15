<?php
//This is the configuration script for the website
function DBCONNECTION() //connect to the DB
{
    $server = 'localhost';
    $user = 'root';
    $password = 'adebomi';
    $connName = 'dashingsplash';
    $port = 8080;
    global $conn;
    $conn = mysqli_connect($server,$user,$password,$connName,$port);
     if($conn) {
            return 'CONNECTION MADE';
            return '<p>Connection OK '. $conn->host_info.'</p>';
            return '<p>Server '.$conn->server_info.'</p>';
     } else {
            die('CONNECTION REFUSED,PLEASE CHECK CONNECTION INFO WELL'. mysqli_connect_error());
            die('Connect Error (' . $conn->connect_errno . ') '
                . $conn->connect_error);
     }
}
$x = DBCONNECTION();
function USERS($conn)
{  
    $table = "CREATE TABLE if not exists users(
    id INT(11) AUTO_INCREMENT,
    FIRSTNAME VARCHAR(255) NOT NULL,
    LASTNAME VARCHAR(255) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    PASSWORD VARCHAR(255)  NULL,
    REGTIME TIMESTAMP  NULL,
    REGCODE VARCHAR(10) NULL,
    REFCODE VARCHAR(10) NULL,
    MYCODE VARCHAR(10) NULL,
    AMOUNT INT NULL,
    ADMIN INT NULL,
    PRIMARY KEY(id)
    )";
    if(mysqli_query($conn,$table)) {
        return 'TABLE SUCCESSFULLY CREATED FOR USERS';
    } else {
        return 'TABLE UNSUCCESSFULLY CREATED for USERS';
    }
}
USERS($conn);
?>