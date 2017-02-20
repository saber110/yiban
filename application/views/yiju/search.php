
    <!--/#header-->


    <!--/#action-->

    <section id="portfolio-information" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-sm-4">
                    <img src="{$image}" class="img-responsive" alt="">
                </div>
                <div class="col-sm-6">
                    <div class="project-name overflow">
                        <h2 class="bold">{$itemname}</h2>
                        <ul class="nav navbar-nav navbar-default">
                            <li><a href="#"><i class="fa fa-clock-o"></i>{$baseinfo[5]}首映</a></li>
                            <li><a href="#"><i class="fa fa-tag"></i>{$baseinfo[1]}</a></li>
                        </ul>
                    </div>
                    <div class="project-info overflow">
                        <h3>简介</h3>
                        <p>{$intro}</p>
                        <!-- <ul class="elements">
                            <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li><i class="fa fa-angle-right"></i> Donec tincidunt felis quis ipsum porttitor, non rutrum lorem rhoncus.</li>
                            <li><i class="fa fa-angle-right"></i> Nam in quam consectetur nulla placerat dapibus ut ut nunc.</li>
                        </ul> -->
                    </div>
                    {if !empty($starrings)}
                    <div class="skills overflow">
                        <h3>主演:</h3>
                        <ul class="nav navbar-nav navbar-default">
                        {foreach $starrings as $starring}
                            <li><a href="#"><i class="fa fa-circle"></i>{$starring}</a></li>
                        {/foreach}
                        </ul>
                    </div>
                    {/if}
                    {if !empty($directors)}
                    <div class="client overflow">
                        <h3>导演:</h3>
                        <ul class="nav navbar-nav navbar-default">
                        {foreach $directors as $director}
                            <li><a href="#"><i class="fa fa-circle"></i>{$director}</a></li>
                        {/foreach}
                        </ul>
                    </div>
                    {/if}
                    {if !empty($screenwriters)}
                    <div class="client overflow">
                        <h3>编剧:</h3>
                        <ul class="nav navbar-nav navbar-default">
                        {foreach $screenwriters as $screenwriter}
                            <li><a href="#"><i class="fa fa-circle"></i>{$screenwriter}</a></li>
                        {/foreach}
                        </ul>
                    </div>
                    {/if}
		    <div class="client overflow">
                        <h3>版权相关，本站不直接提供下载</h3>
                        <ul class="nav navbar-nav navbar-default">
                            <li><a href="http://www.zimuzu.tv"><i class="fa fa-circle"></i>zimuzu.tv</a></li>
			    <li><a href="http://www.ttmeiju.com"><i class="fa fa-circle"></i>天天美剧</a></li>
			    <li><a href="http://cn163.net"><i class="fa fa-circle"></i>另一个天天美剧</a></li>
			    <li><a href="http://tv.sohu.com/drama/us/"><i class="fa fa-circle"></i>搜狐美剧</a></li>
			    <li><a href="http://www.iqiyi.com/"><i class="fa fa-circle"></i>爱奇艺</a></li>
                        </ul>
                    </div>
                    <div class="live-preview">
                        <a href="javascript:void(0)" id="subscribeButton" class="{$subscribe_class}" onclick="subscribe({$itemid}, {$subscribe_status})">{$subscribe_msg}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!--/#portfolio-information--> 
  <!--  <section id="related-work" class="padding-top padding-bottom">
        <div class="container">
            <div class="row">
                <h1 class="title text-center">最近订阅</h1>
                <div class="col-sm-3">
                    <div class="portfolio-wrapper">
                        <div class="portfolio-single">
                            <div class="portfolio-thumb">
                                <img src="{base_url()}pagestuff/yiju/images/portfolio/1.jpg" class="img-responsive" alt="">
                            </div>
                            <div class="portfolio-view">
                                <ul class="nav nav-pills">
                                    <li><a href="{base_url()}pagestuff/yiju/images/portfolio/1.jpg" data-lightbox="example-set"><i class="fa fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="portfolio-info ">
                            <h2>Sailing Vivamus</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!--/#related-work-->


    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center bottom-separator">
                    <img src="{base_url()}pagestuff/yiju/images/home/under.png" class="img-responsive inline" alt="">
                </div>
                <div class="col-sm-12">
                    <div class="copyright-text text-center">
                        <p>&copy; 中南易家 2016. All Rights Reserved.</p>
                        <p>Designed by <a target="_blank" href="http://www.themeum.com">Themeum</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->


