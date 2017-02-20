{literal}
<script>
	window._bd_share_config = {
		common : {
			bdText : '活动二维码在此~小伙伴们快快扫码加入吧~',	
			bdDesc : '活动二维码在此~小伙伴们快快扫码加入吧~',	
			bdUrl : '', 	
			bdPic : '{/literal}{base_url($detail.event.QRcode)}{literal}'
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
  <div class="row marketing">
    <h2>二维码</h2>
    <p>复制此二维码,其他人使用易班客户端扫一扫即可签到.鼠标移动到图片上可分享图片给好友~</p>
    <img src="{base_url()}{$detail.event.QRcode}" width="40%" />
    <a href="{base_url()}{$detail.event.QRcode}" download="{$detail.event.QRcode}">点此下载</a>
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
    <h3>统计列表</h3>
    <p>当前 <span>{$detail.current_check_num|default:'不知道多少'}</span> 人已签到.</p>
    <table class="table table-striped">
      <thead>
      <tr>
        <th>序号</th>
        <th>易班id</th>
        <th>真实姓名</th>
        <th>签到时间</th>
        <th>签到位置</th>
      </tr>
      </thead>
      {foreach $detail.members as $member}
      <tbody>
      <tr>
        <td>{$member.id}</td>
        <td>{$member.user_id}</td>
        <td>{$member.user_name}</td>
        <td>{$member.checked_date}</td>
        <td>{$member.userLocation}</td>
      </tr>
      </tbody>
      {/foreach}
    </table>
  </div>
  
  
