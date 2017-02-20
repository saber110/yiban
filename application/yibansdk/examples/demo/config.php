<?php
	/**
	 * 例子使用 站内应用 与 网站接入 方式测试
	 * 对应的 AppID 与 AppSecret 可以登录易班开放平台（http://open.yiban.cn）
	 * 从 管理中心 中取得，具体可以查看 https://open.yiban.cn/wiki/index.php?page=%E6%96%B0%E6%89%8B%E5%BC%95%E5%AF%BC
	 *
	 * 站内应用与轻应用接入方式一致
	 *
	 * AppID 与 AppSecret 都是 32位字符串
	 */

	$cfg = array(
		// 站内应用（或轻应用）的配置
		'x' => array(
			'appID'		=> 'd8cd1211841b1a7907777b0d9649c27f',
			'appSecret'	=> '026ae82656cb5a32c997cfb9015bf799',
			'callback'	=> 'http://f.yiban.cn/webapptest'		// 站内应用这里的 callback是管理中心里看到的“站内地址”
		),
		// 网站接入的配置
		'm' => array(
			'appID'		=> '1cad453c00a9d4bb',
			'appSecret'	=> '44f24e60d52a3b4fd9a41bc597147bfd',
			'callback'	=> 'http://www.upwzr.com/2016/03/05/bash-shell.html'
		)
	);

?>
