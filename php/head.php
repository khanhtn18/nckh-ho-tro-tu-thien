<!--UTF-8 -> font-->
<meta charset="UTF-8">
<!--Bootstrap 4.4.1-->
<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="css/optimized-min_2.css" rel="stylesheet">
<link href="css/optimized-min_1.css" rel="stylesheet">
<link href="css/optimized-min.css" rel="stylesheet">
<link href="css/optimized-min_3.css" rel="stylesheet">
<!-- notag -->
<link href="css/specific-ve-vi.css" type="text/css" rel="stylesheet">
<link rel="canonical">
<link href="img/matt_logo.jpg" rel="shortcut icon">
<!--facebook -> search-->
<meta content="Trang chủ - Mái ấm truyền tin ở Việt Nam" property="og:title">
<meta content="https://www.MATT.com.vn/" property="og:url">
<!--SEO -> google search-->
<meta content="Trang chủ" name="description">
<meta content="Giới thiệu, chăm sóc sức khỏe, hành trình, sức khỏe, nhu cầu, giải pháp, trách nhiệm cộng đồng, nghề nghiệp, văn hóa doanh nghiệp" name="keywords">
<!--twitter -> search-->
<meta content="Trang chủ - Mái ấm truyền tin ở Việt Nam" property="twitter:title">
<meta content="summary_large_image" property="twitter:card">
<!--respondsive-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--main.css -> footer + color-->
<link href="css/main.css" type="text/css" rel="stylesheet">
<!--php => mysql-->
<?php 
    $servername = "127.0.0.1";
    $username = "root";
    $password = 'testing123';
    $dbname = "mysqltest";
    $con = mysqli_connect($servername, $username, $password, $dbname);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>