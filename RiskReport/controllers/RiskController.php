<?php
namespace RiskReport\controllers;

use RiskReport\models\RiskReportForm;
use \yii\web\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Yii;

class RiskController extends Controller
{
    public function actionIndex()
    {
        //=============== การใช้ session=======================
        //Yii::$app->session->get('arrayAccess_Token'); //session นำมาใช้
        //Yii::$app->session->set('arrayAccess_Token'); //session เก็บ
        //================================================

        $RiskReportModel = new RiskReportForm();

        //========================== วันที่และเวลาปัจจุบัน และ แปลงเป็นไทย =================================
        $Current_Date = date("Y-m-d"); //วันที่ปัจจุบัน
        $Current_Time = date("H:i:s"); //เวลาที่ปัจจุบัน
        $Current_DateThai = Yii::$app->helper->dateThaiFull($Current_Date); // แปลงวันที่่ไทย
        //============ ตรวจสอบ session arrayAccess_Token กรณีมีการล้างค่า เป็น NULL  ===============
        if(Yii::$app->session->get('arrayAccess_Token') === NULL){
            Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
            return $this->redirect(['login/login_his']);
        }else{

            //===================== เรียกใช้ session arrayAccess_Token  ========================
            $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
//            var_dump($Access_Token['user']->staff_name );die();
//            var_dump($Current_DateThai,$Current_Time,$Access_Token['user']->staff_name,$Access_Token['user']->staff_div );die();
            if($Access_Token['admin']->json_data === []){
                $ADMIN_ID = "";
            }else{
                $ADMIN_ID = $Access_Token['admin']->json_data[0]->ADMIN_ID;
            }

            //============================================ 1. API ADMIN =================================================
            $API_riskreport_admin = $this->API_riskreport_admin($ADMIN_ID,$Access_Token['access_token']);
            //================================== 2. API ประเภทเรื่องที่แจ้ง INFORMTYPE_ID =========================================
            $API_riskreport_rminformtype = $this->API_riskreport_rminformtype("",$Access_Token['access_token']);
            //======================================= 3. API ประเภทความเสี่ยง RMGRP ============================================
            $API_select_rmgrp = $this->API_select_rmgrp("","",$Access_Token['access_token']);
            //====================================== 4. API เรื่องความเสี่ยง RMTYPEGRP  ==========================================
            $API_select_rmtypegrp = $this->API_select_rmtypegrp("","",$Access_Token['access_token']);
            //======================================= 5. API รายการความเสี่ย RMTYPE ============================================
            $API_select_rmtype = $this->API_select_rmtype("","",$Access_Token['access_token']);
            //==========================================  6. API Group ความเสี่ยง  ===============================================
            $API_select_rmgroup = $this->API_select_rmgroup("",$Access_Token['access_token']);
            //=========================================== 7. API สถานที่ที่เกิดเหตุ  =================================================
            $API_riskreport_rmplace = $this->API_riskreport_rmplace("",$Access_Token['access_token']);
            //=========================================== 8. API หน่วยงานที่เกิดเหตุ  ================================================
            $API_riskreport_rmlct = $this->API_riskreport_rmlct("",$Access_Token['access_token']);
            //=========================================== 9. API ระดับความรุนแรง  ================================================
            $API_select_rmleveldtl = $this->API_select_rmleveldtl("0",$Access_Token['access_token']);

            //======== ตรวจสอบ Token หมดอายุหรือยัง $API_riskreport_admin->json_result ==============
            if( $API_riskreport_rminformtype->json_result == true && $API_riskreport_admin->json_result == true && $API_select_rmgrp->json_result == true  && $API_select_rmtypegrp->json_result == true
                && $API_select_rmtype->json_result == true && $API_select_rmgroup->json_result == true  && $API_riskreport_rmplace->json_result == true  && $API_riskreport_rmlct->json_result == true ){
                //=========================================== สร้าง Array ข้อมูลประเภทเรื่องที่แจ้ง ======================================================
                $Array_rminformtype = array();
                if (isset($API_riskreport_rminformtype)) {
                    foreach ($API_riskreport_rminformtype->json_data as $data_rminformtyp){
                        $DataID_Rminformtyp =  $data_rminformtyp->INFORMTYPE;
                        $DataNAME_Rminformtyp =  $data_rminformtyp->NAME ;
                        $Array_rminformtype[$DataID_Rminformtyp]=$DataNAME_Rminformtyp; //การสร้าง Array แบบกำหนด  key value
                    }
                }
                //=========================================== สร้าง Array ข้อมูลสถานที่ที่เกิดเหตุ ======================================================
                $Array_rmplace = array();
                if (isset($API_riskreport_rmplace)) {
                    foreach ($API_riskreport_rmplace->json_data as $data_rmplace){
                        $DataID_Rmplace =  $data_rmplace->RMPLACE;
                        $DataNAME_Rmplace =  $data_rmplace->NAME ;
                        $Array_rmplace[$DataID_Rmplace]=$DataNAME_Rmplace; //การสร้าง Array แบบกำหนด  key value
                    }
                }
                //=========================================== สร้าง Array ข้อมูลหน่วยงานที่เกิดเหตุ ====================================================
                $Array_rmlct = array();
                if (isset($API_riskreport_rmlct)) {
                    foreach ($API_riskreport_rmlct->json_data as $data_rmlct){
                        $DataID_Rmlct =  $data_rmlct->RMLCT;
                        $DataNAME_Rmlct =  $data_rmlct->NAME ;
                        $Array_rmlct[$DataID_Rmlct]=$DataNAME_Rmlct; //การสร้าง Array แบบกำหนด  key value
                    }
                }
                //=============================================== ข้อมูลหลังจากกดปุ่มบันทึก =========================================================
                if(Yii::$app->request->post()) {
                    if(Yii::$app->request->post('Check-button') == 1){
                        $RiskDate = Yii::$app->request->post();
                        var_dump(Yii::$app->request->post('RadiosRMTYPE'));
                        $RadiosRMTYPE = explode("-", Yii::$app->request->post("RadiosRMTYPE")); //แบ่งข้อความ PHP
                        //==========================================  5. API Group ความเสี่ยง  ===============================================
                        $API_select_rmgroup = $this->API_select_rmgroup($RadiosRMTYPE[0],$Access_Token['access_token']);
                        var_dump($RiskDate);
                    }
                }
            }else{
                Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
                return $this->redirect(['login/login_his']);
            }
        }

        return $this->render('index',[
            'model' => $RiskReportModel,
            'Access_Token' => $Access_Token,
            'API_select_rminformtype' => $API_riskreport_rminformtype,
            'API_select_rmgrp' => $API_select_rmgrp,
            'API_select_rmtypegrp' => $API_select_rmtypegrp,
            'API_select_rmtype' => $API_select_rmtype,
             'API_select_rmgroup' => $API_select_rmgroup,
            'API_select_rmleveldtl'  => $API_select_rmleveldtl,
            'Current_DateThai' => $Current_DateThai,
            'Current_Time' => $Current_Time,
            'Array_rminformtype' => $Array_rminformtype,
            'Array_rmplace' => $Array_rmplace,
            'Array_rmlct' => $Array_rmlct,
        ]);
    }

