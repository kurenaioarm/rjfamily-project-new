<?php
namespace ReportOT\controllers;

use ReportOT\models\LoginForm;
use Yii;

class LoginController extends \yii\web\Controller
{
    public function actionLogin_his()
    {
        $this->layout = '@app/../themes/login-template-1/views/layouts/login';
        $LoginModel = new LoginForm();

        $LoginModel->username = 'apiauthen';
        $LoginModel->password = '9ixLZfoBOxovZgk@91';

        Yii::$app->session->set('access_token',"");

        if(Yii::$app->request->post()){
            $LoginModel->load(Yii::$app->request->post());
            if($LoginModel->username == "" || $LoginModel->password == ""){
                $LoginModel->validate();
            }else{
//                echo '<pre>';
                $arr = array(
                    'user' => $LoginModel->username,
                    'pwd' => $LoginModel->password,
                );
                $jsonEncode = json_encode($arr);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/token/get_access_token',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_POSTFIELDS => $jsonEncode,

                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $obj_access_token = json_decode($response);
                curl_close($curl);

//                var_dump($obj_access_token->json_result);die();
                if($obj_access_token->json_result == true ){

                    //============Captcha=================
                    if (isset($_POST['g-recaptcha-response'])) {
                        $captcha = $_POST['g-recaptcha-response'];
                    } else {
                        $captcha = false;
                    }
                    if (!$captcha) {

                    } else {
                        $rescall = $this->Captcha_cal($captcha);
                    }
//                    ====================================
                    if (isset($rescall)) {
                        if ($rescall->success == true && $rescall->score >= 0.5){

                            Yii::$app->session->set('access_token',$obj_access_token->access_token);
                            return $this->redirect(['site/index']);

                        }else{
                            Yii::$app->session->setFlash('error',   'มีการเข้าใช้งานที่ผิดปกติจากเครือข่าย');
                        }
                    }
                }else{
                    Yii::$app->session->setFlash('error',   'Username/Password ไม่ถูกต้อง');
                }
            }
        }

        return $this->render('login_his', [
            'model' => $LoginModel,
            //ทำการ json_decode(...)ก่อน
        ]);
    }

    public function actionLogin_hr()
    {
        $this->layout = '@app/../themes/login-template-1/views/layouts/login';
        $LoginModel = new LoginForm();

        Yii::$app->session->set('access_token',"");

        if(Yii::$app->request->post()){
            $LoginModel->load(Yii::$app->request->post());
            if($LoginModel->username == "" || $LoginModel->password == ""){
                $LoginModel->validate();
            }else{
//                echo '<pre>';
                $Token_username = md5($LoginModel->username);
                $Token_password = md5($LoginModel->password);
                $Key = $LoginModel->username ;
                $KeyCut = substr($Key, 0,-9);
                $Today = date("Y/m/d");
                $TodayCut = explode( "/",$Today);
                $Day = $TodayCut[2];
                $Month = $TodayCut[1];
                $Year = $TodayCut[0];
                $Token = md5($KeyCut.$Year.$Month.$Day.'rjvt');
                $DataToken = "utoken=$Token_username&ptoken=$Token_password&tmptoken=$Token";

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://hrws.rajavithi.go.th/mvc/human/xhrGetDetailsx',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $DataToken,
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/x-www-form-urlencoded',
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $obj_access_token = json_decode($response);

                if($obj_access_token->json_result == true ){
                    Yii::$app->session->set('access_token',$obj_access_token);
                    return $this->redirect(['site/index']);
                }else{
                    Yii::$app->session->setFlash('error', 'Username หรือ Password <br> ไม่ถูกต้องกรุณาตรวจสอบ');
                }
            }
        }

        return $this->render('login_hr', [
            'model' => $LoginModel,
        ]);
    }

    public function actionLogin_ot()
    {
        $this->layout = '@app/../themes/login-template-1/views/layouts/login_ot';
        $LoginModel = new LoginForm();

        if(Yii::$app->request->post()){
            $LoginModel->load(Yii::$app->request->post());
            if($LoginModel->idcard == "" ){
                Yii::$app->session->setFlash('error', ' ID CARD <br> ไม่ถูกต้องกรุณาตรวจสอบ');
            }else{
                if($LoginModel->idcard == "1103700041583" || $LoginModel->idcard == "1339900062308" || $LoginModel->idcard == "1869900308698" || $LoginModel->idcard == "1100400874234"
                    || $LoginModel->idcard == "1103701083271" || $LoginModel->idcard == "1159900207111" || $LoginModel->idcard == "1102000065837" || $LoginModel->idcard == "1103701837225"
                    || $LoginModel->idcard == "1179900294553" ){
                    return $this->redirect(['site/index']);
                }else{
                    Yii::$app->session->setFlash('error', ' ID CARD <br> ไม่ถูกต้องกรุณาตรวจสอบ');
                }
            }
        }

        return $this->render('login_ot', [
            'model' => $LoginModel,
        ]);
    }
}