{"AllUsers":[{
<?php
$timezone  = -5; //(GMT -5:00) EST (U.S. & Canada) 
$data = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I"))); 
//echo '"Ingreso":'.'"2019-03-12 08:00:00"';
echo '"Ingreso":"'.$data.'"';
//{"AllUsers":[{"Ingreso":"2019-03-12 08:00:00"}]}
?>
}]}
