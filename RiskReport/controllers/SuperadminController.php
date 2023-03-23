<?php
namespace RiskReport\controllers;

use RiskReport\models\RiskReportForm;
use \yii\web\Controller;
use Yii;

class SuperadminController extends Controller
{
    public function actionIndex()
    {
        if(Yii::$app->session->get('arrayAccess_Token') === NULL){
            Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
            return $this->redirect(['login/login_his']);
        }else{
            //===================== เรียกใช้ session arrayAccess_Token  ========================
            $Access_Token =  Yii::$app->session->get('arrayAccess_Token');

            //======================================= 3. API ประเภทความเสี่ยง RMGRP ============================================
            $API_select_rmgrp = $this->API_select_rmgrp("","",$Access_Token['access_token']);
            //====================================== 4. API เรื่องความเสี่ยง RMTYPEGRP  ==========================================
            $API_select_rmtypegrp = $this->API_select_rmtypegrp("","",$Access_Token['access_token']);
            //======================================= 5. API รายการความเสี่ย RMTYPE ============================================
            $API_select_rmtype = $this->API_select_rmtype("","",$Access_Token['access_token']);
            //==========================================  6. API Group ความเสี่ยง  ===============================================
            $API_select_rmgroup = $this->API_select_rmgroup("",$Access_Token['access_token']);


            //======== ตรวจสอบ Token หมดอายุหรือยัง $API_riskreport_admin->json_result ==============
            if( $API_select_rmgrp->json_result == true  && $API_select_rmtypegrp->json_result == true && $API_select_rmtype->json_result == true && $API_select_rmgroup->json_result == true ){

            }else{
                Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
                return $this->redirect(['login/login_his']);
            }
        }

        return $this->render('index',[
            'API_select_rmgrp' => $API_select_rmgrp,
            'API_select_rmtypegrp' => $API_select_rmtypegrp,
            'API_select_rmtype' => $API_select_rmtype,
            'API_select_rmgroup' => $API_select_rmgroup,
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


    public function API_select_rmgrp($SEARCH_NTG,$SEARCH_NT,$Token){ //ประเภทความเสี่ยง RMGRP
        $curl = curl_init();
        $SEARCHDATA = 'SEARCH_NTG='.$SEARCH_NTG.'&SEARCH_NT='.$SEARCH_NT;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/switch_rmgrp',
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
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/switch_rmtypegrp',
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
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/riskreport_api/switch_rmtype',
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
}