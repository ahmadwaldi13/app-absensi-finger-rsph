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

    function restart_mesin(){
        $connect_ip=$this->connect_sock();

        if(empty($connect_ip[2]==3)){
            $soap_request='';
            $soap_request = "
                <Restart>
                    <ArgComKey Xsi:type=\"xsd:integer\">" . $this->lib($this->comm_key)->arg_com_key . "</ArgComKey>
                </Restart>
            ";
            $buffer=$this->set_fputs($connect_ip,$soap_request);
            $buffer = $this->parse_data($buffer, "<Information>", "</Information>");
            $buffer = explode("\r\n", $buffer);

            $check_hasil=!empty($buffer[0]) ? $buffer[0] : '';
            if($check_hasil=='Successfully!'){
                return ['success',1];
            }else{
                return ['error',2];
            }
        }else{
            return ['error','Tidak Terkoneksi'];
        }
    }

    function refresh_db_mesin(){
        $connect_ip=$this->connect_sock();

        if(empty($connect_ip[2]==3)){
            $soap_request='';
            $soap_request = "
                <RefreshDb>
                    ".$this->lib($this->comm_key)->arg_com_key ."
                </RefreshDb>
            ";
            $buffer=$this->set_fputs($connect_ip,$soap_request);
            $buffer = explode("\r\n", $buffer);
            $check_hasil='Successfully!';
            if($check_hasil=='Successfully!'){
                return ['success',1];
            }else{
                return ['error',2];
            }
        }else{
            return ['error','Tidak Terkoneksi'];
        }

    }

    function set_waktu_mesin(){
        $connect_ip=$this->connect_sock();

        if(empty($connect_ip[2]==3)){
            $soap_request='';
            $soap_request = "
                <SetDate>
                    ".$this->lib($this->comm_key)->arg_com_key ."
                    <Arg>
                        <Date xsi:type=\"xsd:string\">" . date("Y-m-d") . "</Date>
                        <Time xsi:type=\"xsd:string\">" . date("H:i:s") . "</Time>
                    </Arg>
                </SetDate>
            ";
            $buffer=$this->set_fputs($connect_ip,$soap_request);
            $buffer = $this->parse_data($buffer, "<Information>", "</Information>");
            $buffer = explode("\r\n", $buffer);

            $check_hasil=!empty($buffer[0]) ? $buffer[0] : '';
            if($check_hasil=='Successfully!'){
                return ['success',1];
            }else{
                return ['error',2];
            }
        }else{
            return ['error','Tidak Terkoneksi'];
        }

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
                        'id'=>$this->parse_data($data, "<PIN2>", "</PIN2>"),
                        'name'=>$this->parse_data($data, "<Name>", "</Name>"),
                        'password'=>$this->parse_data($data, "<Password>", "</Password>"),
                        'group'=>$this->parse_data($data, "<Group>", "</Group>"),
                        'privilege'=>$this->parse_data($data, "<Privilege>", "</Privilege>"),
                        'card'=>$this->parse_data($data, "<Card>", "</Card>"),
                        'pin'=>$this->parse_data($data, "<PIN>", "</PIN>"),
                        'pin2'=>$this->parse_data($data, "<PIN2>", "</PIN2>"),
                        'tz1'=>$this->parse_data($data, "<TZ1>", "</TZ1>"),
                        'tz2'=>$this->parse_data($data, "<TZ2>", "</TZ2>"),
                        'tz3'=>$this->parse_data($data, "<TZ3>", "</TZ3>"),
                    ];
                }
            }
            if(empty($jml)){
                return ['error','com key anda salah/tidak ada data'];
            }
        }else{
            return ['error','Tidak Terkoneksi'];
        }

        if($data_tmp){
            return json_encode($data_tmp);
        }
        return '';
    }

    function get_user_tamplate($pin){
        $connect_ip=$this->connect_sock();

        if(empty($connect_ip[2]==3)){
            $pin_x='';
            if($pin){
                $pin_x=$this->lib($pin)->pin;
            }
            // if($id_user){
            //     $pin_x=$this->lib($id_user)->pin;
            // }
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
                        'pin'=>$this->parse_data($data, "<PIN>", "</PIN>"),
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

    function get_log_data_absensi($params=[]){
        ini_set("memory_limit","800M");
        set_time_limit(0);

        $connect_ip=$this->connect_sock();

        if(empty($connect_ip[2]==3)){
            $id_user=!empty($params['id_user']) ? $params['id_user'] : '';

            $tmp_cari_user='<PIN xsi:type=\"xsd:integer\">All</PIN>';
            if(!empty($id_user)){
                $tmp_cari_user="<PIN xsi:type=\"xsd:integer\">".$id_user."</PIN>";
            }

            $soap_request = "
                <GetAttLog>
                    ". $this->lib($this->comm_key)->arg_com_key."
                    <Arg>
                        ".$tmp_cari_user."
                    </Arg>
                </GetAttLog>
            ";

            $buffer=$this->set_fputs($connect_ip,$soap_request);
            $buffer = $this->parse_data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
            $buffer = explode("\r\n", $buffer);

            $check_hasil=!empty($buffer[0]) ? $buffer[0] : '';
            $check_hasil='Successfully!';
            if($check_hasil!='Successfully!'){
                return ['error',2];
            }

            $jml=0;
            $data_tmp=[];
            for($a = 0; $a < count($buffer); $a++) {
                $data = $this->parse_data($buffer[$a], "<Row>", "</Row>");
                if($data){
                    $jml++;
                    $data_tmp[]=[
                        'id'=>$this->parse_data($data, "<PIN>", "</PIN>"),
                        'date_time'=>$this->parse_data($data, "<DateTime>", "</DateTime>"),
                        'verified'=>$this->parse_data($data, "<Verified>", "</Verified>"),
                        'status'=>$this->parse_data($data, "<Status>", "</Status>")
                    ];
                }
            }

        }else{
            return ['error','Tidak Terkoneksi'];
        }
        if($data_tmp){
            return json_encode($data_tmp);
        }
        return '';
    }

    function get_log_data_absensi_tad($params=[]){
        ini_set("memory_limit","800M");
        set_time_limit(0);

        $connect_ip=$this->connect_sock();

        if(empty($connect_ip[2]==3)){
            $tad=$this->connect_tad();
            $logs = $tad->get_att_log();

            $w_start=date('2000-08-01');
            $w_end=date('2000-08-01');
            $logs=$logs->filter_by_date(['start' => $w_start,'end' =>$w_end]);
            $data = $logs->to_json();

            $hasil=json_decode($data);
            if(!empty($hasil['row'])){
                $jml_hasil=count($hasil['row']);
            }else{
                $jml_hasil=0;
            }

            dd($hasil,$jml_hasil);die;

            // return 
        }else{
            return ['error','Tidak Terkoneksi'];
        }
    }

    // function get_user_with_tamplate($id_user=''){
    //     $data_tmp=[];
    //     $get_user=$this->get_user($id_user);
    //     if($get_user){
    //         $get_user=json_decode($get_user);
    //         foreach($get_user as $value){
    //             $tamplate=$this->get_user_tamplate($value->id);
    //             $data_tmp[]=array_merge((array)$value,['tamplate'=>$tamplate]);

    //         }
    //     }

    //     if($data_tmp){
    //         return json_encode($data_tmp);
    //     }
    //     return '';
    // }

    function upload_user_to_mesin($data_user){
        $connect_ip=$this->connect_sock();

        if(empty($connect_ip[2]==3)){
            if($data_user->id_user){

                $soap_request = "
                    <SetUserInfo>
                        ". $this->lib($this->comm_key)->arg_com_key."
                        <Arg>
                            <PIN>" . $data_user->id_user . "</PIN>
                            <Name>" . $data_user->name . "</Name>
                            <Password>". $data_user->password ."</Password>
                            <Group>". $data_user->group ."</Group>
                            <Privilege>". $data_user->privilege ."</Privilege>
                            <Card>". $data_user->card ."</Card>
                            <PIN2>". $data_user->pin2 ."</PIN2>
                        </Arg>
                    </SetUserInfo>";
                $buffer=$this->set_fputs($connect_ip,$soap_request);
                $buffer = $this->parse_data($buffer, "<Information>", "</Information>");

                $check_hasil=!empty($buffer[0]) ? $buffer[0] : '';
                $check_hasil='Successfully!';
                if($check_hasil=='Successfully!'){
                    return ['success',1];
                }else{
                    return ['error',2];
                }
            }else{
                return ['error',2];
            }
        }else{
            return ['error','Tidak Terkoneksi'];
        }

    }

    function upload_user_finger_to_mesin($data_user){
        $connect_ip=$this->connect_sock();

        if(empty($connect_ip[2]==3)){
            if($data_user->id_user){

                $soap_request='';
                $soap_request = "
                    <SetUserTemplate>
                        ".$this->lib($this->comm_key)->arg_com_key ."
                        <Arg>
                            <PIN>". $data_user->id_user ."</PIN>
                            <FingerID>". $data_user->finger_id ."</FingerID>
                            <Size>". strlen($data_user->finger) ."</Size>
                            <Valid>". $data_user->valid ."</Valid>
                            <Template>". $data_user->finger ."</Template>
                        </Arg>
                    </SetUserTemplate>";

                $buffer=$this->set_fputs($connect_ip,$soap_request);
                $buffer = $this->parse_data($buffer, "<SetUserTemplateResponse>", "</SetUserTemplateResponse>");
				$buffer = $this->parse_data($buffer, "<Information>", "</Information>");

                $buffer = explode("\r\n", $buffer);

                $check_hasil=!empty($buffer[0]) ? $buffer[0] : '';

                if($check_hasil=='Successfully!'){
                    return ['success',1];
                }else{
                    return ['error',2];
                }
            }else{
                return ['error',2];
            }
        }else{
            return ['error','Tidak Terkoneksi'];
        }

    }

    function delete_finger_to_mesin($data_user){
        $connect_ip=$this->connect_sock();

        if(empty($connect_ip[2]==3)){
            if($data_user->id){
                $soap_request='';
                $soap_request = "
                    <DeleteTemplate>
                        ".$this->lib($this->comm_key)->arg_com_key ."
                        <Arg>
                            <PIN xsi:type=\"xsd:integer\">" . $data_user->id . "</PIN>
                        </Arg>
                    </DeleteTemplate>
                ";
                $buffer='';
                $buffer=$this->set_fputs($connect_ip,$soap_request);
                $buffer = $this->parse_data($buffer, "<Information>", "</Information>");
                $buffer = explode("\r\n", $buffer);

                $check_hasil=!empty($buffer[0]) ? $buffer[0] : '';
                if($check_hasil=='Successfully!'){
                    return ['success',1];
                }else{
                    return ['error',2];
                }
            }else{
                return ['error',2];
            }
        }else{
            return ['error','Tidak Terkoneksi'];
        }

    }

    function delete_user_to_mesin($data_user){
        $connect_ip=$this->connect_sock();

        if(empty($connect_ip[2]==3)){
            if($data_user->id){
                $soap_request='';
                $soap_request = "
                    <DeleteUser>
                        ".$this->lib($this->comm_key)->arg_com_key ."
                        <Arg>
                            <PIN xsi:type=\"xsd:integer\">" . $data_user->id . "</PIN>
                        </Arg>
                    </DeleteUser>
                ";
                $buffer='';
                $buffer=$this->set_fputs($connect_ip,$soap_request);
                $buffer = $this->parse_data($buffer, "<Information>", "</Information>");
                $buffer = explode("\r\n", $buffer);

                $check_hasil=!empty($buffer[0]) ? $buffer[0] : '';
                if($check_hasil=='Successfully!'){
                    return ['success',1];
                }else{
                    return ['error',2];
                }
            }else{
                return ['error',2];
            }
        }else{
            return ['error','Tidak Terkoneksi'];
        }
    }
}