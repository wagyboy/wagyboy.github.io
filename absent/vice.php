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
    </ul>
    <label id="icon">
      <i class="fas fa-bars"></i>
    </label>
  </nav>
  <div class="container">

    <table>
      <thead>
        <tr>
          <th>姓名</th>
          <th>座號</th>
          <th>出缺席狀況</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = "SELECT * FROM cur_absent";
        $query = mysqli_query($link, $result);
        while ($data = mysqli_fetch_assoc($query)) {
          echo "<td>" . $data["s_name"] . "</td>";
          echo "<td>" . $data["s_aid"] . "</td>";
          if ($data['s_absent'] == '出席'){
            echo "<td class='present'>". '<a href="update-index.php?aid=' . $data['s_aid'] . '&absent=缺席">'."出席".'</a></td>' ;
          }
          elseif($data['s_absent'] == '缺席'){
            echo "<td class='absent'>". '<a href="update-index.php?aid=' . $data['s_aid'] . '&absent=出席">'."缺席".'</a></td>' ;
          }
          echo "</tr>";
        }

        ?>
      </tbody>
    </table>
  </div>
  <footer class="footer">
    <p>2023 嘉義高商</p>
  </footer>
  <?php

  mysqli_close($link);

  ?>
</body>

</html>