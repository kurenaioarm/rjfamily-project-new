<?php

namespace RJMedicalRecord\controllers;

use RJMedicalRecord\models\MedicalRecordForm;
use RJMedicalRecord\models\DatachildForm;
use \yii\web\Controller;
use yii\helpers\Html;
use Yii;

/**
 * Site controller
 */
class MedicalrecordController extends Controller
{
    public function actionIndex()
    {

        $Model = new MedicalRecordForm();


        //===================== เรียกใช้ session arrayAccess_Token  ========================
        $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
        if ($Access_Token == null){
            Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
            return $this->redirect(['login/login_his']);
        }else{
            //============================================== 1. API IP_ALL ==========================================================================
            $API_medr_IP_ALL = $this->API_medr_access_ip("","IP_ALL",$Access_Token['access_token']);
            //============================================= 2. Check Children  ========================================================================
            $API_check_children = $this->API_check_children("0",$Access_Token['access_token']);

            if($API_medr_IP_ALL->json_result == true){
                if($API_medr_IP_ALL->json_data == []){
                    $StatusMode = "[User Mode]";
                    $Check_Privilege = '0'; //ไม่ใช่[Fixed IP Mode]
                }else{
                    $StatusMode = "[Fixed IP Mode]";
                    //============================================ 1. Check Fixed IP  =========================================================================
                    $Check_Fixed_IP = $this->API_medr_access_ip($_SERVER['REMOTE_ADDR'],"",$Access_Token['access_token']);
                    if($Check_Fixed_IP->json_data == []){
                        $Check_Privilege = '1'; //ไม่มีสิทธิ์
                    }else{
                        $Check_Privilege = '2'; //มีสิทธิ์
                    }
                }

                if(Yii::$app->request->post('Check-button') == 1){
                    //============================================ 2. Check Children  =========================================================================
                    $API_check_children = $this->API_check_children(Yii::$app->request->post("MedicalRecordForm")["HN"],$Access_Token['access_token']);
                }
            }else{
                Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
                return $this->redirect(['login/login_his']);
            }
        }

        return $this->render('index',[
            'model' => $Model,
            'API_medr_IP_ALL' => $API_medr_IP_ALL,
            'API_check_children' => $API_check_children,
            'StatusMode' => $StatusMode,
            'Check_Privilege' => $Check_Privilege,
        ]);
    }


