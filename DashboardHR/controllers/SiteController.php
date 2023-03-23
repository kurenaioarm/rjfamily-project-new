<?php

namespace DashboardHR\controllers;

use DashboardHR\models\ResendVerificationEmailForm;
use DashboardHR\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use DashboardHR\models\PasswordResetRequestForm;
use DashboardHR\models\ResetPasswordForm;
use DashboardHR\models\SignupForm;
use DashboardHR\models\ContactForm;
use DashboardHR\models\DatepickerForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $DatepickerModel = new DatepickerForm();
        $API_HR_DISTINCT = null;
        $API_HR_SUM = null;
        $API_HR_Beginning  = null;

        //============== API ESI Check Token==============

        $All_Day_DISTINCT=array();
        for ($x = 0; $x < 12; $x++) {
            $Last_Month_DISTINCT = $this->get_lastmonth_DISTINCT($x);
            if($Last_Month_DISTINCT->json_total != "0"){
                array_push($All_Day_DISTINCT,$Last_Month_DISTINCT->json_data);
            }
        }

        $All_Day_SUM=array();
        for ($x = 0; $x < 12; $x++) {
            $Last_Month_SUM = $this->get_lastmonth_SUM($x);
            if($Last_Month_SUM->json_total != "0"){
                array_push($All_Day_SUM,$Last_Month_SUM->json_data);
            }
        }

        $API_HR_DISTINCT = $this->API_DashboardHR_DISTINCT("", "");
        $API_HR_SUM = $this->API_DashboardHR_SUM("", "");
        $API_HR_Beginning = $this->API_DashboardHR_From_The_Beginning();
//        var_dump($API_HR_Beginning->json_data[0]->STATUS);die();
        if($API_HR_Beginning->json_data[0]->STATUS == "DISTINCT"){
            $DISTINCT_HR_Beginning = $API_HR_Beginning->json_data[0]->CNT_HOME1;
            $SUM_HR_Beginning = $API_HR_Beginning->json_data[1]->CNT_HOME1;
        }else{
            $DISTINCT_HR_Beginning = $API_HR_Beginning->json_data[1]->CNT_HOME1;
            $SUM_HR_Beginning = $API_HR_Beginning->json_data[0]->CNT_HOME1;
        }

        //==============================================

        return $this->render('index',[
            'model' => $DatepickerModel,
            'All_Day_DISTINCT' => $All_Day_DISTINCT,
            'All_Day_SUM' => $All_Day_SUM,
            'API_HR_DISTINCT' => $API_HR_DISTINCT,
            'API_HR_SUM' => $API_HR_SUM,
            'DISTINCT_HR_Beginning' => $DISTINCT_HR_Beginning,
            'SUM_HR_Beginning' => $SUM_HR_Beginning,
        ]);
    }

    public function API_DashboardHR_From_The_Beginning(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/stack_hr/from_the_beginning',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_DashboardHR_DISTINCT($SDATE,$EDATE){
        $curl = curl_init();
        $DataToken = 'SDATE='.$SDATE.'&EDATE='.$EDATE;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/stack_hr/stack_hr_distinct',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $DataToken,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function API_DashboardHR_SUM($SDATE,$EDATE){
        $curl = curl_init();
        $DataToken = 'SDATE='.$SDATE.'&EDATE='.$EDATE;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/stack_hr/stack_hr_sum',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $DataToken,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }


    public function get_lastmonth_DISTINCT($Last_Month) {

        $lastmonth =date('Y-m-d', strtotime("-$Last_Month month")); //- เดือนที่แล้ว
        $lastmonthCUT = explode( '-', $lastmonth );
        $lastday = date("t",strtotime("$lastmonth"));

        $SDATE = "01".$lastmonthCUT[1].$lastmonthCUT[0];
        $EDATE = $lastday.$lastmonthCUT[1].$lastmonthCUT[0] ;
        $API_HR_DISTINCT = $this->API_Day_DISTINCT($SDATE,$EDATE);

        return $API_HR_DISTINCT;
    }


    public function API_Day_DISTINCT($SDATE,$EDATE){
        $curl = curl_init();
        $DataToken = 'SDATE='.$SDATE.'&EDATE='.$EDATE;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/stack_hr/stack_hr_day_distinct',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $DataToken,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function get_lastmonth_SUM($Last_Month) {

        $lastmonth =date('Y-m-d', strtotime("-$Last_Month month")); //- เดือนที่แล้ว
        $lastmonthCUT = explode( '-', $lastmonth );
        $lastday = date("t",strtotime("$lastmonth"));

        $SDATE = "01".$lastmonthCUT[1].$lastmonthCUT[0];
        $EDATE = $lastday.$lastmonthCUT[1].$lastmonthCUT[0] ;
        $API_HR_DISTINCT = $this->API_Day_SUM($SDATE,$EDATE);

        return $API_HR_DISTINCT;
    }

    public function API_Day_SUM($SDATE,$EDATE){
        $curl = curl_init();
        $DataToken = 'SDATE='.$SDATE.'&EDATE='.$EDATE;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/stack_hr/stack_hr_day_sum',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $DataToken,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
