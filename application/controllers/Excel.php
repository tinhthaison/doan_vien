<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Excel extends CI_Controller{
public function __construct()
{   parent::__construct();
    $this->load->helper('url');$this->load->helper('file');$this->load->model('Excel_model');
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
    $data['Class_id']=$this->Excel_model->Show_class();
    $this->load->view('admin/Upload_view',$data);$sections = array ('config'  => TRUE, 'queries' => TRUE,'benchmarks'=> FALSE,'memory_usage'=> FALSE,'http_headers'=>FALSE);
    $this->output->set_profiler_sections($sections);
}

    /**
     *
     */
    public function reader(){// xu li file upload
         $data['errors']=NULL;// khoi tao bien data
        if($this->input->post("ok")){// neu an ok de upload
            $class_id=$this->input->post('select_class');
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
                if($this->input->post('select_class')<5){$monhoc_1=array('1','2','4','5','6','7','8','9','10','11','12','13');}else//neu khoi lop nho hon 8 thi bomon hoa
                    $monhoc_1 = array('1','2','3','4','5','6','7','8','9','10','11','12');
                $danh_sach =array();//khoi tao bien danh sach
               $this->Excel_model->Delete_bang_diem($class_id);//xoa bang diem tai lop da chon
                for ($C = 0; $C <= $Count_sheet - 1; $C++) {//load tung sheet trong file excel
                    $sheet = $objPhpExcel->setActiveSheetIndex($C);//sheet dc load tu sheet 0 den het
                    $row = $sheet->getHighestRow();//lay so dong cuoi cung trong file excel
                    $last_column = $sheet->getHighestColumn();//lay ten cot cuoi cung
                    $total_column = PHPExcel_Cell::columnIndexFromString($last_column);// lay vi tri cua ten cot cuoi cuong vd c la 3
                    $data = [];
                    $point = array( "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17","19", "20","21","22","39");//gia tri trong mang tuong ung voi $key trong array file excel tra ve, minh chi lay cac gia tri can thiet
                  /* for ($i = 8; $i <= $row; $i++)//lap hang tu vi tri so 8 vi vi tri 1 cua tieu de
                    {
                        for ($j = 0; $j <= $total_column - 1; $j++)//lap cot
                        {
                            $data[$i - 8][$j] = $sheet->getCellByColumnAndRow($j, $i)->getFormattedValue();//lay gia tri tai vi tri can lay

                    }  }print_r($data);*/
                   for ($i = 8; $i <= $row; $i++)//lap  tu vi tri so 8 cua row
                    {
                        for ($j = 0; $j <= count($point) - 1; $j++)//lap cot
                        {
                            $data[$i - 8][$j] = $sheet->getCellByColumnAndRow($point[$j], $i)->getFormattedValue();//lay gia tri tai vi tri can lay
                        }
                    }//print_r($data);
                    for ($e = 0; $e <= count($data) - 1; $e++) {
                        $danh_sach[$e] =array( 'maso_hocsinh' => $data[$e][0], 'name' => $data[$e][1], 'class_id'=> $class_id);
                        if (!empty($monhoc_1[$C])) {
                            $bang_diem[$e] = ['class_id'=> $class_id,'monhoc_id' => $monhoc_1[$C], 'maso_hocsinh' => $data[$e][0], 'diem_mieng' => $data[$e][2] . '  ' . $data[$e][3],
                                'diem_15' => $data[$e][4] . '  ' . $data[$e][5] . '  ' . $data[$e][6] . '  ' . $data[$e][7] . '  ' . $data[$e][8],
                                'diem_1_tiet' => $data[$e][9] . '  ' . $data[$e][10] . '  ' . $data[$e][11] . '  ' . $data[$e][12] . '  ' . $data[$e][13] . '  ' . $data[$e][14],
                                'diem_thi' => $data[$e][15], 'diem_phay' => $data[$e][17] . $data[$e][20], 'tbm_canam'=>$data[$e][19]];
                        }
                    }
                   //print_r($bang_diem);
                  $this->Excel_model->Add_data_bang_diem($bang_diem);
                }
              $this->Excel_model->Add_data_danh_sach($danh_sach,$class_id);
            }else{
                echo $this->upload->display_errors();}
        }
    }
    public function Mon_hoc(){
        $data=array('Toán','Vật Lí','Hóa Học','Sinh học','Ngữ Văn', 'Lịch sử','Địa lí','Tiếng Anh', 'GDCD','Công Nghệ', 'Thể dục','Âm nhạc','Mỹ Thuật');
        For($i=0;$i<=12;$i++){
            $mon_hoc[$i]=array('ten_monhoc'=>$data[$i]);
            }$this->Excel_model->Mon_hoc($mon_hoc);
        }
        public function Class_update(){
        $data=array('6A','6B','6C','7A','7B','8A','8B','8C','9A','9B','9C');
        For($i=0;$i<=10;$i++){
            $class_id[$i]=array('class_id'=>$i,'class_name'=>$data[$i]);
        }print_r($class_id);
        $this->Excel_model->Class_name($class_id);
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