
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">ta喜欢看什么呢ε٩ (๑> 灬 <)۶з</h1>
                            <!-- <p>Timeline</p> -->
                            <div class="col-md-4 col-sm-12">
                    <div class="contact-form bottom">
                        <!-- <h2>Send a message</h2> -->
                        <form name="contact-form" method="post" action="{base_url()}Yiju/timeline">
                            <div class="form-group">
                                <input type="text" name="userid" class="form-control" required="required" placeholder="ta的易班id">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-submit" value="约！就算要花10网薪">
                            </div>
                        </form>
                    </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#page-breadcrumb-->
    
    <section id="blog" class="padding-bottom">
        <div class="container">
            <div class="row">
                <div class="timeline-blog overflow padding-top">
		   {if isset($subscribes)}
                    <div class="timeline-date text-center">
                        <a href="#" class="btn btn-common uppercase">{$title|default:'足迹'}</a>
                    </div>
                    <div class="timeline-divider overflow padding-bottom">
                        {foreach $subscribes as $key => $subscribe}
                        {if $key%2 && $key!=0}
                        <div class="col-sm-6 padding-left padding-top arrow-left wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="300ms">
                            <div class="single-blog timeline">
                                <div class="single-blog-wrapper">
                                    <div class="post-thumb">
                                        <img src="{$subscribe.image}" class="img-responsive" alt="">
                                        <div class="post-overlay">
                                           <span class="uppercase"><a href="#">{$subscribe.subscribe_date.month}.{$subscribe.subscribe_date.day} <br><small>{$subscribe.subscribe_date.year}</small></a></span>
                                       </div>
                                    </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold"><a href="{base_url()}Yiju/search?itemname={$subscribe.itemname}">{$subscribe.itemname}</a></h2>
                                </div>
                                <div class="post-content overflow">
                                    <!-- <h2 class="post-title bold"><a href="blogdetails.html#">{$subscribe.subscribe_date}</a></h2> -->
                                    <p>{$subscribe.intro}</p>
                                    <!-- <a href="#" class="read-more">View More</a> -->
                                    <div class="post-bottom overflow">
                                        <span class="post-date pull-left">{$subscribe.baseinfo[5]}首播</span>
                                        <!-- <span class="comments-number pull-right"><a href="#">3 comments</a></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        {else}
                        <div class="col-sm-6 padding-right arrow-right wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
                            <div class="single-blog timeline">
                                <div class="single-blog-wrapper">
                                    <div class="post-thumb">
                                        <img src="{$subscribe.image}" class="img-responsive" width="20" alt="">
                                        <div class="post-overlay">
                                           <span class="uppercase"><a href="#">{$subscribe.subscribe_date.month}.{$subscribe.subscribe_date.day} <br><small>{$subscribe.subscribe_date.year}</small></a></span>
                                       </div>
                                    </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold"><a href="{base_url()}Yiju/search?itemname={$subscribe.itemname}">{$subscribe.itemname}</a></h2>
                                </div>
                                <div class="post-content overflow">
                                    <!-- <h2 class="post-title bold"><a href="blogdetails.html#">{$subscribe.subscribe_date}</a></h2> -->
                                    <p>{$subscribe.intro}</p>
                                    <!-- <a href="#" class="read-more">View More</a> -->
                                    <div class="post-bottom overflow">
                                        <span class="post-date pull-left">{$subscribe.baseinfo[5]}首播</span>
                                        <!-- <span class="comments-number pull-right"><a href="#">3 comments</a></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        {/if}
                        
                        {/foreach}
			{/if}
                    </div>
                    <div class="timeline-date text-center">
                            <a href="{base_url()}Yiju/" class="btn btn-common">{$start_date}</a>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#blog-->

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center bottom-separator">
                    <img src="{base_url()}pagestuff/yiju/images/home/under.png" class="img-responsive inline" alt="">
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="testimonial bottom">
                        <h2>友评</h2>
                        <div class="media">
                            <div class="pull-left">
                                <a href="#"><img src="{base_url()}pagestuff/yiju/images/home/profile1.png" alt=""></a>
                            </div>
                            <div class="media-body">
                                <blockquote>666真的厉害</blockquote>
                                <h3><a href="#">- 张召忠</a></h3>
                            </div>
                         </div>
                        <div class="media">
                            <div class="pull-left">
                                <a href="#"><img src="{base_url()}pagestuff/yiju/images/home/profile2.png" alt=""></a>
                            </div>
                            <div class="media-body">
                                <blockquote>啊~~~~~~~~局座葛格我好爱你( ˘ ³˘)♥ ( ˘ ³˘)雾霾可以防导弹</blockquote>
                                <h3><a href="">- 王源</a></h3>
                            </div>
                        </div>   
                    </div> 
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
