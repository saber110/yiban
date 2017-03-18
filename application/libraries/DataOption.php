<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 数据导入和到处
 * @package CodeIgniter
 * @subpackage Libraries
 * @category  PHPExcel
 * @author hhb <huhaobin110@gmail.com>
 * @date 20170103
 */

 require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
 require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php';
 require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel/Reader/Excel5.php';

class DataOption
{

  // function __construct()
  // {
  //   # code...
  // }

  public function Export($title='中南易班',
                          $subtitle=array('A1'=>'姓名','B1'=>'易班id'),
                          $data=array('0'=>'胡皓斌','1'=>7041045),
                          $filename='中南易班.xls')
  {
    // $data = $this->Question_bank_model->admin(2)['list'];

    $objPHPExcel = new PHPExcel();
    $iofactory = new PHPExcel_IOFactory();
    //Excel表格式,
    // var_dump($data);echo "<br \>";
    // exit;
    for($i=0;$i<count($subtitle);$i++)
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue(array_keys($subtitle)[$i], array_values($subtitle)[$i]);
      foreach ($data as $key => $value) {
          $shabi='A';$i=0;
          $key += 2;
          foreach ($value as $value) {
            // echo $key."shabi".$shabi.'value';print_r(($value));echo "<br \>";
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue(($shabi++).$key, ($value));
          }
      }
    // }

    // exit;
    //excel保存在根目录下  如要导出文件，以下改为注释代码
    // $objPHPExcel->getActiveSheet() -> setTitle('中南易班考试系统');
    // $objPHPExcel-> setActiveSheetIndex(0);
    // $objWriter = $iofactory -> createWriter($objPHPExcel, 'Excel2007');
    // $objWriter -> save('YibanEXAM'.date('Y-m-d h:i:s').'.xlsx');
    //导出代码
    $objPHPExcel->getActiveSheet()->setTitle($title);
    $objPHPExcel->setActiveSheetIndex(0);
    $objWriter = $iofactory->createWriter($objPHPExcel, 'Excel2007');
    $filename = $filename;
    //清除php缓存防止乱码
    ob_end_clean();
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
    $objWriter->save('php://output');
  }
}
