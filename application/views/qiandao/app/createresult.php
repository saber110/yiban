
  {literal}
<script>
	window._bd_share_config = {
		common : {
			bdText : '活动二维码在此~小伙伴们快快扫码加入吧~',	
			bdDesc : '活动二维码在此~小伙伴们快快扫码加入吧~',	
			bdUrl : '', 	
			bdPic : '{/literal}{base_url($qrcode)}{literal}'
		},
		share : [{
			"bdSize" : 16
		}],
		image : [{
			viewType : 'list',
			viewPos : 'top',
			viewColor : 'black',
			viewSize : '16',
			viewList : ['sqq','qzone','weixin','tsina','tieba','twi','fbook']
		}]
	}
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
{/literal}
  <article class="jumbotron">
    <h1>创建成功</h1>
    <p>复制此二维码,其他人使用易班客户端扫一扫即可签到.</p>
    <img src="{base_url($qrcode)}"/>
    <a href="{base_url($qrcode)}" download="{base_url($qrcode)}">点此下载</a>
  </article>
<p>分享到：</p>
	<div class="bdsharebuttonbox" data-tag="share_1">
	<a class="bds_sqq" data-cmd="sqq"></a>
	<a class="bds_qzone" data-cmd="qzone" href="#"></a>
	<a class="bds_tsina" data-cmd="tsina"></a>
	<a class="bds_weixin" data-cmd="weixin"></a>
	<a class="bds_tieba" data-cmd="tieba"></a>
	<a class="bds_twi" data-cmd="twi"></a>
	<a class="bds_fbook" data-cmd="fbook"></a>
	<a class="bds_more" data-cmd="more">更多</a>
	<a class="bds_count" data-cmd="count"></a>
	</div>