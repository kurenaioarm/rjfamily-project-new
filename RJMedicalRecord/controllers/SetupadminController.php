<?php

namespace RJMedicalRecord\controllers;

use RJMedicalRecord\models\LoginForm;
use \yii\web\Controller;
use yii\helpers\Html;
use Yii;

/**
 * Site controller
 */
class SetupadminController extends Controller
{
    public function actionIndex()
    {
        $LoginModel = new LoginForm();

        //============ ตรวจสอบ session arrayAccess_Token กรณีมีการล้างค่า เป็น NULL  ===============
        if(Yii::$app->session->get('arrayAccess_Token') === NULL){
            Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
            return $this->redirect(['login/login_his']);
        }else{
            //===================== เรียกใช้ session arrayAccess_Token  ========================
            $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
            //============================================ 1. API ADMIN =========================================================================
            $API_donate_admin = $this->API_donate_admin("","ADMIN_ALL",$Access_Token['access_token']);
            //============================================ 1. API IP_ALL =========================================================================
            $API_medr_IP_ALL = $this->API_medr_access_ip("","IP_ALL",$Access_Token['access_token']);
            //============================================ 1. API IP_MAX =========================================================================
            $API_medr_IP_MAX = $this->API_medr_access_ip("","IP_MAX",$Access_Token['access_token']);

            //======== ตรวจสอบ Token หมดอายุหรือยัง $API_donate_admin->json_result ==============
            if($API_donate_admin->json_result == true){
                if(Yii::$app->request->post()){
                    if(Yii::$app->request->post('Check-button') == 1){
                        $LoginModel->load(Yii::$app->request->post());
                        if($LoginModel->username == ""){
                            $LoginModel->validate();
                        }else{
                            //============================= เช็ค USERID ว่ามีใน HIS ไหม  =================================
                            $API_staff_name = $this->API_staff_name("","",$LoginModel->username,$Access_Token['access_token']);
                            if($API_staff_name->json_total == 0){
                                Yii::$app->session->setFlash('error',   'ไม่พบข้อมูลชื่อผู้ใช้งาน ในระบบ HIS กรุณาตรวจสอบ');
                            }else{
                                $Check_Admin_id =  $this->API_donate_admin($API_staff_name->json_data[0]->CARDNO,"",$Access_Token['access_token']);
                                if ($Check_Admin_id->json_total == 0){
                                    //============================= เพิ่มสิทธิ์ Admin  =================================
                                    $this->API_add_donate_admin("","ADMIN_INSERT",$API_staff_name->json_data[0]->CARDNO,$API_staff_name->json_data[0]->DSPNAME,$API_staff_name->json_data[0]->LCT,Yii::$app->request->post("LoginForm")["Permission_level"],$Access_Token['access_token']);
                                    Yii::$app->session->setFlash('success', '<b>ทำการเพิ่มสิทธิ์ Admin สำเร็จแล้ว</b>');
                                    return $this->redirect(['setupadmin/index']);
                                }else{
                                    Yii::$app->session->setFlash('error',   'มีสิทธิ์ อยู่แล้ว ไม่สามารถเพิ่มได้อีก');
                                }
                            }
                        }
                    }else if(Yii::$app->request->post('Check-button') == 2){
                        $Check_Admin_id =  $this->API_donate_admin(Yii::$app->request->post("LoginForm")["Idcard"],"",$Access_Token['access_token']);
                        if ($Check_Admin_id->json_total == 0){
                            //============================= เช็ค IDCRD ว่ามีใน HIS ไหม  =================================
                            $API_staff_name = $this->API_staff_name("",Yii::$app->request->post("LoginForm")["Idcard"],"",$Access_Token['access_token']);
                            if($API_staff_name->json_total == 0){
                                Yii::$app->session->setFlash('error',   'ไม่พบข้อมูลเลขบัตรประชาชน ในระบบ HIS กรุณาตรวจสอบ');
                            }else{
                                //============================= เพิ่มสิทธิ์ Admin  =================================
                                $this->API_add_donate_admin("","ADMIN_INSERT",$API_staff_name->json_data[0]->IDCRD,$API_staff_name->json_data[0]->DSPNAME,$API_staff_name->json_data[0]->LCT,Yii::$app->request->post("LoginForm")["Permission_level2"],$Access_Token['access_token']);
                                Yii::$app->session->setFlash('success', '<b>ทำการเพิ่มสิทธิ์ Admin สำเร็จแล้ว</b>');
                                return $this->redirect(['setupadmin/index']);
                            }
                        }else{
                            Yii::$app->session->setFlash('error',   'มีสิทธิ์ อยู่แล้ว ไม่สามารถเพิ่มได้อีก');
                        }
                    }else if(Yii::$app->request->post('Check-button') == 3) {
                        var_dump('TEST');die();
                    }
                }
            }else{
                Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
                return $this->redirect(['login/login_his']);
            }
        }

        return $this->render('index',[
            'model' => $LoginModel,
            'API_donate_admin' => $API_donate_admin,
            'API_medr_IP_ALL' => $API_medr_IP_ALL,
            'API_medr_IP_MAX' => $API_medr_IP_MAX,
        ]);
    }

