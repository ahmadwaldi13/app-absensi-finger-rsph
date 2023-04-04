<?php

namespace App\Services;

class MesinFinger extends \App\Classes\SoapMesinFinger
{
    public $ip = null;
    public $port = 80;
    public $comm_key = 0;

    public function __construct($ip = null,$comm_key = null, $port = null){
        if ($ip != null) {
            $this->ip = $ip;
        }
        if ($port != null) {
            $this->port = $port;
        }

        if ($comm_key != null) {
            $this->comm_key = $comm_key;
        }

        parent::__construct($this->ip,$this->comm_key,$this->port);
    }

    function get_user($id_user=''){
        $connect_ip=$this->connect_sock();
        
        if(empty($connect_ip[2]==3)){
            $pin_x='';
            if($id_user){
                $pin_x=$this->lib($id_user)->pin;
            }
            $soap_request='';
            $soap_request.=$this->lib($this->comm_key)->arg_com_key;
            $soap_request.="<Arg>".$pin_x."</Arg>";
            $soap_request="<GetUserInfo>".$soap_request."</GetUserInfo>";
            $buffer=$this->set_fputs($connect_ip,$soap_request);
            $buffer = $this->parse_data($buffer, "<GetUserInfoResponse>", "</GetUserInfoResponse>");
            $buffer = explode("\r\n", $buffer);
            $jml=0;
            $data_tmp=[];
            for($a = 0; $a < count($buffer); $a++) {
                $data = $this->parse_data($buffer[$a], "<Row>", "</Row>");
                if($data){
                    $jml++;
                    $data_tmp[]=[
                        'id'=>$this->parse_data($data, "<PIN>", "</PIN>"),
                        'name'=>$this->parse_data($data, "<Name>", "</Name>"),
                        'password'=>$this->parse_data($data, "<Password>", "</Password>"),
                        'group'=>$this->parse_data($data, "<Group>", "</Group>"),
                        'privilege'=>$this->parse_data($data, "<Privilege>", "</Privilege>"),
                        'card'=>$this->parse_data($data, "<Card>", "</Card>"),
                        'pin2'=>$this->parse_data($data, "<PIN2>", "</PIN2>"),
                        'tz1'=>$this->parse_data($data, "<TZ1>", "</TZ1>"),
                        'tz2'=>$this->parse_data($data, "<TZ2>", "</TZ2>"),
                        'tz3'=>$this->parse_data($data, "<TZ3>", "</TZ3>"),
                    ];   
                }
            }
            
            if(empty($jml)){
                dd('com key anda salah/tidak ada data');
            }
        }else{
            dd('tidak konek');
        }

        if($data_tmp){
            return json_encode($data_tmp);
        }
        return '';
    }

    function get_user_dummy(){
        $buffer=[
            "",
            "<Row><PIN>1</PIN><Name>sayuti</Name><Password></Password><Group>1</Group><Privilege>0</Privilege><Card>0</Card><PIN2>1</PIN2><TZ1>0</TZ1><TZ2>0</TZ2><TZ3>0</TZ3></Row>",
            "<Row><PIN>2</PIN><Name>jiwana</Name><Password>123456</Password><Group>1</Group><Privilege>0</Privilege><Card>0</Card><PIN2>2</PIN2><TZ1>0</TZ1><TZ2>0</TZ2><TZ3>0</TZ3></Row>",
            "<Row><PIN>3</PIN><Name>admin</Name><Password>123123</Password><Group>1</Group><Privilege>14</Privilege><Card>0</Card><PIN2>3</PIN2><TZ1>0</TZ1><TZ2>0</TZ2><TZ3>0</TZ3></Row>",
            "<Row><PIN>4</PIN><Name>angga</Name><Password></Password><Group>1</Group><Privilege>0</Privilege><Card>0</Card><PIN2>4</PIN2><TZ1>0</TZ1><TZ2>0</TZ2><TZ3>0</TZ3></Row>",
            "<Row><PIN>5</PIN><Name>Wmn</Name><Password>123</Password><Group>1</Group><Privilege>0</Privilege><Card>0</Card><PIN2>5</PIN2><TZ1>0</TZ1><TZ2>1</TZ2><TZ3>0</TZ3></Row>",
            "",
        ];
        $jml=0;
        $data_tmp=[];
        for($a = 0; $a < count($buffer); $a++) {
            $data = $this->parse_data($buffer[$a], "<Row>", "</Row>");
            if($data){
                $jml++;
                $data_tmp[]=[
                    'id'=>$this->parse_data($data, "<PIN>", "</PIN>"),
                    'name'=>$this->parse_data($data, "<Name>", "</Name>"),
                    'password'=>$this->parse_data($data, "<Password>", "</Password>"),
                    'group'=>$this->parse_data($data, "<Group>", "</Group>"),
                    'privilege'=>$this->parse_data($data, "<Privilege>", "</Privilege>"),
                    'card'=>$this->parse_data($data, "<Card>", "</Card>"),
                    'pin2'=>$this->parse_data($data, "<PIN2>", "</PIN2>"),
                    'tz1'=>$this->parse_data($data, "<TZ1>", "</TZ1>"),
                    'tz2'=>$this->parse_data($data, "<TZ2>", "</TZ2>"),
                    'tz3'=>$this->parse_data($data, "<TZ3>", "</TZ3>"),
                ];   
            }
        }

        if($data_tmp){
            return json_encode($data_tmp);
        }
        return '';
    }

