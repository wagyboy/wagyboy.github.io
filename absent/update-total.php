<?php
$link = $link = mysqli_connect("localhost","root",
"","absentsystem")
or die("無法開啟MySQL資料庫連接!<br/>");
$aid = $_GET['aid'];
$date = $_GET['date'];
$period = $_GET['period'];
$absent = $_GET['absent'];
$sql = "SELECT * FROM st_absent WHERE s_aid='$aid' AND s_date='$date'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
// 修改要修改的節次的值
$absentArray = str_split($row['s_absent']);
for ($i=$period ; $i<=8 ; $i++){
    $absentArray[$i-1] = $absent; #0 or 1
}
$newAbsent = implode($absentArray);

// 更新該學生的出缺席情況
$sql = "UPDATE st_absent SET s_absent='$newAbsent' WHERE s_aid='$aid' AND s_date='$date'";
mysqli_query($link, $sql);
header("Location: total-index-vice.php");
?>