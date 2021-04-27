<!DOCTYPE html>
<html class="no-js" lang="vi">
<head>
   <?php include 'php/head.php';?>
   <!--AOS 3.0.0-->
   <link rel="stylesheet" href="css/aos.css"/>
   <link rel="stylesheet" href="css/lish-su.css"/>
</head>
<body class="default-device osw osw-main-underheader osw-color-darkgrey osw-bg-palegrey bodyclass">
   <div id="wrapper">
      <!-- #header -->
      <?php include 'php/header.php';?>
      <!-- /#header -->
      <!-- #content -->
      <main>
         <?php include 'php/banner.php';?>
            <div class="event-div">
               <ul class="event-nav">
                  <div class="dropdown">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Danh sách sự kiện
                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php
                           $sql = "SELECT * FROM event";
                           $result = mysqli_query($con, $sql);
                           $queries = mysqli_fetch_all($result, MYSQLI_ASSOC);
                           foreach($queries as $query => $results) {
                              echo"<a class='dropdown-item' href='#event{$results['e_id']}'>{$results['e_title']}</a>";
                           };
                        ?>
                     </div>
                  </div>
               </ul>
               <div class="list-div">
                  <ul>
                     <?php
                     $sql = "SELECT * FROM event";
                     $result = mysqli_query($con, $sql);
                     $queries = mysqli_fetch_all($result, MYSQLI_ASSOC);
                     foreach($queries as $query => $results) {
                        echo 
                        "<li>
                           <div class='event-item' id='event{$results['e_id']}'>
                              <h1>{$results['e_title']}</h1>
                              <p>{$results['e_text']}</p>
                              <img class='event-img' src='img/house.jpg' alt='event-img' width='200'>
                           </div>
                        </li>";
                     };
                     ?>
                  </ul>
               </div>
            </div>
      </main>
      <!-- /#content -->
      <!-- #footer -->
      <script src="js/lich-su.js"></script>
      <script src="js/aos.js"></script>
      <script> AOS.init(); </script>
      <?php include 'php/footer.php'?>
      <!-- /#footer -->
   </div>
</body>
</html>