    public function actionCheckrmlc(){ //กดมาจาก Incident_Location = สถานที่เกิดเหตุ
//        var_dump(Yii::$app->request->post("Incident_Location"));die();
        $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
        //=========================== สร้าง Array ข้อมูลหน่วยงานที่เกิดเหตุ ============================================
        $Array_rmlct = array();
        $API_riskreport_rmlct = $this->API_check_rmlct(Yii::$app->request->post("Incident_Location"),$Access_Token['access_token']);

        if (isset($API_riskreport_rmlct)) {
            foreach ($API_riskreport_rmlct->json_data as $data_rmlct){
                $DataID_Rmlct =  $data_rmlct->RMLCT;
                $DataNAME_Rmlct =  $data_rmlct->NAME ;
                $Array_rmlct[$DataID_Rmlct]=$DataNAME_Rmlct; //การสร้าง Array แบบกำหนด  key value
            }
        }

        return $this->renderAjax('_Incident_Agency', [ //หน่วยงานที่เกิดเหตุ
            'Array_rmlct' => $Array_rmlct,
            'Length_V2' => Yii::$app->request->post('Length_V2')
        ]);
    }

    public function actionCheckrmplace(){ //กดมาจาก Incident_Agency = หน่วยงานที่เกิดเหตุ
//        var_dump(Yii::$app->request->post("Incident_Agency"));die();
        $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
        //=========================== สร้าง Array ข้อมูลหน่วยงานที่เกิดเหตุ ============================================
        $Array_rmplace = array();
        $API_riskreport_rmlct = $this->API_riskreport_rmlct(Yii::$app->request->post("Incident_Agency"),$Access_Token['access_token']);
        if($API_riskreport_rmlct->json_total > 1){
            $API_RMPLACEID = "" ;
        }else{
            $API_RMPLACEID = $API_riskreport_rmlct->json_data[0]->RMPLACE ;
        }
        $API_riskreport_rmplace = $this->API_riskreport_rmplace($API_RMPLACEID,$Access_Token['access_token']);

        if (isset($API_riskreport_rmplace)) {
            foreach ($API_riskreport_rmplace->json_data as $data_rmplace){
                $DataID_Rmplace =  $data_rmplace->RMPLACE;
                $DataNAME_Rmplace =  $data_rmplace->NAME ;
                $Array_rmplace[$DataID_Rmplace]=$DataNAME_Rmplace; //การสร้าง Array แบบกำหนด  key value
            }
        }

        return $this->renderAjax('_Incident_Location', [ //สถานที่เกิดเหตุ
            'Array_rmplace' => $Array_rmplace,
            'Check_Status' =>$API_RMPLACEID,
            'value' => $DataID_Rmplace,
            'Length_V2' => Yii::$app->request->post('Length_V2')
        ]);
    }

