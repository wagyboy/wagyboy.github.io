<?php
$link = $link = mysqli_connect("localhost","root",
"","absentsystem")
or die("無法開啟MySQL資料庫連接!<br/>");
$aid = $_GET['aid'];
$absent = $_GET['absent'];
$sql = "SELECT * FROM cur_absent WHERE s_aid='$aid'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
// 修改要修改的節次的值
$newAbsent = $absent;
// 更新該學生的出缺席情況
$sql = "UPDATE cur_absent SET s_absent='$newAbsent' WHERE s_aid='$aid'";
mysqli_query($link, $sql);
header("Location:vice.php");
?>