    function get_user_tamplate($id_user){
        $connect_ip=$this->connect_sock();
        
        if(empty($connect_ip[2]==3)){
            $pin_x='';
            if($id_user){
                $pin_x=$this->lib($id_user)->pin;
            }
            $soap_request='';
            $soap_request.=$this->lib($this->comm_key)->arg_com_key;
            $soap_request.="<Arg>".$pin_x."</Arg>";
            $soap_request="<GetUserTemplate>".$soap_request."</GetUserTemplate>";
            $buffer=$this->set_fputs($connect_ip,$soap_request);
            $buffer = $this->parse_data($buffer, "<GetUserTemplateResponse>", "</GetUserTemplateResponse>");
            $buffer = explode("\r\n", $buffer);
            $jml=0;
            $data_tmp=[];

            for($a = 0; $a < count($buffer); $a++) {
                $data = $this->parse_data($buffer[$a], "<Row>", "</Row>");
                if($data){
                    $jml++;
                    $data_tmp[]=[
                        'id'=>$this->parse_data($data, "<PIN>", "</PIN>"),
                        'finger_id'=>$this->parse_data($data, "<FingerID>", "</FingerID>"),
                        'size'=>$this->parse_data($data, "<Size>", "</Size>"),
                        'valid'=>$this->parse_data($data, "<Valid>", "</Valid>"),
                        'template'=>$this->parse_data($data, "<Template>", "</Template>"),
                    ];   
                }
            }
            
        }else{
            dd('tidak konek');
        }

        if($data_tmp){
            return $data_tmp;
        }
        return '';
    }

    function get_user_with_tamplate($id_user=''){
        $data_tmp=[];
        $get_user=$this->get_user($id_user);
        if($get_user){
            $get_user=json_decode($get_user);
            foreach($get_user as $value){
                $tamplate=$this->get_user_tamplate($value->id);
                $data_tmp[]=array_merge((array)$value,['tamplate'=>$tamplate]);
                
            }
        }

        if($data_tmp){
            return json_encode($data_tmp);
        }
        return '';
    }

    public function _checkExists($pin, $datetime)
    {
      $userData = UserData::where('user_id', $pin)->where('datetime', $datetime)->get();
      return $userData;
    }

    function get_presensi(){
      $fp = ( new \App\Models\RefMesinAbsensi )->get();

      if (count($fp) == 0) {
        return "tidak ada mesin absensi!";
      }

      foreach ($fp as $key => $value) {
        $IP = $value->ip;
        $Key = $value->comkey;

        if ($IP == "") {
          $IP = $value->ip;
        }
        if ($Key == "") {
          $Key = $value->comkey;
        }

        $connect = @fsockopen($IP, '80', $errno, $errstr, 1);
        if($connect) {
          $soapRequest = "<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
          $newLine = "\r\n";
          fputs($connect, "POST /iWsService HTTP/1.0".$newLine);
          fputs($connect, "Content-Type: text/xml".$newLine);
          fputs($connect, "Content-Length: ".strlen($soapRequest).$newLine.$newLine);
          fputs($connect, $soapRequest.$newLine);
          $buffer = "";
          while ($response = fgets($connect, 1024)) {
            $buffer = $buffer.$response;
          }
        } else {
            return "Koneksi Gagal";
        }
        $buffer = $this->parse_data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
        $buffer = explode("\r\n", $buffer);

        $create = [];
        for ($a=1; $a < count($buffer); $a++) {
          $data = $this->parse_data($buffer[$a], "<Row>", "</Row>");

          $pin = $this->parse_data($data, "<PIN>", "</PIN>");
          
          $datetime  = $this->parse_data($data, "<DateTime>", "</DateTime>");

          if ($data != "") {
            if (!count($this->_checkExists($pin, $datetime)) > 0) {
              $create[] = [
                'user_id' => $pin,
                'datetime' => $datetime,
                'machine_id' => $value->id,
                'created_at' => $datetime
            ];
            }
          }
        }
        // dd(count($create));
        (new \App\Models\UxuiDataPresensi)::insert($create);
    }
        return $create;

    }
}