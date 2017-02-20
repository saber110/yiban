


<script>
			function success(){
					if((document.getElementById('content_in').value == null || document.getElementById('content_in').value == "") && document.getElementById().checked == null){return true;}
					else{
						$.get('Expedition/Expedition?name=' + document.getElementById('content_in').value, function(data) {
							notie.alert(1, data, 2);
						})
					}
			}
			function cy(){
					notie.alert(1, '徐琪丰 欧仪  黄佳妮 张淑杰 张超 石雨菲 钟明月 余润泽 徐素 周雅婷 方静颖 黄张懿 庞腾飞 尹嘉宇 周静燕 杨隽 胡皓斌 焦敏', 2);
			}
	</script>

	<script src="<?php echo base_url(); ?>js/changzheng/notie.js"></script>

<script src="<?php echo base_url(); ?>js/changzheng/jquery.js"></script>
	<script src="<?php echo base_url(); ?>js/changzheng/index.js"></script>

</body>
</html>
