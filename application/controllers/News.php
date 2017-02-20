<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function replace_specialChar($strParam)
	{
	    $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\[|\]|\,|\/|\;|\'|\`|\-|\\\|\|/";
	    return preg_replace($regex,"",$strParam);
	}

	public function index()
	{
		//匹配字符串ctl00_ContentPlaceHolder1_UpdatePanel1
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://xgw.csu.edu.cn/Portal/NewsList.aspx?ChannelId=79");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data['text'] = preg_quote(curl_exec($ch));
		curl_close($ch);

		//$pattern = '|UpdatePanel1.*?|';
		$pattern = '|(?=UpdatePanel1)[^\</div\>][\s\S]+(?<=page)|';
		preg_match_all($pattern, $data['text'], $data['temp']);
		$data['temp1'] = $this->replace_specialChar(serialize($data['temp']));
		$data['result']   = str_replace('href="', 'href="http://xgw.csu.edu.cn/Portal/', $data['temp1']);
		$data['result'] = str_replace('<a><li>','</a><hr/>',$data['result']);
		$data['result'] = str_replace('<li>','',$data['result']);
		$data['result'] = str_replace('middot','',$data['result']);
		$data['result'] = str_replace('a1i0a1i0s6839"UpdatePanel1">','学工新闻<hr/>',$data['result']);
		// print_r($data['test']);

		$this->load->view('news/header');
		$this->load->view('news/xuegong',$data);
		$this->load->view('news/footer');
	}
	
		public function bksy()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://bksy.csu.edu.cn/tztg.htm");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data['text'] = curl_exec($ch);
		curl_close($ch);

		$pattern = '|(?=winstyle60286)[^\</div\>][\s\S]+(?<=headStyle1towm8891k)|';

		preg_match_all($pattern, $data['text'], $data['temp']);
		$data['temp1'] = (serialize($data['temp']));
		$data['result']   = str_replace('href="', 'href="http://bksy.csu.edu.cn/', $data['temp1']);
		$data['result'] = str_replace('&nbsp;</span>','</span><hr/>',$data['result']);
		$data['result'] = str_replace('a:1:{i:0;a:0:{}}','本科生院<hr/>',$data['result']);
		// print_r($data['result']);

		$this->load->view('news/header');
		$this->load->view('news/xuegong',$data);
		$this->load->view('news/footer');
	}

	public function tuanwei()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://54sh.csu.edu.cn/newsarticle?fetchkey=dongtaituan");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data['text'] = preg_quote(curl_exec($ch));
		curl_close($ch);

		$pattern = '|(?="list")[^\</div\>][\s\S]+(?<=newsarticle)|';
		preg_match_all($pattern, $data['text'], $data['temp']);
		$data['temp1'] = $this->replace_specialChar(serialize($data['temp']));
		$data['result']   = str_replace('href="', 'href="http://54sh.csu.edu.cn/', $data['temp1']);
		$data['result'] = str_replace('<a><li>','</a><hr/>',$data['result']);
		$data['result'] = str_replace('<li>','',$data['result']);
		$SecondFilter = 'id="location"';
		$data['result'] = str_replace($SecondFilter, 'style="display:none;"', $data['result']);
		//添加补全爬过来的内容
		$data['result'] = str_replace('onclick="gotoPageNumnewsarticle"', 'onclick="gotoPageNumnewsarticle"/></div>', $data['result']);

		$data['result'] = str_replace('a1i0a1i0s5194""list">','团委动态<hr/>',$data['result']);

		$this->load->view('news/header');
		$this->load->view('news/xuegong',$data);
		$this->load->view('news/footer');
	}

	public function announce()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://54sh.csu.edu.cn/newsarticlelist?fetchkey=shehuibu_ac76d342ef864d71acf00142f3fb0460");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data['text'] = preg_quote(curl_exec($ch));
		curl_close($ch);

		$pattern = '|(?="list")[^\</div\>][\s\S]+(?<=newsarticle)|';
		preg_match_all($pattern, $data['text'], $data['temp']);
		$data['temp1'] = $this->replace_specialChar(serialize($data['temp']));
		$data['result']   = str_replace('href="', 'href="http://54sh.csu.edu.cn/', $data['temp1']);
		$data['result'] = str_replace('<a><li>','</a><hr/>',$data['result']);
		$data['result'] = str_replace('<li>','',$data['result']);
		$SecondFilter = 'id="location"';
		$data['result'] = str_replace($SecondFilter, 'style="display:none;"', $data['result']);
		//添加补全爬过来的内容
		$data['result'] = str_replace('onclick="gotoPageNumnewsarticle"', 'onclick="gotoPageNumnewsarticle"/></div>', $data['result']);

		$data['result'] = str_replace('a1i0a1i0s7327""list">','社会实践<hr/>',$data['result']);

		$this->load->view('news/header');
		$this->load->view('news/xuegong',$data);
		$this->load->view('news/footer');
	}

	public function volunteer()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://54sh.csu.edu.cn/newsarticlelist?fetchkey=zhiyuanbu_0c50e796d56d432ea6d614cdf13a8fc0");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data['text'] = preg_quote(curl_exec($ch));
		curl_close($ch);

		$pattern = '|(?="list")[^\</div\>][\s\S]+(?<=newsarticle)|';
		preg_match_all($pattern, $data['text'], $data['temp']);
		$data['temp1'] = $this->replace_specialChar(serialize($data['temp']));
		$data['result']   = str_replace('href="', 'href="http://54sh.csu.edu.cn/', $data['temp1']);
		$data['result'] = str_replace('<a><li>','</a><hr/>',$data['result']);
		$data['result'] = str_replace('<li>','',$data['result']);
		$SecondFilter = 'id="location"';
		$data['result'] = str_replace($SecondFilter, 'style="display:none;"', $data['result']);
		//添加补全爬过来的内容
		$data['result'] = str_replace('onclick="gotoPageNumnewsarticle"', 'onclick="gotoPageNumnewsarticle"/></div>', $data['result']);

		$data['result'] = str_replace('a1i0a1i0s7377""list">','志愿服务<hr/>',$data['result']);

		$this->load->view('news/header');
		$this->load->view('news/xuegong',$data);
		$this->load->view('news/footer');
	}

	public function recruit()
	{
		$header = array(
			'');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://jobsky.csu.edu.cn/Home/ArticleList/1");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data['text'] = (curl_exec($ch));
		curl_close($ch);

		// $pattern = '|(?="listAll")[\s\S]+(?<=pagination-pages)|';
		// preg_match_all($pattern, $data['text'], $data['temp']);
		// $data['temp1'] = $this->replace_specialChar(serialize($data['temp']));
		// $data['result']   = str_replace('href="', 'http://jobsky.csu.edu.cn/', $data['temp1']);
		// $data['result'] = str_replace('<a><li>','</a><hr/>',$data['result']);
		// $data['result'] = str_replace('<li>','',$data['result']);
		// $SecondFilter = 'id="location"';
		// $data['result'] = str_replace($SecondFilter, 'style="display:none;"', $data['result']);
		// //添加补全爬过来的内容
		// $data['result'] = str_replace('onclick="gotoPageNumnewsarticle"', 'onclick="gotoPageNumnewsarticle"/></div>', $data['result']);

		// $data['result'] = str_replace('a1i0a1i0s7377""list">','志愿服务<hr/>',$data['result']);

		$this->load->view('news/header');
		$this->load->view('news/xuegong',$data);
		$this->load->view('news/footer');
	}

	public function replace_campus($strParam)
	{
	    $regex = "/|\\\|/";
	    return preg_replace($regex,"",$strParam);
	}

	public function campus()
	{
		//匹配字符串ctl00_ContentPlaceHolder1_UpdatePanel1
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://news.csu.edu.cn/xxyw.htm");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data['text'] = preg_quote(curl_exec($ch));
		curl_close($ch);

		//$pattern = '|UpdatePanel1.*?|';
		$pattern = '|(?=subNewList)[\s\S]+(?<=UL)|';
		preg_match_all($pattern, $data['text'], $data['temp']);
		$data['temp1'] = $this->replace_campus(serialize($data['temp']));
		$data['result']   = str_replace('href="', 'href="http://news.csu.edu.cn/', $data['temp1']);
		// $data['result'] = str_replace('<a><li>','</a><hr/>',$data['temp1']);
		$data['result'] = str_replace('</li>','</li><hr />',$data['result']);
		$data['result'] = str_replace('a:1:{i:0;a:1:{i:0;s:16067:"subNewList">','学校要闻<hr/>',$data['result']);
		// print_r($data['test']);

		$this->load->view('news/header');
		$this->load->view('news/xuegong',$data);
		$this->load->view('news/footer');
	}

	public function famous()
	{
		//匹配字符串ctl00_ContentPlaceHolder1_UpdatePanel1
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://news.csu.edu.cn/znrw.htm");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data['text'] = preg_quote(curl_exec($ch));
		curl_close($ch);

		//$pattern = '|UpdatePanel1.*?|';
		$pattern = '|(?=subNewList)[\s\S]+(?<=UL)|';
		preg_match_all($pattern, $data['text'], $data['temp']);
		$data['temp1'] = $this->replace_campus(serialize($data['temp']));
		$data['result']   = str_replace('href="', 'href="http://news.csu.edu.cn/', $data['temp1']);
		// $data['result'] = str_replace('<a><li>','</a><hr/>',$data['temp1']);
		$data['result'] = str_replace('</li>','</li><hr />',$data['result']);
		$data['result'] = str_replace('a:1:{i:0;a:1:{i:0;s:14558:"subNewList">','中南人物<hr/>',$data['result']);
		// print_r($data['test']);

		$this->load->view('news/header');
		$this->load->view('news/xuegong',$data);
		$this->load->view('news/footer');
	}

	public function story()
	{
		//匹配字符串ctl00_ContentPlaceHolder1_UpdatePanel1
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://news.csu.edu.cn/zngs.htm");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data['text'] = preg_quote(curl_exec($ch));
		curl_close($ch);

		//$pattern = '|UpdatePanel1.*?|';
		$pattern = '|(?=subNewList)[\s\S]+(?<=UL)|';
		preg_match_all($pattern, $data['text'], $data['temp']);
		$data['temp1'] = $this->replace_campus(serialize($data['temp']));
		$data['result']   = str_replace('href="', 'href="http://news.csu.edu.cn/', $data['temp1']);
		// $data['result'] = str_replace('<a><li>','</a><hr/>',$data['temp1']);
		$data['result'] = str_replace('</li>','</li><hr />',$data['result']);
		$data['result'] = str_replace('a:1:{i:0;a:1:{i:0;s:11890:"subNewList">','中南故事<hr/>',$data['result']);
		// print_r($data['test']);

		$this->load->view('news/header');
		$this->load->view('news/xuegong',$data);
		$this->load->view('news/footer');
	}

	public function xstd()
	{
		//匹配字符串ctl00_ContentPlaceHolder1_UpdatePanel1
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://news.csu.edu.cn/xstd.htm");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data['text'] = preg_quote(curl_exec($ch));
		curl_close($ch);

		//$pattern = '|UpdatePanel1.*?|';
		$pattern = '|(?=subNewList)[\s\S]+(?<=UL)|';
		preg_match_all($pattern, $data['text'], $data['temp']);
		$data['temp1'] = $this->replace_campus(serialize($data['temp']));
		$data['result']   = str_replace('href="', 'href="http://news.csu.edu.cn/', $data['temp1']);
		// $data['result'] = str_replace('<a><li>','</a><hr/>',$data['temp1']);
		$data['result'] = str_replace('</li>','</li><hr />',$data['result']);
		$data['result'] = str_replace('a:1:{i:0;a:1:{i:0;s:15708:"subNewList">','学生天地<hr/>',$data['result']);
		// print_r($data['test']);

		$this->load->view('news/header');
		$this->load->view('news/xuegong',$data);
		$this->load->view('news/footer');
	}

	public function news()
	{
		//匹配字符串ctl00_ContentPlaceHolder1_UpdatePanel1
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://news.csu.edu.cn/zhxw.htm");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data['text'] = preg_quote(curl_exec($ch));
		curl_close($ch);

		//$pattern = '|UpdatePanel1.*?|';
		$pattern = '|(?=subNewList)[\s\S]+(?<=UL)|';
		preg_match_all($pattern, $data['text'], $data['temp']);
		$data['temp1'] = $this->replace_campus(serialize($data['temp']));
		$data['result']   = str_replace('href="', 'href="http://news.csu.edu.cn/', $data['temp1']);
		// $data['result'] = str_replace('<a><li>','</a><hr/>',$data['temp1']);
		$data['result'] = str_replace('</li>','</li><hr />',$data['result']);
		$data['result'] = str_replace('a:1:{i:0;a:1:{i:0;s:15726:"subNewList">','综合新闻<hr/>',$data['result']);
		// print_r($data['test']);

		$this->load->view('news/header');
		$this->load->view('news/xuegong',$data);
		$this->load->view('news/footer');
	}
}