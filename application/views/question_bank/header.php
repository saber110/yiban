<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>历史知识竞赛</title>
  <meta name="" content="">
  <meta title="����ϵͳ">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/Test_System/Test_System.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/Test_System/y-f.css">
    <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">

  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
<!-- 
  <link rel="stylesheet" href="<?php echo base_url();?>/bower_components/bootstrap/dist/css/bootstrap.css" />

  <link rel="stylesheet" href="<?php echo base_url(); ?>/css/qiandao/main.css">   -->

</head>
<body onload = "timer()">
  <!-- SVG ��ʽ��д -->
  <!-- <svg style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
      <symbol id="icon-radio-unchecked" viewBox="0 0 32 32">
      <title>radio-unchecked</title>
      <path class="path1" d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 28c-6.627 0-12-5.373-12-12s5.373-12 12-12c6.627 0 12 5.373 12 12s-5.373 12-12 12z"></path>
      </symbol>
    </defs>
  </svg> -->



    <?php
    echo validation_errors();
  ?>
  <form action="<?php echo base_url()?>question_bank/score" onsubmit="return y()" method="post" name = "examination"> 