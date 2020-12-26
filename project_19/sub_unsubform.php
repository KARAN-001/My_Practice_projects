<?php

include 'config/db.php';
if (!$_POST) {
    $display_block = <<< END_OF_BLOCK
<form method="POST" action="$_SERVER[PHP_SELF]" >
<p><label for="email">Your email address:</label><br />
<input type="email" id="email" name="email" maxlength=150 size=40> </p>
<fieldset>
 <legend>Action:</legend><br/>
 <input type="radio" id="action_sub" name="action"
 value="sub" checked />
 <label for="action_sub">subscribe</label><br/>
 <input type="radio" id="action_unsub" name="action"
 value="unsub" />
 <label for="action_unsub">unsubscribe</label>
 </fieldset>
 <button type="submit" name="submit"value="submit">Submit</button>
</form>

END_OF_BLOCK;
}
elseif(($_POST) AND ($_POST['action']=="sub")){
    if($_POST['email']==''){
        header("location:sub_unsub.php");
        exit;
    }
    else{
        
        doDB();
        check_mail($_POST['email']);
        if(mysqli_num_rows($res)<1)
        {
            mysqli_free_result($res);

               $sql_add="INSERT INTO `subscriber`(email) VALUES('".$check_mail."')";
               $res=mysqli_query($con,$sql_add);
               $display_block = "<p>Thanks for signing up!</p>";

 //close connection to MySQL
 mysqli_close($con);
 } 


else {
 //print failure message
 $display_block = "<p>You’re already subscribed!</p>";
 }
}
}
 else if (($_POST) && ($_POST['action'] == "unsub"))
  {
     //trying to unsubscribe; validate email address
     if ($_POST['email'] =="") {
    header("Location: sub_unsub.php");
     exit;
    }
     else {
    //con((nect to database
     doDB();
   
    //check that email is in list
     check_mail($_POST['email']);
    
    //get number of results and do action
     if (mysqli_num_rows($res) < 1) {
     //free result
   mysqli_free_result($res);
    
     //print failure message

            $display_block="<p>Couldn't find the Adress!</p>
            <p>No action was taken</p>";
        }
        else{
            while($row=mysqli_fetch_array($res)){
                $id=$row['sub_id'];
            }
            $sql_del="DELETE FROM `subscriber` WHERE `sub_id`=".$id;
            $del_res=mysqli_query($con, $sql_del)
             or die(mysqli_error($con));
             $display_block = "<p>You’re unsubscribed!</p>";
            }
            mysqli_close($con);
    }
}
?>
<!DOCTYPE html>
 <html>
 <head>
 <title>Subscribe/Unsubscribe to a Mailing List</title>
 </head>
 <body>
 <h1>Subscribe/Unsubscribe to a Mailing List</h1>
 <?php echo "$display_block" ?>
 </body>
 </html>