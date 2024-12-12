<?php
$con=new mysqli('localhost','root','ichrak','voyage');
if(!$con){
    die(mysqli_error($con));
}