    public function actionCheckrmplacestep2(){ //กดมาจาก Incident_Location = สถานที่เกิดเหตุ
        $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
        //=========================== สร้าง Array ข้อมูลหน่วยงานที่เกิดเหตุ ============================================
        $Array_rmlct = array();
        $API_riskreport_rmlct = $this->API_riskreport_rmlct("",$Access_Token['access_token']);

        if (isset($API_riskreport_rmlct)) {
            foreach ($API_riskreport_rmlct->json_data as $data_rmlct){
                $DataID_Rmlct =  $data_rmlct->RMLCT;
                $DataNAME_Rmlct =  $data_rmlct->NAME ;
                $Array_rmlct[$DataID_Rmlct]=$DataNAME_Rmlct; //การสร้าง Array แบบกำหนด  key value
            }
        }

        return $this->renderAjax('_Incident_Agency', [ //หน่วยงานที่เกิดเหตุ
            'Array_rmlct' => $Array_rmlct,
            'Length_V2' => Yii::$app->request->post('Length_V2')
        ]);
    }

    public function actionSearchrmgroup(){ //Search
        $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
        $Title_Length = Yii::$app->request->post("Title_Length");
        $FontS_rm =  Yii::$app->request->post("FontS_rm");

        $API_select_Check1 = $this->API_select_rmgrp(Yii::$app->request->post("Data_Rmgroup"),"",$Access_Token['access_token']);
        //======== ตรวจสอบ Token หมดอายุหรือยัง $API_riskreport_admin->json_result ==============
        if( $API_select_Check1->json_result == true){
            if($API_select_Check1->json_data == []){
                $API_select_Check2 = $this->API_select_rmgrp("",Yii::$app->request->post("Data_Rmgroup"),$Access_Token['access_token']);
                if($API_select_Check2->json_data == []){
                    if(preg_match("/-/",Yii::$app->request->post("Data_Rmgroup")) ){
                        $Status_Floor = "3st_Floor";
                        $Split_Text = explode("-", Yii::$app->request->post("Data_Rmgroup"));
                        //======================================= 3. API ประเภทความเสี่ยง RMGRP ============================================
                        $API_select_rmgrp = $this->API_select_rmgrp($Split_Text[0],$Split_Text[1],$Access_Token['access_token']);
                        //====================================== 4. API เรื่องความเสี่ยง RMTYPEGRP  ==========================================
                        $API_select_rmtypegrp = $this->API_select_rmtypegrp($Split_Text[0],$Split_Text[1],$Access_Token['access_token']);
                        //======================================= 5. API รายการความเสี่ย RMTYPE ============================================
                        $API_select_rmtype = $this->API_select_rmtype($Split_Text[0],$Split_Text[1],$Access_Token['access_token']);
                    }else{
                        $Status_Floor = "1st_Floor";
                        Yii::$app->session->setFlash('danger', 'ไม่พบข้อมูลที่ค้นหา');
                        //======================================= 3. API ประเภทความเสี่ยง RMGRP ============================================
                        $API_select_rmgrp = $this->API_select_rmgrp("",Yii::$app->request->post("Data_Rmgroup"),$Access_Token['access_token']);
                        //====================================== 4. API เรื่องความเสี่ยง RMTYPEGRP  ==========================================
                        $API_select_rmtypegrp = $this->API_select_rmtypegrp("",Yii::$app->request->post("Data_Rmgroup"),$Access_Token['access_token']);
                        //======================================= 5. API รายการความเสี่ย RMTYPE ============================================
                        $API_select_rmtype = $this->API_select_rmtype("",Yii::$app->request->post("Data_Rmgroup"),$Access_Token['access_token']);
                    }
                }else{
                    $Status_Floor = "3st_Floor";
                    //======================================= 3. API ประเภทความเสี่ยง RMGRP ============================================
                    $API_select_rmgrp = $this->API_select_rmgrp("",Yii::$app->request->post("Data_Rmgroup"),$Access_Token['access_token']);
                    //====================================== 4. API เรื่องความเสี่ยง RMTYPEGRP  ==========================================
                    $API_select_rmtypegrp = $this->API_select_rmtypegrp("",Yii::$app->request->post("Data_Rmgroup"),$Access_Token['access_token']);
                    //======================================= 5. API รายการความเสี่ย RMTYPE ============================================
                    $API_select_rmtype = $this->API_select_rmtype("",Yii::$app->request->post("Data_Rmgroup"),$Access_Token['access_token']);
                }
            }else{
                if(Yii::$app->request->post("Data_Rmgroup") == ""){
                    $Status_Floor = "1st_Floor";
                    //======================================= 3. API ประเภทความเสี่ยง RMGRP ============================================
                    $API_select_rmgrp = $this->API_select_rmgrp(Yii::$app->request->post("Data_Rmgroup"),"",$Access_Token['access_token']);
                    //====================================== 4. API เรื่องความเสี่ยง RMTYPEGRP  ==========================================
                    $API_select_rmtypegrp = $this->API_select_rmtypegrp(Yii::$app->request->post("Data_Rmgroup"),"",$Access_Token['access_token']);
                    //======================================= 5. API รายการความเสี่ย RMTYPE ============================================
                    $API_select_rmtype = $this->API_select_rmtype(Yii::$app->request->post("Data_Rmgroup"),"",$Access_Token['access_token']);
                }else{
                    $Status_Floor = "2st_Floor";
                    //======================================= 3. API ประเภทความเสี่ยง RMGRP ============================================
                    $API_select_rmgrp = $this->API_select_rmgrp(Yii::$app->request->post("Data_Rmgroup"),"",$Access_Token['access_token']);
                    //====================================== 4. API เรื่องความเสี่ยง RMTYPEGRP  ==========================================
                    $API_select_rmtypegrp = $this->API_select_rmtypegrp(Yii::$app->request->post("Data_Rmgroup"),"",$Access_Token['access_token']);
                    //======================================= 5. API รายการความเสี่ย RMTYPE ============================================
                    $API_select_rmtype = $this->API_select_rmtype(Yii::$app->request->post("Data_Rmgroup"),"",$Access_Token['access_token']);
                }
            }

            //==========================================  6. API Group ความเสี่ยง  ===============================================
            $API_select_rmgroup = $this->API_select_rmgroup("",$Access_Token['access_token']);
        }else{
            Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
            return $this->redirect(['login/login_his']);
        }

        return $this->renderAjax('_Incident_Rmgroup', [
            'API_select_rmgrp' => $API_select_rmgrp,
            'API_select_rmtypegrp' => $API_select_rmtypegrp,
            'API_select_rmtype' => $API_select_rmtype,
            'API_select_rmgroup' => $API_select_rmgroup,
            'Title_Length' => $Title_Length,
            'FontS_rm' => $FontS_rm,
            'Group_Check'=> $Status_Floor,
        ]);
    }

