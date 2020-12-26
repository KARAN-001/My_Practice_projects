<?php


function dbcon()
{
    global $con;
    $con = mysqli_connect("localhost", "root", "", "storefront");

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
}
?>