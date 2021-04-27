<!DOCTYPE html>
<html class="no-js" lang="vi">
<head>
   <?php include 'php/head.php';?>
   <link rel="stylesheet" href="css/tim-kiem.css"/>
</head>
<body class="default-device osw osw-main-underheader osw-color-darkgrey osw-bg-palegrey bodyclass">
   <div id="wrapper">
      <!-- #header -->
      <?php include 'php/header.php';?>
      <!-- /#header -->
      <!-- #content -->
      <main>
         <?php include 'php/banner.php';?>
         <div class="container-fluid bg-light py-5 w-100" id="search-div">
            <div class="border border-light">
            <form class="form-group form-inline my-5 bg-white p-3 w-100" id="search-nav" action="tim-kiem.php" method="GET">
               <input class="form-control m-0 h-100 px-5" type="text" name="search" placeholder="Gõ vào đây để tìm kiếm" aria-label="Search">
               <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>
               <?php
               if (!!$_GET && !!$_GET['search']) {
                  $search = $_GET['search'];
                  echo
                  '<div class="mb-5 text-center">
                     <p class="font-italic">Từ khóa:</p>
                        <h1 class="font-weight-bold" style="font-size: 1.5em;">'
                  . $search
                  . '</p>
                  </div>';
                  echo '<div class="query-div">'; // <query-div>
                  $result = mysqli_query($con,
                  "SELECT * FROM event
                  WHERE e_title LIKE '%$search%'
                  OR e_text LIKE '%$search%'
                  ");
                  $queries = mysqli_fetch_all($result, MYSQLI_ASSOC);
                  $count = mysqli_num_rows($result);
                  if (!!(is_array($queries) && $count > 0)) {
                     echo
                     "<p class='text-center text-success font-weight-bold'>"
                     . $count . " Kết quả:
                     </p>";
                     $link = "lich-su.php";
                     foreach($queries as $query => $results) {
                        $pattern = "/$search/i";
                        $redirect = "$link#event{$results['e_id']}";
                        $title = preg_replace($pattern,
                        "<span style='background-color: yellow;'>$search</span>", $results['e_title']);
                        $text = preg_replace($pattern,
                        "<span style='background-color: yellow;'>$search</span>", $results['e_text']);
                        echo
                        "<div>
                           <a href='$redirect' class='text-info'>$title</a><br><br>" 
                           . "<p class='overflow-auto' style='max-height:5em'>$text</p>
                        </div><hr>";
                     };
                  } else {echo "<p class='text-center text-danger'>Không có kết quả.</p>";}
                  echo '</div>'; // </query-div>
               } else {echo "<p class='text-center text-info'>Kết quả của bạn sẽ ở đây.</p>";}
               ?>
            </div>
         </div>
      </main>
      <!-- /#content -->
      <!-- #footer -->
      <?php include 'php/footer.php'?>
      <!-- /#footer -->
   </div>
</body>
</html>