    public function actionDatachild()
    {
        $Model = new DatachildForm();

        if(Yii::$app->request->post("Data") == null){
            return $this->redirect(['error']);
        }else{
            //===================== เรียกใช้ session arrayAccess_Token  ========================
            $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
            if ($Access_Token == null){
                Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
                return $this->redirect(['login/login_his']);
            }else{
//            var_dump(Yii::$app->request->post("Data")["ANCDATE"]);die();
                $ADMIT_DATETH = Yii::$app->helper->dateThaiFull(Yii::$app->request->post("Data")["ADMIT_DATE"]); // แปลงวันที่่ไทย
                //============================================== 1. ChkloginENT ==========================================================================
                $API_ChkloginENT = $this->ChkloginENT($_SERVER['REMOTE_ADDR']);
                //============================================== 2. ChkloginHNImg ==========================================================================
                $API_check_hnimg = $this->API_check_hnimg(Yii::$app->request->post("Data")["HN_MUM"],$API_ChkloginENT->access_token);
                $hnimg = $API_check_hnimg->json_data;
                //============================================== 3. Chkdata_children ==========================================================================
                $API_data_children = $this->API_data_children(Yii::$app->request->post("Data")["HN_MUM"],Yii::$app->request->post("Data")["HN_CHILDREN"],Yii::$app->request->post("Data")["AN_MUM"],Yii::$app->request->post("Data")["BRTHDATE_CHILDREN"],$Access_Token['access_token']);
                if($API_data_children->json_result == true){
                    $Data_Children = $API_data_children->json_data;
                    $BRTHDATE_CHILDREN = Yii::$app->helper->dateThaiFull($Data_Children[0]->BRTHDATE_CHILDREN); // แปลงวันที่่ไทย
                    if(Yii::$app->helper->dateThaiFull($Data_Children[0]->EDCMOM) == null){
                        $EDCMOM = "0";
                    }else{
                        $EDCMOM = Yii::$app->helper->dateThaiFull($Data_Children[0]->EDCMOM); // แปลงวันที่่ไทย
                    }
                    //================================================= 4. data_labmom =======================================================================================
                    $API_data_labmom = $this->API_data_labmom(Yii::$app->request->post("Data")["HN_MUM"],Yii::$app->request->post("Data")["ANCNO"],Yii::$app->request->post("Data")["ANCDATE"],Yii::$app->request->post("Data")["ANCTIME"],$Access_Token['access_token']);
                    $Data_labmom = $API_data_labmom->json_data;
                    //================================================= 5. data_labmom2 =======================================================================================
                    $API_data_labmom2 = $this->API_data_labmom2(Yii::$app->request->post("Data")["HN_MUM"],Yii::$app->request->post("Data")["DLVSTDATE"],Yii::$app->request->post("Data")["DLVSTTIME"],$Access_Token['access_token']);
                    $Data_labmom2 = $API_data_labmom2->json_data;
                    //================================================= 6. data_brthsignmed ====================================================================================
                    $API_data_brthsignmed = $this->API_data_brthsignmed(Yii::$app->request->post("Data")["HN_MUM"],Yii::$app->request->post("Data")["DLVSTDATE"],Yii::$app->request->post("Data")["DLVSTTIME"],$Access_Token['access_token']);
                    $Data_brthsignmed = $API_data_brthsignmed->json_data;
                    //================================================= 7. data_mthds ==========================================================================================
                    $API_data_mthds = $this->API_data_mthds(Yii::$app->request->post("Data")["HN_MUM"],Yii::$app->request->post("Data")["DLVSTDATE"],Yii::$app->request->post("Data")["DLVSTTIME"],$Access_Token['access_token']);
                    $Data_mthds = $API_data_mthds->json_data;
                    //================================================= 8. previous_OB ==========================================================================================
                    $API_data_previousOB = $this->API_data_previousOB(Yii::$app->request->post("Data")["HN_MUM"],$Access_Token['access_token']);
                    $Data_previousOB = $API_data_previousOB->json_data;
                    //================================================= 9. present_OB ===========================================================================================
                    $API_data_presentOB = $this->API_data_presentOB(Yii::$app->request->post("Data")["HN_MUM"],Yii::$app->request->post("Data")["DLVSTDATE"],Yii::$app->request->post("Data")["DLVSTTIME"],$Access_Token['access_token']);
                    $Data_presentOB = $API_data_presentOB->json_data;
                    //================================================= 10. data_dlvstdtapgar ====================================================================================
                    $API_data_dlvstdtapgar = $this->API_data_dlvstdtapgar(Yii::$app->request->post("Data")["HN_MUM"],Yii::$app->request->post("Data")["DLVSTDATE"],Yii::$app->request->post("Data")["DLVSTTIME"],$Access_Token['access_token']);
                    $Data_dlvstdtapgar = $API_data_dlvstdtapgar->json_data;


                }else{
                    Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
                    return $this->redirect(['login/login_his']);
                }
            }

            return $this->render('datachild',[
                'model' => $Model,
                'Check_Privilege' => Yii::$app->request->post("Data")["Check_Privilege"],
                'HN_MUM' => Yii::$app->request->post("Data")["HN_MUM"],
                'AN_MUM' => Yii::$app->request->post("Data")["AN_MUM"],
                'CARDNO_MUM' => Yii::$app->request->post("Data")["CARDNO_MUM"],
                'Check_Length' => Yii::$app->request->post("Data")["Check_Length"],
                'ADMIT_DATETH' => $ADMIT_DATETH,
                'BRTHDATE_CHILDREN' => $BRTHDATE_CHILDREN,
                'EDCMOM' => $EDCMOM,
                'HN_Img' => $hnimg,
                'Data_Children' => $Data_Children,
                'Data_labmom' => $Data_labmom,
                'Data_labmom2' => $Data_labmom2,
                'Data_brthsignmed' => $Data_brthsignmed,
                'Data_mthds' => $Data_mthds,
                'Data_previousOB' => $Data_previousOB,
                'Data_presentOB' => $Data_presentOB,
                'Data_dlvstdtapgar' => $Data_dlvstdtapgar,
            ]);
        }
    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function API_medr_access_ip($ACCESS_IP,$IPTYPE,$Token){
        $curl = curl_init();
        $ADMINToken = 'ACCESS_IP='.$ACCESS_IP.'&IPTYPE='.$IPTYPE;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/medr_access_ip',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ADMINToken,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_check_children($HN_MOM,$Token){
        $curl = curl_init();
        $ADMINToken = 'HN_MOM='.$HN_MOM;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/check_children',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ADMINToken,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_data_children($HN_MOM,$HN_CHILDREN,$AN_MOM,$BRTH_CHILDREN,$Token){
        $curl = curl_init();
        $ADMINToken = 'HN_MOM='.$HN_MOM.'&HN_CHILDREN='.$HN_CHILDREN.'&AN_MOM='.$AN_MOM.'&BRTH_CHILDREN='.$BRTH_CHILDREN;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/data_children',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ADMINToken,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_data_labmom($HN_MOM,$ANCNO,$ANCDATE,$ANCTIME,$Token){
        $curl = curl_init();
        $ADMINToken = 'HN_MOM='.$HN_MOM.'&ANCNO='.$ANCNO.'&ANCDATE='.$ANCDATE.'&ANCTIME='.$ANCTIME;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/data_labmom',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ADMINToken,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
    public function API_data_labmom2($HN_MOM,$DLVSTDATE,$DLVSTTIME,$Token){
        $curl = curl_init();
        $ADMINToken = 'HN_MOM='.$HN_MOM.'&DLVSTDATE='.$DLVSTDATE.'&DLVSTTIME='.$DLVSTTIME;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/data_labmom2',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ADMINToken,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_data_mthds($HN_MOM,$DLVSTDATE,$DLVSTTIME,$Token){
        $curl = curl_init();
        $ADMINToken = 'HN_MOM='.$HN_MOM.'&DLVSTDATE='.$DLVSTDATE.'&DLVSTTIME='.$DLVSTTIME;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/data_mthds',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ADMINToken,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_data_brthsignmed($HN_MOM,$DLVSTDATE,$DLVSTTIME,$Token){
        $curl = curl_init();
        $ADMINToken = 'HN_MOM='.$HN_MOM.'&DLVSTDATE='.$DLVSTDATE.'&DLVSTTIME='.$DLVSTTIME;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/data_brthsignmed',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ADMINToken,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_data_previousOB($HN_MOM,$Token){
        $curl = curl_init();
        $ADMINToken = 'HN_MOM='.$HN_MOM;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/data_previousOB',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ADMINToken,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_data_presentOB($HN_MOM,$DLVSTDATE,$DLVSTTIME,$Token){
        $curl = curl_init();
        $ADMINToken = 'HN_MOM='.$HN_MOM.'&DLVSTDATE='.$DLVSTDATE.'&DLVSTTIME='.$DLVSTTIME;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/data_presentOB',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ADMINToken,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_data_dlvstdtapgar($HN_MOM,$DLVSTDATE,$DLVSTTIME,$Token){
        $curl = curl_init();
        $ADMINToken = 'HN_MOM='.$HN_MOM.'&DLVSTDATE='.$DLVSTDATE.'&DLVSTTIME='.$DLVSTTIME;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/data_dlvstdtapgar',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ADMINToken,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function ChkloginENT($IP)
    {
        $ip = $IP;

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


    public function API_check_hnimg($HN_MOM,$Token){
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
            CURLOPT_POSTFIELDS => '{"hn":"' . $HN_MOM . '"}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $Token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

}
