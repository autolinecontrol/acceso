<?php
$DBhost = "localhost";
 $DBuser = "autoline2020_acceso";
 $DBpass = "Acceso2020*";
 $DBname = "autoline2020_teleport";
 
 try{
  
  $DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
 }catch(PDOException $ex){
  
  die($ex->getMessage());
 }
