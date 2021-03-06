<!doctype html>
<html class="no-js" lang="" xmlns="http://www.w3.org/1/xhtml"
      xmlns:th="http://www.thymeleaf.org">
<head>
  <meta charset="utf-8">
  <title>中南易班考试系统</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <!-- Buttons 库的核心文件 -->
   <link rel="stylesheet" href="<?php echo base_url() ;?>css/data/buttons.css">

  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <!-- <base href="{base_url()}/yiban"> -->
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<!-- css chart -->
  <link media="all" rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/Test_System/chart.css" />
  <!-- end csschart -->
  <!-- build:css(.) styles/vendor.css -->
  <!-- bower:css -->
  <link rel="stylesheet" href="<?php echo base_url();?>/bower_components/bootstrap/dist/css/bootstrap.css" />
  <!-- endbower -->
  <!-- endbuild -->
  <!-- build:css(.tmp) styles/main.css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/css/qiandao/main.css">
  <!-- endbuild -->
  <!-- build:js scripts/vendor/modernizr.js -->
  <script src="<?php echo base_url(); ?>/bower_components/modernizr/modernizr.js"></script>
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
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">中南易班考试系统</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{base_url()}qiandao">主页</a></li>
          <li><a href="#">关于</a></li>
          <li><a href="#">联系我们</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
  </nav>