    public function actionAdmin_delete()
    {
        //===================== เรียกใช้ session arrayAccess_Token  ========================
        $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
        //========================== เรียกใช้ Admin_delete  ==============================
        $this->API_donate_admin(Yii::$app->request->post("User")["ADMIN_ID"],"ADMIN_DELETE",$Access_Token['access_token']);
        Yii::$app->session->setFlash('success', '<b>ทำการลบสิทธิ์เรียบร้อยแล้วแล้ว</b>');
        return $this->redirect(['setupadmin/index']);
    }

    public function actionIp_delete()
    {
        //===================== เรียกใช้ session arrayAccess_Token  ========================
        $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
        //========================== เรียกใช้ Admin_delete  ==============================
        $this->API_medr_access_ip(Yii::$app->request->post("User")["ACCESS_IP"],"IP_DELETE",$Access_Token['access_token']);
        Yii::$app->session->setFlash('success', '<b>ทำการถอน IP ออกเรียบร้อยแล้วแล้ว</b>');
        return $this->redirect(['setupadmin/index']);
    }

    public function actionIp_insert()
    {
        //===================== เรียกใช้ session arrayAccess_Token  ========================
        $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
        //========================== เรียกใช้ Admin_delete  ==============================
        $this->API_medr_IP_INSERT(Yii::$app->request->post("IP_ID"),Yii::$app->request->post("Access_IP"),Yii::$app->request->post("NOTE_IP"),"IP_INSERT",$Access_Token['access_token']);
        Yii::$app->session->setFlash('success', '<b>ทำการเพิ่ม IP เรียบร้อยแล้วแล้ว</b>');
        return $this->redirect(['setupadmin/index']);
    }

    public function API_staff_name($STAFF,$IDCRD,$USERID,$Token){
        $curl = curl_init();
        $ADMINToken = 'STAFF='.$STAFF.'&IDCRD='.$IDCRD.'&USERID='.$USERID;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/allproject_api/staff_name',
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

    public function API_donate_admin($ADMIN_ID,$ADMINTYPE_ID,$Token){
        $curl = curl_init();
        $ADMINToken = 'ADMIN_ID='.$ADMIN_ID.'&ADMINTYPE_ID='.$ADMINTYPE_ID;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/medicalrecord_admin',
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

    public function API_add_donate_admin($ADMIN_ID,$ADMINTYPE_ID,$ADMIN_IDCARD,$ADMIN_NAME,$ADMIN_AGENCY_ID,$TYPE_ID,$Token){
        $curl = curl_init();
        $ADMINToken = 'ADMIN_ID='.$ADMIN_ID.'&ADMINTYPE_ID='.$ADMINTYPE_ID.'&ADMIN_IDCARD='.$ADMIN_IDCARD.'&ADMIN_NAME='.$ADMIN_NAME.'&ADMIN_AGENCY_ID='.$ADMIN_AGENCY_ID.'&TYPE_ID='.$TYPE_ID;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/medicalrecord_api/medicalrecord_admin',
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

    public function API_medr_IP_INSERT($IP_ID,$ACCESS_IP,$NOTE_IP,$IPTYPE,$Token){
        $curl = curl_init();
        $ADMINToken =  'IP_ID='.$IP_ID.'&ACCESS_IP='.$ACCESS_IP.'&NOTE_IP='.$NOTE_IP.'&IPTYPE='.$IPTYPE;
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


}
