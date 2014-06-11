<?php
$hostname = "127.0.0.1";
$database = "examBookPlus";
$username = "root";
$password = "release0";

$data = mysql_pconnect($hostname, $username, $password) 
	or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database, $data);

//                            __                    
 //    ____                   / _|                   
 //   / __ \  __ _  ___  ___ | |_ ___ _ __ _ __  ____
 //  / / _` |/ _` |/ _ \/ _ \|  _/ _ \ '__| '_ \|_  /
 // | | (_| | (_| |  __/ (_) | ||  __/ |  | | | |/ / 
 //  \ \__,_|\__, |\___|\___/|_| \___|_|  |_| |_/___|
 //   \____/  __/ |                                  
 //          |___/            www.geofernz.com    

?>