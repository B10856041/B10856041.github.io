<?php

    header("Content-Type: text/html; charset=UTF-8");

    if(!isset($_POST['delete_goat'])){
        
    }//判斷是否有submit操作
    
    $id2 = $_POST['delete_id'];
    
    include("index.php");
    $link->query("SET NAMES 'utf8'");
    
	$query2 = "DELETE FROM `goat` WHERE `Date`='$id2'";
	$query_run2 = mysqli_query($link,$query2);


    if ($query_run2) {
        header("refresh:0;url=miss.php");
                     } 
    else {
        echo "錯誤: " ;
         }
?>