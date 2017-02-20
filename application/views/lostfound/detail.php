
<section class="container">
    <div class="post">
        <article class="post-block">
            <h1 class="post-title">{$detail.lf_title|default:''}</h1>
            <div class="post-info">{$detail.lf_date|default:''}</div>
            <div class="post-content">
                <p>{$detail.lf_detail}</p>
                {if $detail.lf_upload}
                <a id="more"></a>
                <h2 id="物品详情"><a href="#物品详情" class="headerlink" title="物品详情"></a>物品详情</h2>
                {foreach $detail.lf_upload as $photo}
                <p><img src="{base_url($photo)}" alt="img"></p>
                {/foreach}
                {/if}
                <div class="tip">
                    <ul>
                        <li>电话：{$detail.lf_contact|default:''}</li>
                        <li>联系人: {$detail.lf_name|default:''}</li>
                        <li>地址：{$detail.lf_address|default:''}</li>
                    </ul>
                </div>
            </div>
        </article>
    </div>
</section>