    public function actionSearcrmleveldtl()//Search ระดับความรุนแรง
    {
        $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
        $FontS_rm = Yii::$app->request->post("FontS_rm");
        //=========================================== 9. API ระดับความรุนแรง  ================================================
        $API_select_rmleveldtl = $this->API_select_rmleveldtl(Yii::$app->request->post("Data_RMLEVELDTL"),$Access_Token['access_token']);
        $RMLEVELDTL = $API_select_rmleveldtl->json_data[0]->RMLEVELDTL ;
        return $this->renderAjax('_Incident_Rmleveldtl', [
            'API_select_rmleveldtl' => $API_select_rmleveldtl,
            'FontS_rm' => $FontS_rm,
            'RMLEVELDTL' => $RMLEVELDTL,
        ]);
    }


    //  ********************************************************************************* API *************************************************************************************************

    public function API_riskreport_rminformtype($INFORMTYPE_ID,$Token){
        $curl = curl_init();
        $INFORMTYPEDATA = 'INFORMTYPE_ID='.$INFORMTYPE_ID;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/riskreport_rminformtype',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $INFORMTYPEDATA,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_riskreport_admin($ADMIN_ID,$Token){
        $curl = curl_init();
        $ADMINToken = 'ADMIN_ID='.$ADMIN_ID;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/riskreport_admin',
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

    public function API_riskreport_rmlct($RMLCT_ID,$Token){ //หน่วยงานที่เกิดเหตุ
        $curl = curl_init();
        $RMLCTDATA = 'RMLCT_ID='.$RMLCT_ID;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/riskreport_rmlct',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $RMLCTDATA,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_check_rmlct($RMPLACE_ID,$Token){ //check หน่วยงานที่เกิดเหตุ
        $curl = curl_init();
        $RMPLACEDATA = 'RMPLACE_ID='.$RMPLACE_ID;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/check_rmlct',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $RMPLACEDATA,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_riskreport_rmplace($RMPLACE_ID,$Token){  //สถานที่ที่เกิดเหตุ
        $curl = curl_init();
        $RMPLACEDATA = 'RMPLACE_ID='.$RMPLACE_ID;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/riskreport_rmplace',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $RMPLACEDATA,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_select_rmgrp($SEARCH_NTG,$SEARCH_NT,$Token){ //ประเภทความเสี่ยง RMGRP
        $curl = curl_init();
        $SEARCHDATA = 'SEARCH_NTG='.$SEARCH_NTG.'&SEARCH_NT='.$SEARCH_NT;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/riskreport_rmgrp',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>  $SEARCHDATA,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
    public function API_select_rmtypegrp($SEARCH_NTG,$SEARCH_NT,$Token){ //เรื่องความเสี่ยง
        $curl = curl_init();
        $SEARCHDATA = 'SEARCH_NTG='.$SEARCH_NTG.'&SEARCH_NT='.$SEARCH_NT;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/riskreport_rmtypegrp',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>  $SEARCHDATA,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
    public function API_select_rmtype($SEARCH_NTG,$SEARCH_NT,$Token){ //รายการความเสี่ยง
        $curl = curl_init();
        $SEARCHDATA = 'SEARCH_NTG='.$SEARCH_NTG.'&SEARCH_NT='.$SEARCH_NT;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/riskreport_rmtype',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>  $SEARCHDATA,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_select_rmgroup($RMTYPE_ID,$Token){ //รายการความเสี่ยง
        $curl = curl_init();
        $RMTYPEID = 'RMTYPE_ID='.$RMTYPE_ID;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/riskreport_rmgroup',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>  $RMTYPEID,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_select_rmleveldtl($RMLEVELDTL_ID,$Token){ //รายการความเสี่ยง
        $curl = curl_init();
        $RMLEVELDTLID = 'RMLEVELDTL_ID='.$RMLEVELDTL_ID;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/riskreport_rmleveldtl',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>  $RMLEVELDTLID,
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