<?php
include 'config/db.php';
$display_block= NULL;
if(!$_POST){
    $display_block =<<< END_OF_BLOCK
    <form  method="POST" action="$_SERVER[PHP_SELF]">

      <p><label for ="subject">Subject:</label><br />
      <input type="text" id="subject" name="subject" size=40/></p> 

      <p><label for = "message">Mail Body:</label><br />
      <textarea id="message" name="message" cols="50" rows="10"></textarea></p>
      <button type="submit" name="submit" value="submit">Submit</button>

    </form>
END_OF_BLOCK;
}
elseif ($_POST)
{
 if(($_POST['subject']=="")||($_POST['message']=="")){
     header("location:sendmymail.php");
     exit;
}
doDB();
if(mysqli_connect_errno()){
    printf("connecton failed:%s\n",mysqli_connect_errno());
    exit;
}
else{
    $sql="SELECT `email` FROM `subscriber`";
    $res=mysqli_query($con,$sql) or die(mysqli_error($con));
  
    $mailheader="from:1.karan.kp21@gmail.com";

    while($row=mysqli_fetch_array($res)){
        set_time_limit(0);
        $email=$row['email'];
        mail("$email",stripslashes($_POST['subject']),
        stripslashes($_POST['message']), $mailheader);

         $display_block .="newsletter sent to:".$email."<br/>";
         }
         mysqli_free_result($res);
         mysqli_close($con);
    }
}
?>

<!DOCTYPE html>
 <html>
 <head>
 <title>Sending a Newsletter</title>
 </head>
 <body>
 <h1>Send a Newsletter</h1>
 <?php echo $display_block; ?>
 </body>
 </html>  




