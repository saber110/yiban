		</form> 
		<div class="hw-overlay" id="hw-layer">
			<div class="hw-layer-wrap">
				<button type="button" class="close hwLayer-close" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="row">
					<div class="images-icon"></div>
					<div>
						<h2>警告：</h2>
						<p>你有空白题目，试题尚未答完，请继续填写试卷。</p>
						<button class="hwLayer-ok">确定</button>
						<button class="hwLayer-cancel">取消</button>
					</div>
				</div>
			</div>
		</div>



</div>
</body>
<!-- build:js(.) scripts/vendor.js -->
<!-- bower:js -->
<script src="<?php echo base_url(); ?>bower_components/jquery/dist/jquery.js"></script>
<script src="<?php echo base_url();?>bower_components/bootstrap/dist/js/bootstrap.js"></script>

	<script src="<?php echo base_url(); ?>js/Test_System/button/jquery.min.js"></script>
	<script>
	function y() {
		// 赋予数量初值为 0
		var m = 0;
		// 根据 class 得出 radio 的数量
		var r = document.getElementsByClassName("radio");
		// 遍历 得出答题数
		for (var i = 0; i < r.length; i++) {
			if (r.item(i).checked == true) { m = m+1;};
		};
		// 判断 所答题数是否等于总题数
		if (m == r.length/6) { return true; }
		else{
			False();
			return false;
		}
	}
	function False() {
		//展示层
		function showLayer(id){
			var layer = $('#'+id),
			layerwrap = layer.find('.hw-layer-wrap');
			layer.fadeIn();
			//屏幕居中
			layerwrap.css({
				'margin-top': -layerwrap.outerHeight()/2
			});
		}

		//隐藏层
		function hideLayer(){
			$('.hw-overlay').fadeOut();
		}

		$('.hwLayer-ok,.hwLayer-cancel,.hwLayer-close').on('click', function() {
			hideLayer();
		});

		//触发弹出层
		$('.show-layer').on('click',  function() {		
			var layerid = $(this).data('show-layer');
			showLayer(layerid);
		});

		//点击或者触控弹出层外的半透明遮罩层，关闭弹出层
		$('.hw-overlay').on('click',  function(event) {
			if (event.target == this){
				hideLayer();
			}
		});

		//按ESC键关闭弹出层
		$(document).keyup(function(event) {
			if (event.keyCode == 27) {
				hideLayer();
			}
		});
	}
	</script>


	<script src="<?php echo base_url(); ?>js/Test_System/radio/jquery.js"></script>
	<script src="<?php echo base_url(); ?>js/Test_System/radio/index.js"></script>

	<script src='<?php echo base_url(); ?>js/Test_System/checkbox/jquery.js'></script>
	<script src="<?php echo base_url(); ?>js/Test_System/checkbox/index.js"></script>
	<script type="text/javascript"> self.setInterval('timer()',60000);</script>
	<script type="text/javascript">
	   function timer()
	   {
	      $.get("question_bank/timer",function(data)
	      {
	      	if(data <= 0)
	      	{
	      		document.examination.submit();
	      	}
	         $('#resttime').html(data);
	      })
	   }
	</script>
<!-- 
  	<script src="dist/js/checkbix.min.js"></script>
	<script type="text/javascript">Checkbix.init();</script>
 -->
<!-- endbower -->
<!-- endbuild -->

<!-- build:js(.tmp) scripts/main.js -->
<script src="<?php echo base_url(); ?>/js/qiandao/main.js"></script>
<!-- endbuild -->

<!-- Baidu Analytics-->
<script>

</script>

</html>
