<!doctype html>
<html class="no-js" lang="" xmlns="http://www.w3.org/1/xhtml"
      xmlns:th="http://www.thymeleaf.org">
<head>
  <meta charset="utf-8">
  <title>资料</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">

  <!-- background -->
  <!--<img border='0' src='<?php echo base_url();?>images/photo.jpg' width='100%' height='100%' style='position: absolute;left:0px;top:0px;z-index: -1'>-->
<style type="text/css">
    .container{
      border: 0;
      /*src: url('<?php echo base_url();?>images/photo.jpg');*/
      background-image: url('<?php echo base_url();?>images/photo.jpg');
      width: auto;
      height: auto;
      //position: absolute;
      z-index: -1;
      /*border='0' src='<?php echo base_url();?>images/photo.jpg' width='100%' height='100%' style='position: absolute;left:0px;top:0px;z-index: -1'*/
    }
  </style>
	<link rel="stylesheet" href="<?php echo base_url() ;?>css/data/table.css" />
	
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <!-- <base href="{base_url()}/yiban"> -->
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

  <!-- build:css(.) styles/vendor.css -->
  <!-- bower:css -->
  <link rel="stylesheet" href="<?php echo base_url() ;?>bower_components/bootstrap/dist/css/bootstrap.css" />
  <!-- endbower -->
  <!-- endbuild -->

  <link rel="stylesheet" href="<?php echo base_url() ;?>css/qiandao/main.css">

  <!-- build:js scripts/vendor/modernizr.js -->
  <script src="<?php echo base_url() ;?>bower_components/modernizr/modernizr.js"></script>

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
        <a class="navbar-brand" href="<?php echo base_url();?>data">中南大学资料</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo base_url();?>data">主页</a></li>
          <li><a href="#">关于</a></li>
          <li><a href="<?php echo base_url();?>Chat">联系我们</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
  </nav>

