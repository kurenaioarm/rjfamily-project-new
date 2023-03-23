<?php
class Orroom {
    function __construct() {
        $this->jwtext = isset($_SESSION['TOKEN_ENT']) ? $_SESSION['TOKEN_ENT'] : null;
    }

    public function AllAppointMentDCT() {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/ent_service/doc/appointment',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->jwtext
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  json_decode($response);
    }

    public function que($varcode, $orroom, $month = null, $year = null) {
        $url = 'https://appintra.rajavithi.go.th/ent_service/orroom/que';
        $dataFields = '{"varcode":"' . $varcode . '","orroom":"' . $orroom . '","month":"' . $month . '","year":"' . $year . '"}';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $dataFields,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->jwtext,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  json_decode($response);
    }

    public function que_surgeon($varcode, $orroom, $month, $year, $surgeon) {
        $url = 'https://appintra.rajavithi.go.th/ent_service/orroom/que_surgeon';
        $dataFields = '{"varcode":"' . $varcode . '","orroom":"' . $orroom . '","month":"' . $month . '","year":"' . $year . '","surgeon":"' . $surgeon . '"}';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $dataFields,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->jwtext,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  json_decode($response);
    }

    public function que_last_day($varcode, $surgeon) {
        $url = 'https://appintra.rajavithi.go.th/ent_service/orroom/que_last_day';
        $dataFields = '{"varcode":"' . $varcode . '","surgeon":"' . $surgeon . '"}';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $dataFields,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->jwtext,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  json_decode($response);
    }

    public function dct() {
        $url = 'https://appintra.rajavithi.go.th/ent_service/orroom/dct';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->jwtext
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  json_decode($response);
    }

    public function queDate($varcode, $estmdate) {
        $url = 'https://appintra.rajavithi.go.th/ent_service/orroom/queDate';
        $dataFields = '{"varcode":"' . $varcode . '","estmdate":"' . $estmdate . '"}';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $dataFields,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->jwtext,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  json_decode($response);
    }

    public function queDateSurgeon($varcode, $estmdate, $surgeon) {
        $url = 'https://appintra.rajavithi.go.th/ent_service/orroom/queDate_surgeon';
        $dataFields = '{"varcode":"' . $varcode . '","estmdate":"' . $estmdate . '","surgeon":"' . $surgeon . '"}';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $dataFields,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->jwtext,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  json_decode($response);
    }

    public function pt_data($varcode, $estmdate, $hn) {
        //เรียกดูข้อมูลรายบุคคลของผู้ป่วย
        $url = 'https://appintra.rajavithi.go.th/ent_service/orroom/pt_data';
        $dataFields = '{"varcode":"' . $varcode . '","estmdate":"' . $estmdate . '","hn":"' . $hn . '"}';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $dataFields,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->jwtext,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return  json_decode($response);
    }

    public function pt_img($hn) {
        //เรียกดูข้อมูลรายบุคคลของผู้ป่วย
        $url = 'https://appintra.rajavithi.go.th/ent_service/doc/ptPicture';
        $dataFields = '{"hn":"' . $hn . '"}';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $dataFields,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->jwtext,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return  json_decode($response);
    }
}
