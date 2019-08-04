<?php

   $dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "";
   $db = "crisanto_thesis";


   $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

   if(!$conn) {
     die("Connection failed: ".mysqli_connect_error());
   }
