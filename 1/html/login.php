<?php

        if(!isset($_POST['submit'])){

        require("index.php");
        $account = $_POST['email'];
        $password = $_POST['password'];

        if ($account != NULL && $password != NULL) {//如果用戶名和密碼都不為空
                $sql = "select account_email from account where account_email = '$account' and account_password = '$password'";//檢測數據庫是否有對應的username和password的sql
                $result = mysqli_query($link,$sql);//執行sql
                $rows = mysqli_num_rows($result);//返回一個數值
                if($rows==1) {//0 false 1 true
                        setcookie("account",$account,time()+3600);
                        header("refresh:0;url=index-in.php");
                          }
                else{         
                        echo "<script>alert('帳號或密碼有誤！');</script>";
                        header("refresh:0;url=index.html");
                          }
                                    }
        else {//如果用戶名或密碼有空
                echo "<script>alert('帳號或密碼有空！');</script>";
                header("refresh:0;url=index.html");
             }
        }//判斷是否有submit操作
 ?>