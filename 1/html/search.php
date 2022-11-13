<?php session_start(); ?>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
        if(!isset($_POST['submit'])){

        require("index.php");
        $date = $_COOKIE["date"];

        if ($date != NULL) {//如果日期不為空
                $sql = "select date from goat where Date = '$date'";//檢測數據庫是否有對應的date的sql
                $result = mysqli_query($link,$sql);//執行sql
                $rows = mysqli_num_rows($result);//返回一個數值
                if($rows) {//0 false 1 true
                        setcookie("date",$date,time()+3600);
                        header("refresh:0;url=miss-search.php");
                }
                else{         
                        echo "<script>alert('查無此日期的資料！');</script>";
                        header("refresh:0;url=miss.html");
                }
                }

        else {//如果日期有空
                echo "<script>alert('請選擇日期！');</script>";
                header("refresh:0;url=miss.html");
             }
        }//判斷是否有submit操作
 ?>