

  <div class="footer">
    <p><span class="glyphicon glyphicon-heart"></span> 中南易班  <a href="https://github.com/upcyiban/SignName"></a></p>
  </div>
</div>
</body>
<!-- build:js(.) scripts/vendor.js -->
<!-- bower:js -->
<script src="<?php echo base_url() ;?>bower_components/jquery/dist/jquery.js"></script>
<script src="<?php echo base_url() ;?>bower_components/bootstrap/dist/js/bootstrap.js"></script>

<!-- endbower -->
<!-- endbuild -->
<!-- Buttons 库的核心文件 -->
<link rel="stylesheet" href="<?php echo base_url() ;?>css/data/buttons.css">
<!-- build:js(.tmp) scripts/main.js -->
<script src="<?php echo base_url() ;?>js/qiandao/main.js"></script>
<!-- endbuild -->

<!-- tencent_location -->
<script type="text/javascript" src="https://3gimg.qq.com/lightmap/components/geolocation/geolocation.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ;?>js/qiandao/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
	function delete_id(id)
	{
	    $.get('admin/delete?id='+id,function(data)
	    {
	      if(data == "success")
	      {
	        $('#delete'+id).html("已删除");
	      }
	      else
	      {
	        alert("不好意思，删除失败");
	      }
	       
	    })
	}

</script>
<script type="text/javascript">
function updatefilename(edited_filename,filename)
{
  $.get('admin/updatefilename?old='+filename+'&now='+edited_filename,function(data)
  {
    if(data=="success")
    {
      alert("文件名已更改");
    }
    else {
      alert("哥们人品不太好，换只手试一下吧<br/>可能是原文件名没写对哦");
    }
  })
}
</script>
<script type="text/javascript">
	function update(id)
	{
	    $.get('admin/updateprivilege?id='+id,function(data)
	    {
	      if(data == "success")
	      {
	        $('#privilege'+id).html("0");
	      }
	      else
	      {
	        alert("不好意思，更新失败");
	      }
	       
	    })
	}

</script>


</html>
