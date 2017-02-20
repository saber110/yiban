<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="X-UA-Compatible" content="IE=edge">
            <title> 中南大学易招领</title>
        <meta name="description" content="A Blog Powered By Hexo">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="short icon" href="{base_url()}favicon.ico">
        <link rel="stylesheet" href="{base_url()}pagestuff/lostfound/css/apollo.css">
        <link rel="stylesheet" href="http://fonts.useso.com/css?family=Source+Sans+Pro:400,600" type="text/css">
        <link rel="alternate" type=”application/rss+xml” title="中南大学易招领 RSS Feed" href="{base_url()}LostFound"/>
<!-- Generic page styles -->
    </head>
    <body>
        <div class="wrap">
            <header>
                <a href="{base_url()}LostFound/" class="logo-link"><img src="{base_url()}pagestuff/lostfound/favicon.png"></a>
                <ul class="nav nav-list">
                    <li class="nav-list-item"><a href="{base_url()}LostFound/publish/" target="_self" class="nav-list-link {if $title == '发布启事'}active{/if}">发布</a></li>
                    <li class="nav-list-item"><a href="{base_url()}LostFound?type=lost" target="_self" class="nav-list-link {if isset($type) && $type == 1}active{/if}">寻找物品</a></li>
                    <li class="nav-list-item"><a href="{base_url()}LostFound?type=found" target="_self" class="nav-list-link {if isset($type) && $type != 1 }active{/if}">寻找失主</a></li>
<!--                     <li class="nav-list-item"><a href="https://github.com/pinggod" target="_blank" class="nav-list-link">关于</a></li> -->
                   <!--  <li class="nav-list-item"><a href="{base_url()}LostFound/subscribe" target="_self" class="nav-list-link">订阅</a></li> -->
                </ul>
            </header>
