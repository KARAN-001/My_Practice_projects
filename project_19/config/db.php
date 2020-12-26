<?php
function doDB() {
     global $con;
    
    //connect to server and select database
 $con = mysqli_connect("localhost", "root",
     "", "mailer");

     //if connection fails, stop script execution
     if (mysqli_connect_errno()) {
     printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
     }
     }
     function check_mail($email){
        global $con,$check_mail,$res;
        $check_mail=mysqli_real_escape_string($con,$email);
        $sql="SELECT sub_id FROM `subscriber` WHERE email='".$check_mail. "' ";
        $res=mysqli_query($con,$sql) or die(mysqli_error($con)) ;
    }

?>