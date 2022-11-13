
<!DOCTYPE html>
<html>
<head>
<title>農場羊隻監控管理－異常紀錄</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<div class="bgded" style="background-image:url('images/demo/backgrounds/banner.jpg');"> 
  <!-- ################################################################################################ -->
  <div class="wrapper overlay">
    <header id="header" class="hoc clear">
      <nav id="mainav" class="clear"> 
        <!-- ################################################################################################ -->
        <ul class="clear">
          <li><a href="index-in.php">首頁</a></li>
          <li><a href="video.php">即時監控</a></li>
          <li class="active"><a href="miss.php">異常紀錄</a></li>
          <li><a onclick="location.href='logout.php'" href="#contact">登出</a></li>
        </ul>
        <!-- ################################################################################################ -->
      </nav>
    </header>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div id="pageintro1" class="hoc clear"> 
    <!-- ################################################################################################ -->

<!-- 查詢指定日期 -->
<?php

require("index.php");
$link->query("SET NAMES 'utf8'");

$date = '';
if (isset($_GET['get_date'])) {
	$date = $_GET['get_date'];
}
else{
  $date = $_COOKIE['date'];
}

//判斷日期是否為空
if (!isset($_POST['submit'])) {
  if ($date != NULL) {//如果日期不為空
      $sql = "select * from goat where Date = '$date'";//檢測數據庫是否有對應的date的sql
      $result = mysqli_query($link,$sql);//執行sql
      $row1 = mysqli_num_rows($result);//返回一個數值
      if($row1) {//0 false 1 true
      }
      else{
        echo "<script>alert('查無此日期的資料！');</script>";
        header("refresh:0;url=miss.php");
      }
  }
}
?>
    <article>
      <div class="introtxt">
      <!--查詢指定日期-->
      <form>
        <table id="search-table" method="GET" data-sb-form-api-token="API_TOKEN">
        <tr>
          <th>選擇日期：</th>
          <th><input name="get_date" type="date" value="<?= $date ?>"></th>
          <th><a><input type="submit" method="POST" class="btn1" value="查詢"></a></input></th>
        </tr>
        </form>
        </table>
        
        <table id="miss-table">
          <tr>
          <td>日期</td>
          <th>時間</th>
          <th>異常影像</th>
          <th>功能</th>
          </tr>
          <!-- 大括號的上、下半部分 分別用 PHP 拆開 ，這樣中間就可以純用HTML語法-->

<?php
if(mysqli_num_rows($result) > 0)
{
foreach($result as $row)
{
?>
            <tr>
                <!-- $row['(輸入資料表的欄位名稱)'];  <<用雙引號也行 -->
                <td><?php echo $row['Date']; ?></td> 
                <td><?php echo $row['Time']; ?></td>

                <td>
                  <ul class="nospace inline pushright">
                    <li>
                    <form action="revise.php" method="POST" data-sb-form-api-token="API_TOKEN"> 
                        <input type="hidden" name="revise_id" value="<?php echo $row['Date']; ?>">
                        <button name="revise_goat" class="btn1">觀看</button>

                    </form>
                    </li>
                  </ul>
                </td>
                <td>
                  <ul class="nospace inline pushright">
                    <li>
                    <form action="del.php" method="POST" data-sb-form-api-token="API_TOKEN"> 
                        <!-- 下面有個 input type="hidden" 是讓待會的PHP 知道要刪除哪一筆資料 -->
                        <input type="hidden" name="delete_id" value="<?php echo $row['Date']; ?>">
                        <button name="delete_goat" class="btn1 inverse" onclick="javascript:return del();">刪除</button>
                    </form>
                    </li>
                    </ul>
                </td>
            </tr>
<?php
  }
}
?>
          </table>
          <ul class="nospace inline pushright">
            <li><a href="miss.php"><input type="button" class="btn1" name="back" value="返回"></a></input></li>
          </ul>
      </div>
    </article>
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->

<script type="text/javascript">
  function del() 
  {
	var msg = "您真的確定要刪除嗎？\n\n請確認！";
	if (confirm(msg)==true)
	{
		return true;
	}
	else
	{
		return false;
	}
};
</script>
</body>
</html>