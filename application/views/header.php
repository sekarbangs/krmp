<!DOCTYPE html>
<html>
<head>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  
  ga('create', 'UA-89058812-1', 'auto');
  ga('send', 'pageview');
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88133116-1', 'auto');
  ga('send', 'pageview');
</script>
<meta charset="utf-8">
<META NAME="description" CONTENT="<?=$pageDesc;?>">
<META NAME="keywords" CONTENT="kannada, remix, kannada remix, kannada dj, dj, karnataka, kannada songs, kannada remix songs, kannada song, remix song">
<META NAME="robot" CONTENT="index,follow">
<META NAME="copyright" CONTENT="Copyright © 2016-<?=date('Y');?> Kannada Remix Music Portal. All Rights Reserved.">
<META NAME="author" CONTENT="Kannada Remix Music Inc.">
<META NAME="language" CONTENT="english">
<META NAME="revisit-after" CONTENT="1 days">
<link rel="shortcut icon" href="<?=base_url()?>/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/x-icon">
<title><?=$pageTitle;?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/krmp.styling.css">
</head>
<body style="padding-top: 70px;max-height:100vh;">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header" style="min-width:300px;background:url(/images/logo-sm.png) no-repeat center left;background-size:contain;">
      <a class="navbar-brand" href="#" style="margin-left:25px;z-index:1;">Kannada Remix Music Portal</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="<?=base_url().index_page();?>/welcome/home">Home</a></li>
      <li><a href="<?=base_url().index_page();?>/songs/s_home/index/1">KRMP Weekend Bash</a></li>
      <li><a href="<?=base_url().index_page();?>/songs/s_home/index/2">Kannada DJ Albums</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><button id="togglePlayerBtn" onClick="processView.handlePlayer();" class="btn btn-circle btn-lg btn-secondary">
              <span class="fa fa-pause" aria-hidden="true"></span></button></li>
      <li>&emsp;</li>
      <li>&emsp;</li>
      <li>&emsp;</li>
      <li>&emsp;</li>
    </ul>
  </div>
</nav>
<div class="container" id="container"><!-- closes in footer.php -->