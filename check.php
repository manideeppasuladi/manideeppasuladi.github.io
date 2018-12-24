<?php
session_start();
$usern =  $_REQUEST['inputUsername'];
$pass = $_REQUEST['inputPassword'];
$host_name = 'localhost';
$db_user ='root';
$db_pass = '';
$db_name = 'mani';

$con = mysqli_connect($host_name, $db_user, $db_pass,$db_name) or die ("Couldn't connect!");

$statement = "select * from users  ";
$retval = mysqli_query($con,$statement);

if(!$retval){
    echo " not retval" ;
}
while($row = mysqli_fetch_array($retval))
{
   
    if( ($row['username'] == $usern) && ($row['password'] == $pass) )
    {
        
                $_SESSION['username'] = $usern;
                //header('location:home.php');
                $count=1;
        
   }
    else 
    {   
        $_SESSION['errMsg'] = "Invalid username or password";
        header('location:login.php');
    }
    
}
if($count == 1)
{
    header('location:home.php');
}
mysqli_close($con);

?>