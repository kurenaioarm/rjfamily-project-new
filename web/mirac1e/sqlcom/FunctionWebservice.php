<?php

class Webservice43
{
    public function XisamToken($user, $pwd, $ip)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/token/get_access_token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '{
                "user":"' . $user . '",
                "pwd":"' . $pwd . '",
                "ip":"' . $ip . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public function PersonFile($token, $hn, $idcard)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/person',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '{
                    "hn": "' . $hn . '",
                    "idcard": "' . $idcard . '"
                }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public function TokenENT()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/ent_service/token/get_access_token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '{"user":"apiauthen","pwd":"9ixLZfoBOxovZgk@91","ip":"'.$ip.'"}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return (object) json_decode($response);
    }

    public function HNPhotos($hn, $token)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/ent_service/doc/ptPicture/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public function Drugallergy($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/drugallergy',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public function NCDscreen($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/ncdscreen',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public function chronicfu($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/chronicfu',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

        public function diagnosis_opd($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/diagnosis_opd',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

        public function diagnosis_ipd($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/diagnosis_ipd',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
    
        public function chronic($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/chronic',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

        public function drug_opd($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/drug_opd',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

        public function drug_ipd($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/drug_ipd',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

        public function procedure_opd($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/procedure_opd',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

            public function procedure_ipd($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/procedure_ipd',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

            public function procedure_refer($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/procedure_refer',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

            public function labfu($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/labfu',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

            public function investigation_refer($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/investigation_refer',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

            public function appointment($hn,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/appointment',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"hn":"' . $hn . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

            public function genogram($idcard,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/genogram',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => '{"idcard":"' . $idcard . '"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

            public function addgenogram($POSTge,$token)
    {
        $curl = curl_init();

  curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://appintra.rajavithi.go.th/filesservice/files/addgenogram',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYHOST => false,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "ge_pid":"' . $POSTge['ge_pid'] . '",
                "ge_key":"' . $POSTge['ge_key'] . '",
                "ge_nam":"' . $POSTge['ge_nam'] . '",
                "ge_sex":"' . $POSTge['ge_sex'] . '",
                "ge_mot":"' . $POSTge['ge_mot'] . '",
                "ge_fat":"' . $POSTge['ge_fat'] . '",
                "ge_rea":"' . $POSTge['ge_rea'] . '",
                "ge_dea":"' . $POSTge['ge_dea'] . '",
                "ge_who":"' . $POSTge['ge_who'] . '",
                "ge_self":"' . $POSTge['ge_self'] . '"
            }',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

}//end 
