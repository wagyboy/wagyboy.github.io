<!DOCTYPE html>
<html lang="zh-hant-tw">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>嘉義高商出缺席系統</title>
    <link rel="stylesheet" href="css.css">
</head>
<?php
session_start();

$username = "";  $password = ""; $level = "";

if ( isset($_POST["Username"]) )
   $username = $_POST["Username"];
if ( isset($_POST["Password"]) )
   $password = $_POST["Password"];

if ($username != "" && $password != "") {
   
   $link = mysqli_connect("localhost","root",
                          "","absentsystem")
        or die("無法開啟MySQL資料庫連接!<br/>");
   
   $sql = "SELECT * FROM allpeople WHERE s_password='";
   $sql.= $password."' AND s_username='".$username."'";
   
   $result = mysqli_query($link, $sql);
   $total_records = mysqli_num_rows($result);
   
   if ( $total_records > 0 ) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $level = $row["level"];
    $_SESSION["login_session"] = true;
    if ($level == "vice") {
       header('Location: vice.php');
    } else {
       header('Location: index.php');
    }
   } else {  
      echo "<center><font color='red'>";
      echo "使用者名稱或密碼錯誤!<br/>";
      echo "</font>";
      $_SESSION["login_session"] = false;
   }
   mysqli_close($link);
}
?>
<body>

    <div class="loginout">
        <div class="loginin">
            <h1>嘉義高商出缺席系統</h1>
            <form action="" method="post" autocomplete="off">
                <input type="text" name="Username" placeholder="帳號">
                <input type="password" name="Password" placeholder="密碼">
                <button type="submit">登入</button>
            </form>
        </div>
    </div>

</body>

</html>