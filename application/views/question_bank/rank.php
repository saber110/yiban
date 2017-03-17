<!doctype html>
<html class="no-js" lang="" xmlns="http://www.w3.org/1/xhtml"
      xmlns:th="http://www.thymeleaf.org">
<head>
  <meta charset="utf-8">
  <title>中南大学历史知识竞赛排行榜</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">

  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <!-- <base href="{base_url()}/yiban"> -->
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

  <!-- build:css(.) styles/vendor.css -->
  <!-- bower:css -->
  <link rel="stylesheet" href="<?php echo base_url();?>bower_components/bootstrap/dist/css/bootstrap.css" />
  <!-- endbower -->
  <!-- endbuild -->
  <!-- build:css(.tmp) styles/main.css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/qiandao/main.css"> 
  <!-- endbuild -->
  <!-- build:js scripts/vendor/modernizr.js -->
  <script src="<?php echo base_url(); ?>bower_components/modernizr/modernizr.js"></script>
  <!-- endbuild -->

</head>
<body>
<!--[if lt IE 10]>
<p class="browsehappy">你正在使用一个<strong>过时的</strong>浏览器. 请到<a href="http://browsehappy.com/">这里</a>去升级你的浏览器以获得更佳的体验.</p>
<![endif]-->

<div class="container">

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">成绩排行榜</a>
      </div>
    </div><!--/.container-fluid -->
  </nav>

  <section style="margin-top: 20px">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
            <table  align='center'>
              <tr>
               <!--  <td class='navbar-brand'>学号 </td> -->
                <td class='navbar-brand'>姓名 </td>
                <td class='navbar-brand'>易班id</td>
                <td class='navbar-brand'>得分 </td>
                <td class='navbar-brand'>所用时间</td>
              </tr>
            </table>
        </div><!--/.container-fluid -->
      </nav>
    <?php 
    foreach ($rank as $value) 
    {
        echo '<nav class="navbar navbar-default">
          <div class="container-fluid">
            ';
              echo "<table  align='center'>";
                echo "<tr>";
                    echo "<td class='navbar-brand'>".$value['name'] ."</td>";
                    echo "<td class='navbar-brand'>".$value['yb_userid'] ."</td>";
                    echo "<td class='navbar-brand'>".$value['score'] ."</td>";
                    echo "<td class='navbar-brand'>".$value['time'] ."</td>";
                echo "</tr>";
              echo "</table>";
            echo '
          </div>
        </nav>';
      // echo "<tbody>";
      //   echo "<tr>";
      //       echo "<td align='center'>".$value['name'] ."</td>";
      //       echo "<td align='center'>".$value['yb_userid'] ."</td>";
      //       echo "<td align='center'>".$value['score'] ."</td>";
      //       echo "<td align='center'>".$value['time'] ."</td>";
      //   echo "</tr>";
      // echo "</tbody>";
    }
    ?>
</section>


  <div class="footer">
    <p><span class="glyphicon glyphicon-heart"></span> 中南易班 | powered by <a href="http://www.yunlugu.org">云麓谷</a></p>
  </div>
</div>
</body>
<!-- build:js(.) scripts/vendor.js -->
<!-- bower:js -->
<script src="<?php echo base_url(); ?>bower_components/jquery/dist/jquery.js"></script>
<script src="<?php echo base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.js"></script>

<!-- endbower -->
<!-- endbuild -->

<!-- build:js(.tmp) scripts/main.js -->
<script src="<?php echo base_url(); ?>js/qiandao/main.js"></script>
<!-- endbuild -->

<!-- Baidu Analytics-->
<script>

</script>

</html>

