<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Excel extends CI_Controller{
public function __construct()
{   parent::__construct();
    $this->load->helper('url');$this->load->helper('file');$this->load->model('Excel_model');
    $this->load->helper('security');
    if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('GMT');
    }require_once APPPATH.'third_party/PHPExcel.php';
 //  $this->output->enable_profiler(TRUE);

}

    public function index()
    {


       // $this->load->library('phpexcel');
       // $this->load->library('PHPExcel/iofactory');
        $data=[['01','minh','21'],['02','son','30'],['03','tung','26']];
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")
            ->setDescription("description");

// Assign cell values
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Số thứ tự');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Họ và tên');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Tuổi');
        //add values row
        // bat dau ghi tu dong thu 2
        $num_row=2;
foreach ($data as $row){
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$num_row,$row[0]);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$num_row,$row[1]);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$num_row,$row[2]);
        $num_row++;}

// Save it as an excel 2003 file
       $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      //  header('Content-Type: application/vnd.ms-excel');
     //   header('Content-Disposition: attachment;filename="bang_diem_cac_mon.xls"');
     //   header('Cache-Control: max-age=0');
      //  if (isset($objWriter)) {
        //    $objWriter->save('php://output');}
    }
public function upload(){//upload file
    $this->load->view('admin/Upload_view');
    $sections = array ('config'  => TRUE, 'queries' => TRUE,'benchmarks'=> FALSE,'memory_usage'=> FALSE,'http_headers'=>FALSE);
    $this->output->set_profiler_sections($sections);
}
    public function upload_pho_cap(){//upload file
        $this->load->view('admin/Upload_view_pho_cap');
        $sections = array ('config'  => TRUE, 'queries' => TRUE,'benchmarks'=> FALSE,'memory_usage'=> FALSE,'http_headers'=>FALSE);
        $this->output->set_profiler_sections($sections);
    }

    /**
     *
     */
    public function reader(){// xu li file upload
         $data['errors']=NULL;// khoi tao bien data
        if($this->input->post("ok")){// neu an ok de upload
            $config['upload_path'] = './uploads/';//dduong dan upload
            $config['allowed_types'] = 'xls|xlsx';//kieu file duoc dung
            $config['overwrite']=TRUE;// cho phepghi de
            $this->load->library("upload", $config);
            $url["url"]=base_url();
            if($this->upload->do_upload("xls")) {// neu upload thanh cong
                $check = $this->upload->data();
                echo 'Upload Ok';
                echo "<pre>";
                print_r($check);
                echo "</pre>";
               $file = (FCPATH . 'uploads/' . $check['file_name']);// duong dan file excel
                $objFile = PHPExcel_IOFactory::identify($file);//nhan dinh file xu ly
                $objData = PHPExcel_IOFactory::createReader($objFile);//doc file
                $objData->SetReadDataOnly(True);// chi doc du lieu
                $objPhpExcel = $objData->load($file);//load du lieu sang dang doi tuong
                $Count_sheet = $objPhpExcel->getSheetCount();//dem cac sheet

                $sheet_name=$objPhpExcel->getSheetNames (); print_r ( $sheet_name);
$data_get=array();$result=array();
                 $data[] = [];$user="";
                  switch ($this->input->post("select")){
                      case 1: $table_name='doan_vien';
                          for($c=0;$c<=$Count_sheet-1;$c++)
                          {

                              $Totalrow = $objPhpExcel->setActiveSheetIndex ($c)->getHighestRow();
//Lấy ra tên cột cuối cùng
                              $LastColumn = $objPhpExcel->setActiveSheetIndex ($c)->getHighestColumn ();
//Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
                              $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
//Tạo mảng chứa dữ liệu
                          //Tiến hành lặp qua từng ô dữ liệu
//----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
                          for ($i = 4; $i <= $Totalrow; $i++) {
//----Lặp cột
                              for ($j = 0; $j < $TotalCol; $j++) {
// Tiến hành lấy giá trị của từng ô đổ vào mảng
                                  $data_get[$c][$i - 2][$j] = $objPhpExcel->setActiveSheetIndex ($c)->getCellByColumnAndRow($j, $i)->getValue();
                              }
                          }
                          }
                  for($i=0;$i<=count($data_get)-1;$i++)
              {
                  for($j=4;$j<=count($data_get[$i])-1;$j++){$birthday=date("Y")-$this->birth_day ($data_get[$i][$j][6]);
                      $user=$this->to_slug ($data_get[$i][$j][1]);
                      $pass_word=$user."_".$this->to_slug ($data_get[$i][$j][4])."_".$birthday;
                      $array_push=array("doan_vien_location" =>$data_get[$i][$j][4],
                          "doan_vien_name"=>$data_get[$i][$j][1],"doan_vien_birthday"=>$birthday,
                          "doan_vien_sex"=>$data_get[$i][$j][3],"doan_vien_class"=>$data_get[$i][$j][6],
                          "doan_vien_user"=>$user,"doan_vien_password"=>md5($pass_word),"chi_doan_id"=>$i+1,"doan_vien_active"=>0
                      );
                      array_push ($result,$array_push);

                  }

              }//end for
                          break;//end case 1
                      case 2:
                              $table_name="chi_doan_info";

                              $Totalrow = $objPhpExcel->setActiveSheetIndex (0)->getHighestRow();
//Lấy ra tên cột cuối cùng
                              $LastColumn = $objPhpExcel->setActiveSheetIndex (0)->getHighestColumn ();
//Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
                              $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
//Tạo mảng chứa dữ liệu
                              //Tiến hành lặp qua từng ô dữ liệu
//----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
                              for ($i = 2; $i <= $Totalrow; $i++) {
//----Lặp cột
                                  for ($j = 0; $j < $TotalCol; $j++) {
// Tiến hành lấy giá trị của từng ô đổ vào mảng
                                      $data_get[$i - 2][$j] = $objPhpExcel->setActiveSheetIndex (0)->getCellByColumnAndRow($j, $i)->getValue();
                                  }
                              }
                          for($i=0;$i<=count($data_get)-1;$i++)
                          {   $user=$this->to_slug ($data_get[$i][1]);
                                  $array_push=array("chi_doan_id_text"=>$this->to_slug ($data_get[$i][3]),"chi_doan_name" =>$data_get[$i][3],"chi_doan_bi_thu" =>$data_get[$i][1],"chi_doan_name" =>$data_get[$i][3],
                                      "chi_doan_phone" =>$data_get[$i][5],"chi_doan_birthday" =>$data_get[$i][4],"chi_doan_user"=>$user,"chi_doan_password"=>md5($user."_".$data_get[$i][4]));
                                  array_push ($result,$array_push);
                          }//end for
                          break;//end case 2
                      case 3:
                              $table_name='thieu_nien';
                          for($c=0;$c<=$Count_sheet-1;$c++)
                          {

                              $Totalrow = $objPhpExcel->setActiveSheetIndex (0)->getHighestRow();
//Lấy ra tên cột cuối cùng
                              $LastColumn = $objPhpExcel->setActiveSheetIndex (0)->getHighestColumn ();
//Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
                              $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
//Tạo mảng chứa dữ liệu
                              //Tiến hành lặp qua từng ô dữ liệu
//----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
                              for ($i = 2; $i <= $Totalrow; $i++) {
//----Lặp cột
                                  for ($j = 0; $j < $TotalCol; $j++) {
// Tiến hành lấy giá trị của từng ô đổ vào mảng
                                      $data_get[$c][$i - 2][$j] = $objPhpExcel->setActiveSheetIndex (0)->getCellByColumnAndRow($j, $i)->getValue();
                                  }
                              }

                          for($i=0;$i<=count($data_get)-1;$i++)
                          {
                              for($j=0;$j<=count($data_get[$i])-1;$j++) {
                                  $array_push = array("thieu_nien_location" => $data_get[$i][$j][5],
                                      "thieu_nien_name" => $data_get[$i][$j][1], "thieu_nien_sex" => $data_get[$i][$j][3],"thieu_nien_birthday"=> $data_get[$i][$j][2] , "thieu_nien_class" => $data_get[$i][$j][4], "thieu_nien_dan_toc" => $data_get[$i][$j][6], "father_phone" => $data_get[$i][$j][7], "mother_phone" => $data_get[$i][$j][8]);
                                  array_push ($result, $array_push);
                              }
                              }

                          }//end for
                          break;//end case 3


                  }//end sw

                    //$result[$c]=array("doan_vien_location"=>$data_get[$c][$i - 2][$j][4],"doan_vien_name"=>$data_get[$c][$i - 2][$j][1],"doan_vien_sex"=>$data_get[$c][$i - 2][$j][3]);

//Hiển thị mảng dữ liệu
          } //print_r ($result);
        }else{
            echo $this->upload->display_errors();
            }
            $this->Excel_model->Add_data_danh_sach($result,$table_name);
    }

               //end wirte data
    public function reader_pho_cap(){// xu li file upload
        $data['errors']=NULL;// khoi tao bien data
        if($this->input->post("ok")){// neu an ok de upload
            $config['upload_path'] = './uploads/';//dduong dan upload
            $config['allowed_types'] = 'xls|xlsx';//kieu file duoc dung
            $config['overwrite']=TRUE;// cho phepghi de
            $this->load->library("upload", $config);
            $url["url"]=base_url();
            if($this->upload->do_upload("xls")) {// neu upload thanh cong
                $check = $this->upload->data();
                echo 'Upload Ok';
                echo "<pre>";
                print_r($check);
                echo "</pre>";
                $file = (FCPATH . 'uploads/' . $check['file_name']);// duong dan file excel
                $objFile = PHPExcel_IOFactory::identify($file);//nhan dinh file xu ly
                $objData = PHPExcel_IOFactory::createReader($objFile);//doc file
                $objData->SetReadDataOnly(True);// chi doc du lieu
                $objPhpExcel = $objData->load($file);//load du lieu sang dang doi tuong
                $Totalrow = $objPhpExcel->setActiveSheetIndex (0)->getHighestRow();


                $Count_sheet = $objPhpExcel->getSheetCount();//dem cac sheet

                $sheet_name=$objPhpExcel->getSheetNames (); print_r ( $sheet_name);
$data_get=array();$result=array();
                 $data[] = [];$user="";
                  switch ($this->input->post("select")){
                      case 1: $table_name='doan_vien';
                          for($c=0;$c<=$Count_sheet-1;$c++)
                          {

                              $Totalrow = $objPhpExcel->setActiveSheetIndex ($c)->getHighestRow();
//Lấy ra tên cột cuối cùng
                              $LastColumn = $objPhpExcel->setActiveSheetIndex ($c)->getHighestColumn ();
//Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
                              $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
//Tạo mảng chứa dữ liệu
                              //Tiến hành lặp qua từng ô dữ liệu
//----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
                              for ($i = 4; $i <= $Totalrow; $i++) {
//----Lặp cột
                                  for ($j = 0; $j < $TotalCol; $j++) {
// Tiến hành lấy giá trị của từng ô đổ vào mảng
                                      $data_get[$c][$i - 2][$j] = $objPhpExcel->setActiveSheetIndex ($c)->getCellByColumnAndRow($j, $i)->getValue();
                                  }
                              }
                          }
                          for($i=0;$i<=count($data_get)-1;$i++)
                          {
                              for($j=4;$j<=count($data_get[$i])-1;$j++){$birthday=date("Y")-$this->birth_day ($data_get[$i][$j][6]);
                                  $user=$this->to_slug ($data_get[$i][$j][1]);
                                  $pass_word=$user."_".$this->to_slug ($data_get[$i][$j][4])."_".$birthday;
                                  $array_push=array("doan_vien_location" =>$data_get[$i][$j][4],
                                      "doan_vien_name"=>$data_get[$i][$j][1],"doan_vien_birthday"=>$birthday,
                                      "doan_vien_sex"=>$data_get[$i][$j][3],"doan_vien_class"=>$data_get[$i][$j][6],
                                      "doan_vien_user"=>$user,"doan_vien_password"=>md5($pass_word),"chi_doan_id"=>$i+1,"doan_vien_active"=>0
                                  );
                                  array_push ($result,$array_push);

                              }

                          }//end for
                          break;//end case 1
                      case 2:
                          $table_name="doan_vien_info_2";
                          /*    $objPhpExcel->getActiveSheet ()->setAutoFilter ( $objPhpExcel->getActiveSheet()
                                 ->calculateWorksheetDimension());
                            $columnFilter=$objPhpExcel->getActiveSheet ()->getAutoFilter ()->getColumn ('G');
                             $min_year_old=date ('Y')-16; $max_year_old=date ('Y')-30;
                                 ->setRule(
                                     PHPExcel_Worksheet_AutoFilter_Column_Rule::
                                     AUTOFILTER_COLUMN_RULE_GREATERTHAN,
                                     2004
                                 )
                                ->setRuleType ( PHPExcel_Worksheet_AutoFilter_Column_Rule::AUTOFILTER_RULETYPE_CUSTOMFILTER );

   */



                          //$objPhpExcel->getActiveSheet ()->getAutoFilter ()->showHideRows ();
                          foreach ($objPhpExcel->getActiveSheet()->getRowIterator() as $row) {
                              if ($objPhpExcel->getActiveSheet()
                                  ->getRowDimension($row->getRowIndex())->getVisible() AND $row->getRowIndex ()>4) {
                                  $birthday=$objPhpExcel->getActiveSheet()
                                          ->getCell(
                                              'G'.$row->getRowIndex()
                                          )
                                          ->getValue();// nnam sinh
                                  $user=$this->to_slug ($objPhpExcel->getActiveSheet()
                                      ->getCell(
                                          'C'.$row->getRowIndex()
                                      )
                                      ->getValue()." ".$objPhpExcel->getActiveSheet()
                                          ->getCell(
                                              'D'.$row->getRowIndex()
                                          )
                                          ->getValue());// ho ten
                                  $location=$objPhpExcel->getActiveSheet()
                                      ->getCell(
                                          'N'.$row->getRowIndex()
                                      )
                                      ->getValue();
                                  $pass_word=$user."_".$this->to_slug ($location)."_".$birthday;
                                  $array_push=array("doan_vien_location" =>$location,
                                      "doan_vien_name"=>$objPhpExcel->getActiveSheet()
                                          ->getCell(
                                              'C'.$row->getRowIndex())->getValue()." ".$objPhpExcel->getActiveSheet()
                                              ->getCell(
                                                  'D'.$row->getRowIndex())->getValue(),"doan_vien_birthday"=>$objPhpExcel->getActiveSheet()
                                          ->getCell(
                                              'E'.$row->getRowIndex())->getValue()."/".$objPhpExcel->getActiveSheet()
                                              ->getCell(
                                                  'F'.$row->getRowIndex())->getValue()."/".$birthday,
                                      "doan_vien_sex"=>$objPhpExcel->getActiveSheet()
                                      ->getCell(
                                          'H'.$row->getRowIndex())->getValue(), "doan_vien_dantoc"=>$objPhpExcel->getActiveSheet()
                                          ->getCell(
                                              'I'.$row->getRowIndex())->getValue(),"doan_vien_class"=>$objPhpExcel->getActiveSheet()
                                      ->getCell(
                                          'S'.$row->getRowIndex())->getValue(),
                                      "doan_vien_user"=>$user,"doan_vien_password"=>md5($pass_word),"chi_doan_id"=>$this->to_slug ($location),"doan_vien_active"=>'',"doan_co_so_id"=>'2');
                                  array_push ($result,$array_push);
                              }
                          }//print_r ($result);
                          break;//end case 2
                      case 3:
                          $table_name='thieu_nien';
                          for($c=0;$c<=$Count_sheet-1;$c++)
                          {

                              $Totalrow = $objPhpExcel->setActiveSheetIndex (0)->getHighestRow();
//Lấy ra tên cột cuối cùng
                              $LastColumn = $objPhpExcel->setActiveSheetIndex (0)->getHighestColumn ();
//Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
                              $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
//Tạo mảng chứa dữ liệu
                              //Tiến hành lặp qua từng ô dữ liệu
//----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
                              for ($i = 2; $i <= $Totalrow; $i++) {
//----Lặp cột
                                  for ($j = 0; $j < $TotalCol; $j++) {
// Tiến hành lấy giá trị của từng ô đổ vào mảng
                                      $data_get[$c][$i - 2][$j] = $objPhpExcel->setActiveSheetIndex (0)->getCellByColumnAndRow($j, $i)->getValue();
                                  }
                              }

                              for($i=0;$i<=count($data_get)-1;$i++)
                              {
                                  for($j=0;$j<=count($data_get[$i])-1;$j++) {
                                      $array_push = array("thieu_nien_location" => $data_get[$i][$j][5],
                                          "thieu_nien_name" => $data_get[$i][$j][1], "thieu_nien_sex" => $data_get[$i][$j][3],"thieu_nien_birthday"=> $data_get[$i][$j][2] , "thieu_nien_class" => $data_get[$i][$j][4], "thieu_nien_dan_toc" => $data_get[$i][$j][6], "father_phone" => $data_get[$i][$j][7], "mother_phone" => $data_get[$i][$j][8]);
                                      array_push ($result, $array_push);
                                  }
                              }

                          }//end for
                          break;//end case 3


                  }//end sw

                    //$result[$c]=array("doan_vien_location"=>$data_get[$c][$i - 2][$j][4],"doan_vien_name"=>$data_get[$c][$i - 2][$j][1],"doan_vien_sex"=>$data_get[$c][$i - 2][$j][3]);

//Hiển thị mảng dữ liệu
          } print_r ($result);$this->Excel_model->Add_data_danh_sach($result,$table_name);
        }else{
            echo $this->upload->display_errors();
        }

    }

    //end wirte data
   public function to_slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
       $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
       $str = preg_replace('/([\s]+)/', '', $str);
        return $str;
    }
    public function birth_day($str){
      return  substr ($str,0,2)+6;
    }
    public function Mon_hoc(){
        $data=array('Toán','Vật Lí','Hóa Học','Sinh học','Ngữ Văn', 'Lịch sử','Địa lí','Tiếng Anh', 'GDCD','Công Nghệ', 'Thể dục','Âm nhạc','Mỹ Thuật');
        For($i=0;$i<=12;$i++){
            $mon_hoc[$i]=array('ten_monhoc'=>$data[$i]);
            }$this->Excel_model->Mon_hoc($mon_hoc);
        }
        public function Class_update(){
        $data=array('6A1','6A2','6A3','6A4','7A5','8A1','8A2','8A3','8A4');
        For($i=0;$i<=count ($data)-1;$i++){
            $class_id[$i]=array('class_id'=>$i,'class_name'=>$data[$i]);
        }print_r($class_id);
        $this->Excel_model->Class_name($class_id);
        }
    public function Thon_update(){
        $data=array('Ba Khe','Bãi Cát','Bờ Hồ','Đèo Mon','Đoàn Kết','Gốc Mít','Hội Trường','Khuôn Phầy','Lẹm', 'Miền Tây', 'Trung Tâm');
        For($i=0;$i<=count ($data)-1;$i++){
            $class_id[$i]=array('thon_id'=>$i,'thon_name'=>$data[$i]);
        }print_r($class_id);
        $this->Excel_model->Thon_name($class_id);
    }
        public function Show_diem(){
            if($this->input->get('ok')){$mark=array('diem_1_tiet','diem_thi','tbm_canam');
            $name=$this->input->get('search');$class=$this->input->get('lua_chon');
         $data['diem']=$this->Excel_model->Show_diem_model($name,$class);
         $data['chart']=$this->Excel_model->Chart($class);
         $data['count']=$this->Excel_model->Get_monhoc($name,$class);
         $data['rank_1_tiet']=$this->Excel_model->Rank_diem($class,$mark['0']);
         $data['rank_thi']=$this->Excel_model->Rank_diem($class,$mark['1']);
         $data['rank_diem_phay']=$this->Excel_model->Rank_diem($class,$mark['2']);
         $this->load->View('admin/showdiem_view',$data);
                }}
}

?>