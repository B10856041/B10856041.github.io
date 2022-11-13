<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

        if(!isset($_POST['forget'])){
                exit("錯誤執行");
        }//判斷是否有submit操作

        require("index.php");
        $account = $_POST['email'];

        if ($account != NULL) {//如果用戶名和密碼都不為空
                $sql = "select account_email from account where account_email = '$account'";//檢測數據庫是否有對應的username和password的sql        
                $result = mysqli_query($link,$sql);//執行sql        
                $a=mysqli_num_rows($result);//返回一個數值

                if($a) {//0 false 1 true
                        $password = "select account_password from account where account_email = '$account'";
                        $result_1 = mysqli_query($link,$password);
                        foreach($result_1 as $rows) {

                                $subject = '原始密碼！！';  
                                                    
                                mail($account, $subject,$rows['account_password']);
                           
                                echo "<script>alert('密碼已成功寄送到信箱!');</script>";
                                header("refresh:0;url=index.html");
                                                    }              
                       }
                else{         
                        echo "<script>alert('信箱錯誤!');</script>";
                        header("refresh:0;url=index-forgot.php");
                    }
                              }
        else {//如果用戶名或密碼有空
                echo "<script>alert('輸入信箱不能為空!');</script>";
                header("refresh:0;url=index-forgot.php");
             }

 ?>