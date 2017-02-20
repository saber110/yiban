<?php
	
	require('config.php');
	
	if (empty($cfg['x']['callback']))
	{
		$cfg['x']['callback'] = 'javascript: void(0);';
	}
	
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<title>易班开放平台DEMO</title>
	<style>	* { line-height: 32px; } </style>
</head>
<body>
	<div>
		<p style="font-weight: bold;">
			请先修改config.php文件，配置好应用信息才进行测试！
		</p>
	</div>
	<div>
		<a href="<?php echo $cfg['x']['callback']; ?>" target="_blank">站内应用或轻应用DEMO</a>
	</div>
	<div>
		<a href="authorize.php" target="_blank">网站接入DEMO</a>
	</div>
	<div>
		<a href="apicomm.php" target="_blank">功能接口DEMO</a>
	</div>
</body>
</html>