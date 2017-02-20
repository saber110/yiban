<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 腾讯cos存储接入
 * @package    CodeIgniter
 * @subpackage Libraries
 * @category   Txystore
 * @author hhb <huhaobin110@gmail.com>
 * @date 2016/11/04
 */

// require_once( APPPATH.'third_party/cos-php-sdk/include.php' );
require_once( APPPATH.'third_party/cos-php-sdk/Qcloud_cos/Conf.php' );
require_once( APPPATH.'third_party/cos-php-sdk/Qcloud_cos/Http.php' );
require_once( APPPATH.'third_party/cos-php-sdk/Qcloud_cos/Auth.php' );
require_once( APPPATH.'third_party/cos-php-sdk/Qcloud_cos/Cosapi.php' );

class My_store{

	private $bucketName = 'csuyiban123';

	public function __construct()
	{
		Cosapi::setTimeout(180);
	}
	//创建文件夹
	public function createFolder($dstFolder)
	{
		$createFolderRet = Cosapi::createFolder($this->bucketName, $dstFolder);
		if($createFolderRet['code'] == 0)
		{
			return true;
		}
		else
		{
			return $createFolderRet;
		}
	}
	//上传文件
	/**
	 * sample use: $this->my_store->upload("./uploads/2016_11_07_10_13_03.docx","/yiban/2016_11_07_10_13_03.docx");
	 */
	public function upload($srcPath, $dstPath,$bizAttr="",$sliceSize="3 * 1024 * 1024", $insertOnly=0)
	{
		return $uploadRet = Cosapi::upload($this->bucketName, $srcPath, $dstPath,$bizAttr,$sliceSize, $insertOnly);
	}
	//目录列表
	public function listFolder($dstFolder,$listnum=20,$pattern="eListBoth", $order=0)
	{
		$listRet = Cosapi::listFolder($this->bucketName, $dstFolder,$listnum,$pattern, $order);
		if($listRet['code']==0)
		{
			$i = 0;
			// var_dump($listRet['data']['infos'][0]['name']);
			foreach ($listRet['data']['infos'] as $value) {
				$result['filename'][$i]   = $value['name'];
				$result['access_url'][$i] = $value['access_url'];
				$i++;
			}
			return $result;
		}
		else
		{
				return $listRet;
		}
	}
	//更新目录信息
	public function updateFolder($dstFolder, $bizAttr="")
	{
		return $updateRet = Cosapi::updateFolder($this->bucketName, $dstFolder, $bizAttr);
	}
	//更新文件信息
	public function update($dstPath, $bizAttr= "",$authority="eWPrivateRPublic", $customer_headers_array)
	{
		$customer_headers_array = array(
		    'Cache-Control' => "no",
		    'Content-Type' => "application/pdf",
		    'Content-Language' => "ch",
		);
		return $updateRet = Cosapi::update($this->bucketName, $dstPath, $bizAttr,$authority, $customer_headers_array);
	}
	//查询目录信息
	public function statFolder($dstFolder)
	{
		$statRet = Cosapi::statFolder($this->bucketName, $dstFolder);
		if($statRet['code']==0)
		{
			return $statRet['data']['name'];
		}
		else
		{
			return $statRet;
		}
	}
	//查询文件信息
	public function stat($dstPath)
	{
		return $statRet = Cosapi::stat($this->bucketName, $dstPath);
	}
	//删除文件
	public function delFile($dstPath)
	{
		return	$delRet = Cosapi::delFile($this->bucketName, $dstPath);
	}
	//删除文件夹
	public function delFolder($dstFolder)
	{
		return $delRet = Cosapi::delFolder($this->bucketName, $dstFolder);
	}
}
