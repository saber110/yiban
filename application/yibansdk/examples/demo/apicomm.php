<?php
	/**
	 * 功能测试为获取到访问令牌后就能进行调用的接口的测试
	 * 这些接口调用时不需要调用YBOpenApi::init()设定appid等信息
	 * 而是使用YBOpenApi::bin()来设定访问令牌值后即可使用
	 * 
	 */


	/**
	 * 包含SDK
	 */
	require("../../classes/yb-globals.inc.php");
	
	session_start();
	
	if (empty($_SESSION['__TOKEN__']))
	{
		exit(YBLANG::EXIT_NOT_AUTHORIZED);
	}

	/**
	 * 功能接口只需要token值就可以调用
	 *
	 */
	$api = YBOpenApi::getInstance()->bind($_SESSION['__TOKEN__']);
	
?>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<title>易班开放平台DEMO</title>
	<style type="text/css"> * { font-size: 12px; line-height: 18px; } </style>
</head>
<body>
	<div>
		<h3>用户接口 YBOpenApi::getInstance()->bind()->getUser()</h3>
		<p>
			<?php
			
				$user = $api->getUser();
			
			?>
			<table style="width: 100%;" border="1">
				<tr>
					<td>
						获取当前用户基本信息 <br />
						<strong>$user->me();</strong>
					</td>
					<td>
						<?php print_r($user->me()); ?>
					</td>
				</tr>
				<tr>
					<td>
						获取指定用户基本信息 <br />
						<strong>$user->other();</strong>
					</td>
					<td>
						<?php print_r($user->other(1)); ?>
					</td>
				</tr>
				<tr>
					<td>
						获取当前用户实名信息 <br />
						<strong>$user->realme();</strong>
					</td>
					<td>
						<?php print_r($user->realme()); ?>
					</td>
				</tr>
			</table>
		</p>
	</div>
	<div>
		<h3>好友分组接口 YBOpenApi::getInstance()->bind()->getFriend()</h3>
		<p>
			<?php
			
				$friend = $api->getFriend();
			
			?>
			<table style="width: 100%;" border="1">
				<tr>
					<td>
						获取当前用户好友列表 <br />
						<strong>$friend->myfriends();</strong>
					</td>
					<td>
						<?php print_r($friend->myfriends(1, 10)); ?>
					</td>
				</tr>
				<tr>
					<td>
						与指定用户是否为好友关系 <br />
						<strong>$friend->checkuid();</strong>
					</td>
					<td>
						<?php print_r($friend->checkuid(1)); ?>
					</td>
				</tr>
			</table>
		</p>
	</div>
	<div>
		<h3>授权接口 YBOpenApi::getInstance()->->init()->bind()->getAuthorize()</h3>
		<p>
			<?php
				
				/**
				 * 授权接口里需要 AppID值
				 */
				include_once('config.php');
				$au = $api->init($cfg['m']['appID'], $cfg['m']['appSecret'])->getAuthorize();
			?>
			<table style="width: 100%;" border="1">
				<tr>
					<td>
						查询access_token的相关信息 <br />
						<strong>$au->query();</strong>
					</td>
					<td>
						<?php print_r($au->query()); ?>
					</td>
				</tr>
				<tr>
					<td>
						取消用户的授权 <br />
						<strong>$au->revoke();</strong>
					</td>
					<td>
						<?php
							/**
							 * 取消授权后，访问令牌失效，不可以继续操作接口，需要重新申请授权
							 */
							// print_r($au->revoke());
							// unset($_SESSION['__TOKEN__']);
						?>
					</td>
				</tr>
			</table>
		</p>
	</div>
</body>
</html>