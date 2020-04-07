<?php
$DBhost = "localhost";
 $DBuser = "acceso";
 $DBpass = "Ugc2020$%";
 $DBname = "mgeiqybt_cap";
 
 try{
  
  $DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
 }catch(PDOException $ex){
  
  die($ex->getMessage());
 }
