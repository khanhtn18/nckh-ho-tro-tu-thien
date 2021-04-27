<!DOCTYPE html>
<html class="no-js" lang="vi">
<head>
   <?php include 'php/head.php';?>
   <link rel="stylesheet" href="css/quy-dinh.css"/>
</head>
<body class="default-device osw osw-main-underheader osw-color-darkgrey osw-bg-palegrey bodyclass">
   <div id="wrapper">
      <!-- #header -->
      <?php include 'php/header.php';?>
      <!-- /#header -->
      <!-- #content -->
      <main>
         <?php include 'php/banner.php';?>
         <div>
            <h1 class="main-title">
               Mục quy định
            </h1>
         </div>
         <div class="text-div">
            <div class="rule-div" class="bg-light p-5">
               <ul>
                  <?php
                     $sql = 
                     "SELECT rule.rule_id, rule.rule_title, rule_texts.rule_text 
                     FROM rule LEFT JOIN rule_texts
                     ON rule.rule_id = rule_texts.rule_id";
                     $result = mysqli_query($con, $sql);
                     $queries = mysqli_fetch_all($result, MYSQLI_ASSOC);
                     $i = 0;
                     foreach($queries as $query => $results) {
                        if ($results['rule_title']!=$title) {
                           $title = $results['rule_title'];
                           echo "<li>
                              <h1 class='rule-title'>". $title. "</h1>
                           </li>
                           ";
                           $i = 1;
                        } else {$i++;};
                        if (count(explode(":", $results['rule_text'])) == 1) {
                           $out = str_replace("-", "<br> - ", $results['rule_text']);
                        } else {
                           $in = explode(":", str_replace("-", "<br> - ", $results['rule_text']), 2);
                           $out = "<b>". $in[0]. ":</b>". $in[1];
                        };
                        echo "<li>
                           <p class='rule-text'> $i. ". $out. "</p>
                        </li>
                        ";
                     };
                  ?>
               </ul>
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