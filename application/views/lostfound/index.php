
            <section class="container">
                <ul class="home post-list">
                {if $items}
                    {foreach $items as $item}
                    <li class="post-list-item">
                        <article class="post-block">
                            <h2 class="post-title"><a href="{base_url()}LostFound/detail/{$item.lf_id}" class="post-title-link">{$item.lf_title}</a></h2>
                            <div class="post-info">{$item.lf_date}</div>
                            <div class="post-content">
                                <p>{$item.lf_detail}</p>
                                <!-- <p><img src="{base_url()}pagestuff/lostfound/img/Screenshot_20160612-115841.png" alt="img"></p> -->
                            </div>
                            <a href="{base_url()}LostFound/detail/{$item.lf_id}" class="read-more">...more</a>
                        </article>
                    </li>
                    {/foreach}
                {/if}
                </ul>
            </section>
            
