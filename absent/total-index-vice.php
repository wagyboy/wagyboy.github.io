<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>出缺席管理系統</title>
  <link rel="stylesheet" href="style.css" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="fontawesome-free-6.3.0-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script>
        $(document).ready(function(){
            $('#icon').click(function(){
                $('ul').toggleClass('show');
            });
        });
    </script>
</head>

<body>
  <?php
  $thisdate = date("Y-m-d");
  session_start();
  if ($_SESSION["login_session"] != true)
    header("Location: login.php");
  $link = mysqli_connect(
    "localhost",
    "root",
    "",
    "absentsystem"
  )
    or die("無法開啟MySQL資料庫連接!<br/>");
  $date = date('Y-m-d');
  if (isset($_POST["date"])) {
    $date = $_POST["date"];
  }
  //isset()函數檢查$_POST["todaysend"]變數是否存在
  if (isset($_POST["todaysend"]) && $_POST["todaysend"] == "yes") {
    $ff="SELECT * FROM st_absent WHERE $thisdate";
    $sql = mysqli_query($link,$ff);
    $totalp=mysqli_num_rows($sql);
    if($totalp < 1){
      $stsql = "SELECT * FROM allpeople";
      $stquery = mysqli_query($link, $stsql);
      while ($stdata = mysqli_fetch_assoc($stquery)) {
        $insert = "INSERT INTO st_absent (s_date,s_aid,s_name) VALUES ('" . $thisdate . "','" . $stdata['s_aid'] . "','" . $stdata['s_name'] . "')";
        mysqli_query($link, $insert);
      }
    }
    }
  $sql = "SELECT * FROM st_absent LEFT JOIN allpeople ON allpeople.s_aid=st_absent.s_aid WHERE s_date='$date'";
  $query = mysqli_query($link, $sql);
  ?>
  <nav class="top">
        
        <!-- *************************************** -->
        <h1 class="tit">嘉義高商出缺席管理系統</h1>
        <ul>
            <li>
                <a class="link active" href="vice.php">目前出缺席</a>
            </li>
            <li>
                <a class="link" href="total-index-vice.php">總共出缺席</a>
            </li>
            <li>
                <a class="btn" href="login.php">登出</a>
            </li>
            <li class="dateblock">
                <div class="datepicker">
                    <form action="" autocomplete="off" method="POST">
                        <label for="date" class="datetext">選擇日期：</label>
                        <input type="date" id="date" name="date" />
                        <button>查詢</button>
                    </form>
                </div>
            </li>
        </ul>
        <label id="icon">
            <i class="fas fa-bars"></i>
        </label>
    </nav>
  <div class="container">
    <form method="post"><input name="todaysend" value="yes"><button type="submit">產生今天簽到表</button></form>
    <table>
      <thead>
        <tr>
          <th>日期</th>
          <th>姓名</th>
          <th>座號</th>
          <th>節一</th>
          <th>節二</th>
          <th>節三</th>
          <th>節四</th>
          <th>節五</th>
          <th>節六</th>
          <th>節七</th>
          <th>節八</th>
        </tr>
      </thead>
      <tbody>
        <?php

        while ($data = mysqli_fetch_assoc($query)) {
          $absentAry = array("<div class='absent'>❌</div>", "<div class='present'>✅</div>");
          echo "<tr>";
          echo "<td class='date'>" . $data['s_date'] . "</td>";
          echo "<td class='name'>" . $data['s_name'] . "</td>";
          echo "<td class='aid'>" . $data['s_aid'] . "</td>";
          for ($i = 1; $i <= 8; $i++) {
            if ($data['s_absent'][$i - 1] == 0) {
              echo '<td class="absent"><a href="update-total.php?aid=' . $data['s_aid'] . '&date=' . $data['s_date'] . '&period=' . $i . '&absent=1">❌</a></td>';
            } else {
              echo '<td class="present"><a href="update-total.php?aid=' . $data['s_aid'] . '&date=' . $data['s_date'] . '&period=' . $i . '&absent=0">✅</a></td>';
            }
            echo "</td>";
          }
        }
        ?>
      </tbody>
    </table>
  </div>
  <footer class="footer">
    <p>2023 嘉義高商</p>
  </footer>
</body>

</html>