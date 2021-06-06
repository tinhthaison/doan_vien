<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class BaucuHDND extends CI_Controller{
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

$data=$this->Excel_model->Get_data_cu_tri();//print_r($data);
        $objPHPExcel_export = new PHPExcel();
        $objPHPExcel_export->setActiveSheetIndex(0);
        $objPHPExcel_export->getActiveSheet()->mergeCells ('C14:C16');
        $objPHPExcel_export->getActiveSheet()->setCellValue('C14', 'Số thứ tự');
        $objPHPExcel_export->getActiveSheet()->mergeCells ('D14:D16');
        $objPHPExcel_export->getActiveSheet()->setCellValue('D14', 'Họ và tên');
        $objPHPExcel_export->getActiveSheet()->mergeCells ('E14:E16');
        $objPHPExcel_export->getActiveSheet()->setCellValue('E14', 'Ngày tháng năm sinh');
        $objPHPExcel_export->getActiveSheet()->mergeCells ('F14:F16');
        $objPHPExcel_export->getActiveSheet()->setCellValue('F14', 'Nam');
        $objPHPExcel_export->getActiveSheet()->mergeCells ('G14:G16');
        $objPHPExcel_export->getActiveSheet()->setCellValue('G14', 'Nữ');
        $objPHPExcel_export->getActiveSheet()->mergeCells ('H14:H16');
        $objPHPExcel_export->getActiveSheet()->setCellValue('H14', 'Dân tộc');
        $objPHPExcel_export->getActiveSheet()->mergeCells ('I14:I16');
        $objPHPExcel_export->getActiveSheet()->setCellValue('I14', 'Nghề nghiệp');
        $objPHPExcel_export->getActiveSheet()->mergeCells ('J14:K15');
        $objPHPExcel_export->getActiveSheet()->setCellValue('J14', 'Nơi cư trú');
        $objPHPExcel_export->getActiveSheet()->setCellValue('J16', 'Thường trú');
        $objPHPExcel_export->getActiveSheet()->setCellValue('K16', 'Tạm trú');
        $objPHPExcel_export->getActiveSheet()->mergeCells ('L14:L16');
        $objPHPExcel_export->getActiveSheet()->setCellValue('L14', 'Bầu cử Quốc hội');
        $objPHPExcel_export->getActiveSheet()->mergeCells ('M14:O15');
        $objPHPExcel_export->getActiveSheet()->setCellValue('M14', 'Bầu cử Đại biểu HĐND');
        $objPHPExcel_export->getActiveSheet()->setCellValue('M16', 'Tỉnh');
        $objPHPExcel_export->getActiveSheet()->setCellValue('N16', 'Huyện');
        $objPHPExcel_export->getActiveSheet()->setCellValue('O16', 'Xã');
        $objPHPExcel_export->getActiveSheet()->mergeCells ('P14:P16');
        $objPHPExcel_export->getActiveSheet()->setCellValue('P14', 'Ghi chú');
        //add values row
        // bat dau ghi tu dong thu 2
             $num_row=17;
             foreach ($data as $row){
                 $objPHPExcel_export->getActiveSheet()->setCellValue('C'.$num_row,$row['stt']);
                 $objPHPExcel_export->getActiveSheet()->setCellValue('D'.$num_row,$row['ho_va_ten']);
                 $objPHPExcel_export->getActiveSheet()->setCellValue('E'.$num_row,$row['year_operation']);
                 if(!empty($row['nam'])){$objPHPExcel_export->getActiveSheet()->setCellValue('F'.$num_row,'x');}
                 if(!empty($row['nu'])){$objPHPExcel_export->getActiveSheet()->setCellValue('G'.$num_row,'x');}
                 $objPHPExcel_export->getActiveSheet()->setCellValue('H'.$num_row,$row['dan_toc']);
                 $objPHPExcel_export->getActiveSheet()->setCellValue('J'.$num_row,'x');
                 $objPHPExcel_export->getActiveSheet()->setCellValue('K'.$num_row,'');
                 $objPHPExcel_export->getActiveSheet()->setCellValue('L'.$num_row,'x');
                 $objPHPExcel_export->getActiveSheet()->setCellValue('M'.$num_row,'x');
                 $objPHPExcel_export->getActiveSheet()->setCellValue('N'.$num_row,'x');
                 $objPHPExcel_export->getActiveSheet()->setCellValue('O'.$num_row,'x');
                 $num_row++; }

// Save it as an excel 2003 file
       $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel_export, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="danh_sach_bo_phieu.xls"');
        header('Cache-Control: max-age=0');
        if (isset($objWriter)) {
            $objWriter->save('php://output');}
    }
    public function upload(){//upload file
        $this->load->view('admin/Upload_dsbophieu_view');
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
                    case 1:
                        $table_name="danh_sach_bo_phieu";
                        for($c=0;$c<=$Count_sheet-1;$c++) {
                            $Totalrow= $objPhpExcel->setActiveSheetIndex ($c)->getHighestRow();
                            $row_index=null; $stt_active="1";
                            foreach ($objPhpExcel->getActiveSheet ()->getRowIterator () as $row) {

                                if($row_index==null){
                                    for($i=1;$i<=$Totalrow;$i++){
                                        if ( $objPhpExcel->getActiveSheet ()
                                                ->getCell('C'.$i)->getValue()=="1"){
                                            $row_index=$i;break;
                                        }
                                    }}; //end if
                                if ($objPhpExcel->getActiveSheet ()
                                        ->getRowDimension ($row->getRowIndex ())->getVisible () AND $row->getRowIndex ()>=$row_index AND $objPhpExcel->getActiveSheet ()
                                        ->getCell('J'.$row->getRowIndex ())->getValue()) {
                                    $STT = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'C' . $row->getRowIndex ()
                                        )
                                        ->getValue ();//STT
                                    if($STT>$stt_active){
                                        $stt_active=$STT;
                                    }
                                    $user = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'D' . $row->getRowIndex ()
                                        )
                                        ->getValue () ;// ho ten
                                   /* $quan_he = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'D' . $row->getRowIndex ()
                                        )
                                        ->getValue () ;// quan he */
                                    $nam = $this->filter_birthday($objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'E' . $row->getRowIndex ()
                                        )
                                        ->getValue (),'/' );// ngay sinh nam
                                    $nu = $this->filter_birthday($objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'F' . $row->getRowIndex ()
                                        )
                                        ->getValue (),'/');// ngay sinh nu
                                  /*  $location = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'J' . $row->getRowIndex ()
                                        )
                                        ->getValue ();*/
                                    $dan_toc = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'J' . $row->getRowIndex ()
                                        )
                                        ->getValue ();
                                 /*   $ton_giao = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'M' . $row->getRowIndex ()
                                        )
                                        ->getValue ();*/
                                /*    $que_quan = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'K' . $row->getRowIndex ()
                                        )
                                        ->getValue ();*/
                                    if($this->year_operation($nam)==null){
                                        $nam_sinh=$this->year_operation($nu);
                                    } else {$nam_sinh=$this->year_operation($nam);}
                                    $array_push = array("noi_bau"=>$sheet_name[$c],"stt"=>$stt_active,
                                        "ho_va_ten" => $user, "nam" => $nam,
                                        "nu" => $nu,  "dan_toc" => $dan_toc,
                                        "year_operation"=>$nam_sinh);
                                    array_push ($result, $array_push);
                                }
                            }
                        } // Assign cell values

                        //print_r ($result);
                        break;//end case 1
                    case 4:
                        $table_name="danh_sach_bo_phieu";
                        for($c=0;$c<=$Count_sheet-1;$c++) {
                            $Totalrow= $objPhpExcel->setActiveSheetIndex ($c)->getHighestRow();
                            $row_index=null; $stt_active="1";
                            foreach ($objPhpExcel->getActiveSheet ()->getRowIterator () as $row) {

                                if($row_index==null){
                                for($i=1;$i<=$Totalrow;$i++){
                                    if ( $objPhpExcel->getActiveSheet ()
                                            ->getCell('A'.$i)->getValue()=="1"){
                                       $row_index=$i;break;
                                    }
                                }}; //end if
                                if ($objPhpExcel->getActiveSheet ()
                                        ->getRowDimension ($row->getRowIndex ())->getVisible () AND $row->getRowIndex ()>=$row_index) {
                                    $STT = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'A' . $row->getRowIndex ()
                                        )
                                        ->getValue ();//STT
                                    if($STT>$stt_active){
                                        $stt_active=$STT;
                                    }
                                    $user = $objPhpExcel->getActiveSheet ()
                                            ->getCell (
                                                'C' . $row->getRowIndex ()
                                            )
                                            ->getValue () ;// ho ten
                                    $quan_he = $objPhpExcel->getActiveSheet ()
                                            ->getCell (
                                                'D' . $row->getRowIndex ()
                                            )
                                            ->getValue () ;// quan he
                                    $nam = $this->filter_birthday($objPhpExcel->getActiveSheet ()
                                            ->getCell (
                                                'E' . $row->getRowIndex ()
                                            )
                                            ->getValue (),'.' );// ngay sinh nam
                                    $nu = $this->filter_birthday($objPhpExcel->getActiveSheet ()
                                            ->getCell (
                                                'F' . $row->getRowIndex ()
                                            )
                                            ->getValue (),'.');// ngay sinh nu
                                    $location = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'J' . $row->getRowIndex ()
                                        )
                                        ->getValue ();
                                    $dan_toc = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'L' . $row->getRowIndex ()
                                        )
                                        ->getValue ();
                                    $ton_giao = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'M' . $row->getRowIndex ()
                                        )
                                        ->getValue ();
                                    $que_quan = $objPhpExcel->getActiveSheet ()
                                        ->getCell (
                                            'K' . $row->getRowIndex ()
                                        )
                                        ->getValue ();
                                    if($this->year_operation($nam)==null){
                                       $nam_sinh=$this->year_operation($nu);
                                        } else {$nam_sinh=$this->year_operation($nam);}
                                    $array_push = array("noi_bau"=>$sheet_name[$c],"stt"=>$stt_active, "noi_sinh" => $location,
                                        "ho_va_ten" => $user, "nam" => $nam,
                                        "nu" => $nu, "quan_he" => $quan_he, "dan_toc" => $dan_toc,
                                        "ton_giao" => $ton_giao, "que_quan" => $que_quan,"year_operation"=>$nam_sinh);
                                    array_push ($result, $array_push);
                                }
                            }
                        }//print_r ($result);
                        break;//end case 4

                }//end sw

                //$result[$c]=array("doan_vien_location"=>$data_get[$c][$i - 2][$j][4],"doan_vien_name"=>$data_get[$c][$i - 2][$j][1],"doan_vien_sex"=>$data_get[$c][$i - 2][$j][3]);

//Hiển thị mảng dữ liệu
            }
            print_r ($result);
        }else{
            echo $this->upload->display_errors();
        }
      $this->Excel_model->Add_data_danh_sach($result,$table_name);
    }

    //end wirte data
    public function year_operation($data){
        $result=$data;
        if(strlen($data)<=7 AND strlen($data)>4){
            $result="01.".$data;

        } elseif( strlen($data)==4){
            $result="01.01.".$data;
        } elseif(strlen($data)==0) {$result=null;}
        return $this->filter_birthday($result,'/');
    }
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
    public function filter_birthday($str,$replace) {
        $str = trim(mb_strtolower($str));
        $str = str_replace('-',$replace, $str);
        $str = str_replace('/',$replace, $str);
        $str = str_replace('.',$replace, $str);
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