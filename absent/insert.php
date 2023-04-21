<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $link = mysqli_connect("localhost", "root", "", "absentsystem")
        or die("無法開啟MySQL資料庫連接!<br/>");

    $select = "SELECT * FROM allpeople";
    $query = mysqli_query($link, $select);
    while ($data = mysqli_fetch_assoc($query)) {
        $stu_id = $data['stu_id'];
        $s_name = $data['s_name'];
        $s_number = $data['s_number'];
        $abs_absent = '出席';
        $ps = '無';

        $result = "INSERT INTO cur_absent (stu_id, s_name, s_number, s_absent, ps) 
                   VALUES ('$stu_id', '$s_name', '$s_number', '$abs_absent', '$ps')";
        mysqli_query($link, $result);
    }

    mysqli_close($link);
    ?>
</body>

</html>