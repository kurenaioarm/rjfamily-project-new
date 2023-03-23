<?php

namespace ReportOT\controllers;

use app\models\Ot;
use ReportOT\models\ResendVerificationEmailForm;
use ReportOT\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use ReportOT\models\PasswordResetRequestForm;
use ReportOT\models\ResetPasswordForm;
use ReportOT\models\SignupForm;
use ReportOT\models\ContactForm;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use yii\db\Query;


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
//        Yii::$app->db_ot->open();// ทดสอบการเชื่อมต่อ
        $sql = 'select id , name , status ,
                    case when d1 = "4" then "16.00 - 20.00 จ-ศ"
                        when d1 = "5" then "16.00 - 21.00 จ-ศ"
                        when d1 = "8" then "08.00 - 16.00 ส-อา"
                        when d1 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d1 = "12" then "08.00 - 20.00 ส-อา"
                        when d1 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d1 = "13" then "08.00 - 21.00 ส-อา"
                        when d1 = "9" then "12.00 - 21.00 ส-อา"  end d1 ,
                    case when d2 = "4" then "16.00 - 20.00 จ-ศ"
                        when d2 = "5" then "16.00 - 21.00 จ-ศ"
                        when d2 = "8" then "08.00 - 16.00 ส-อา"
                        when d2 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d2 = "12" then "08.00 - 20.00 ส-อา"
                        when d2 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d2 = "13" then "08.00 - 21.00 ส-อา"
                        when d2 = "9" then "12.00 - 21.00 ส-อา"  end d2 ,
                    case when d3 = "4" then "16.00 - 20.00 จ-ศ"
                        when d3 = "5" then "16.00 - 21.00 จ-ศ"
                        when d3 = "8" then "08.00 - 16.00 ส-อา"
                        when d3 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d3 = "12" then "08.00 - 20.00 ส-อา"
                        when d3 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d3 = "13" then "08.00 - 21.00 ส-อา"
                        when d3 = "9" then "12.00 - 21.00 ส-อา"  end d3 ,
                    case when d4 = "4" then "16.00 - 20.00 จ-ศ"
                        when d4 = "5" then "16.00 - 21.00 จ-ศ"
                        when d4 = "8" then "08.00 - 16.00 ส-อา"
                        when d4 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d4 = "12" then "08.00 - 20.00 ส-อา"
                        when d4 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d4 = "13" then "08.00 - 21.00 ส-อา"
                        when d4 = "9" then "12.00 - 21.00 ส-อา"  end d4 ,
                    case when d5 = "4" then "16.00 - 20.00 จ-ศ"
                        when d5 = "5" then "16.00 - 21.00 จ-ศ"
                        when d5 = "8" then "08.00 - 16.00 ส-อา"
                        when d5 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d5 = "12" then "08.00 - 20.00 ส-อา"
                        when d5 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d5 = "13" then "08.00 - 21.00 ส-อา"
                        when d5 = "9" then "12.00 - 21.00 ส-อา"  end d5 ,
                    case when d6 = "4" then "16.00 - 20.00 จ-ศ"
                        when d6 = "5" then "16.00 - 21.00 จ-ศ"
                        when d6 = "8" then "08.00 - 16.00 ส-อา"
                        when d6 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d6 = "12" then "08.00 - 20.00 ส-อา"
                        when d6 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d6 = "13" then "08.00 - 21.00 ส-อา"
                        when d6 = "9" then "12.00 - 21.00 ส-อา"  end d6 ,
                    case when d7 = "4" then "16.00 - 20.00 จ-ศ"
                        when d7 = "5" then "16.00 - 21.00 จ-ศ"
                        when d7 = "8" then "08.00 - 16.00 ส-อา"
                        when d7 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d7 = "12" then "08.00 - 20.00 ส-อา"
                        when d7 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d7 = "13" then "08.00 - 21.00 ส-อา"
                        when d7 = "9" then "12.00 - 21.00 ส-อา"  end d7 ,
                    case when d8 = "4" then "16.00 - 20.00 จ-ศ"
                        when d8 = "5" then "16.00 - 21.00 จ-ศ"
                        when d8 = "8" then "08.00 - 16.00 ส-อา"
                        when d8 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d8 = "12" then "08.00 - 20.00 ส-อา"
                        when d8 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d8 = "13" then "08.00 - 21.00 ส-อา"
                        when d8 = "9" then "12.00 - 21.00 ส-อา"  end d8 ,
                    case when d9 = "4" then "16.00 - 20.00 จ-ศ"
                        when d9 = "5" then "16.00 - 21.00 จ-ศ"
                        when d9 = "8" then "08.00 - 16.00 ส-อา"
                        when d9 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d9 = "12" then "08.00 - 20.00 ส-อา"
                        when d9 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d9 = "13" then "08.00 - 21.00 ส-อา"
                        when d9 = "9" then "12.00 - 21.00 ส-อา"  end d9 ,
                    case when d10 = "4" then "16.00 - 20.00 จ-ศ"
                        when d10 = "5" then "16.00 - 21.00 จ-ศ"
                        when d10 = "8" then "08.00 - 16.00 ส-อา"
                        when d10 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d10 = "12" then "08.00 - 20.00 ส-อา"
                        when d10 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d10 = "13" then "08.00 - 21.00 ส-อา"
                        when d10 = "9" then "12.00 - 21.00 ส-อา"  end d10 ,
                    case when d11 = "4" then "16.00 - 20.00 จ-ศ"
                        when d11 = "5" then "16.00 - 21.00 จ-ศ"
                        when d11 = "8" then "08.00 - 16.00 ส-อา"
                        when d11 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d11 = "12" then "08.00 - 20.00 ส-อา"
                        when d11 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d11 = "13" then "08.00 - 21.00 ส-อา"
                        when d11 = "9" then "12.00 - 21.00 ส-อา"  end d11 ,
                    case when d12 = "4" then "16.00 - 20.00 จ-ศ"
                        when d12 = "5" then "16.00 - 21.00 จ-ศ"
                        when d12 = "8" then "08.00 - 16.00 ส-อา"
                        when d12 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d12 = "12" then "08.00 - 20.00 ส-อา"
                        when d12 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d12 = "13" then "08.00 - 21.00 ส-อา"
                        when d12 = "9" then "12.00 - 21.00 ส-อา"  end d12 ,
                    case when d13 = "4" then "16.00 - 20.00 จ-ศ"
                        when d13 = "5" then "16.00 - 21.00 จ-ศ"
                        when d13 = "8" then "08.00 - 16.00 ส-อา"
                        when d13 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d13 = "12" then "08.00 - 20.00 ส-อา"
                        when d13 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d13 = "13" then "08.00 - 21.00 ส-อา"
                        when d13 = "9" then "12.00 - 21.00 ส-อา"  end d13 ,
                    case when d14 = "4" then "16.00 - 20.00 จ-ศ"
                        when d14 = "5" then "16.00 - 21.00 จ-ศ"
                        when d14 = "8" then "08.00 - 16.00 ส-อา"
                        when d14 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d14 = "12" then "08.00 - 20.00 ส-อา"
                        when d14 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d14 = "13" then "08.00 - 21.00 ส-อา"
                        when d14 = "9" then "12.00 - 21.00 ส-อา"  end d14 ,
                    case when d15 = "4" then "16.00 - 20.00 จ-ศ"
                        when d15 = "5" then "16.00 - 21.00 จ-ศ"
                        when d15 = "8" then "08.00 - 16.00 ส-อา"
                        when d15 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d15 = "12" then "08.00 - 20.00 ส-อา"
                        when d15 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d15 = "13" then "08.00 - 21.00 ส-อา"
                        when d15 = "9" then "12.00 - 21.00 ส-อา"  end d15 ,
                    case when d16 = "4" then "16.00 - 20.00 จ-ศ"
                        when d16 = "5" then "16.00 - 21.00 จ-ศ"
                        when d16 = "8" then "08.00 - 16.00 ส-อา"
                        when d16 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d16 = "12" then "08.00 - 20.00 ส-อา"
                        when d16 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d16 = "13" then "08.00 - 21.00 ส-อา"
                        when d16 = "9" then "12.00 - 21.00 ส-อา"  end d16 ,
                    case when d17 = "4" then "16.00 - 20.00 จ-ศ"
                        when d17 = "5" then "16.00 - 21.00 จ-ศ"
                        when d17 = "8" then "08.00 - 16.00 ส-อา"
                        when d17 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d17 = "12" then "08.00 - 20.00 ส-อา"
                        when d17 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d17 = "13" then "08.00 - 21.00 ส-อา"
                        when d17 = "9" then "12.00 - 21.00 ส-อา"  end d17 ,
                    case when d18 = "4" then "16.00 - 20.00 จ-ศ"
                        when d18 = "5" then "16.00 - 21.00 จ-ศ"
                        when d18 = "8" then "08.00 - 16.00 ส-อา"
                        when d18 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d18 = "12" then "08.00 - 20.00 ส-อา"
                        when d18 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d18 = "13" then "08.00 - 21.00 ส-อา"
                        when d18 = "9" then "12.00 - 21.00 ส-อา"  end d18 ,
                    case when d19 = "4" then "16.00 - 20.00 จ-ศ"
                        when d19 = "5" then "16.00 - 21.00 จ-ศ"
                        when d19 = "8" then "08.00 - 16.00 ส-อา"
                        when d19 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d19 = "12" then "08.00 - 20.00 ส-อา"
                        when d19 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d19 = "13" then "08.00 - 21.00 ส-อา"
                        when d19 = "9" then "12.00 - 21.00 ส-อา"  end d19 ,
                    case when d20 = "4" then "16.00 - 20.00 จ-ศ"
                        when d20 = "5" then "16.00 - 21.00 จ-ศ"
                        when d20 = "8" then "08.00 - 16.00 ส-อา"
                        when d20 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d20 = "12" then "08.00 - 20.00 ส-อา"
                        when d20 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d20 = "13" then "08.00 - 21.00 ส-อา"
                        when d20 = "9" then "12.00 - 21.00 ส-อา"  end d20 ,
                     case when d21 = "4" then "16.00 - 20.00 จ-ศ"
                        when d21 = "5" then "16.00 - 21.00 จ-ศ"
                        when d21 = "8" then "08.00 - 16.00 ส-อา"
                        when d21 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d21 = "12" then "08.00 - 20.00 ส-อา"
                        when d21 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d21 = "13" then "08.00 - 21.00 ส-อา"
                        when d21 = "9" then "12.00 - 21.00 ส-อา"  end d21 ,
                    case when d22 = "4" then "16.00 - 20.00 จ-ศ"
                        when d22 = "5" then "16.00 - 21.00 จ-ศ"
                        when d22 = "8" then "08.00 - 16.00 ส-อา"
                        when d22 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d22 = "12" then "08.00 - 20.00 ส-อา"
                        when d22 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d22 = "13" then "08.00 - 21.00 ส-อา"
                        when d22 = "9" then "12.00 - 21.00 ส-อา"  end d22 ,
                    case when d23 = "4" then "16.00 - 20.00 จ-ศ"
                        when d23 = "5" then "16.00 - 21.00 จ-ศ"
                        when d23 = "8" then "08.00 - 16.00 ส-อา"
                        when d23 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d23 = "12" then "08.00 - 20.00 ส-อา"
                        when d23 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d23 = "13" then "08.00 - 21.00 ส-อา"
                        when d23 = "9" then "12.00 - 21.00 ส-อา"  end d23 ,
                    case when d24 = "4" then "16.00 - 20.00 จ-ศ"
                        when d24 = "5" then "16.00 - 21.00 จ-ศ"
                        when d24 = "8" then "08.00 - 16.00 ส-อา"
                        when d24 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d24 = "12" then "08.00 - 20.00 ส-อา"
                        when d24 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d24 = "13" then "08.00 - 21.00 ส-อา"
                        when d24 = "9" then "12.00 - 21.00 ส-อา"  end d24 ,
                    case when d25 = "4" then "16.00 - 20.00 จ-ศ"
                        when d25 = "5" then "16.00 - 21.00 จ-ศ"
                        when d25 = "8" then "08.00 - 16.00 ส-อา"
                        when d25 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d25 = "12" then "08.00 - 20.00 ส-อา"
                        when d25 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d25 = "13" then "08.00 - 21.00 ส-อา"
                        when d25 = "9" then "12.00 - 21.00 ส-อา"  end d25 ,
                    case when d26 = "4" then "16.00 - 20.00 จ-ศ"
                        when d26 = "5" then "16.00 - 21.00 จ-ศ"
                        when d26 = "8" then "08.00 - 16.00 ส-อา"
                        when d26 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d26 = "12" then "08.00 - 20.00 ส-อา"
                        when d26 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d26 = "13" then "08.00 - 21.00 ส-อา"
                        when d26 = "9" then "12.00 - 21.00 ส-อา"  end d26 ,
                    case when d27 = "4" then "16.00 - 20.00 จ-ศ"
                        when d27 = "5" then "16.00 - 21.00 จ-ศ"
                        when d27 = "8" then "08.00 - 16.00 ส-อา"
                        when d27 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d27 = "12" then "08.00 - 20.00 ส-อา"
                        when d27 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d27 = "13" then "08.00 - 21.00 ส-อา"
                        when d27 = "9" then "12.00 - 21.00 ส-อา"  end d27 ,
                    case when d28 = "4" then "16.00 - 20.00 จ-ศ"
                        when d28 = "5" then "16.00 - 21.00 จ-ศ"
                        when d28 = "8" then "08.00 - 16.00 ส-อา"
                        when d28 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d28 = "12" then "08.00 - 20.00 ส-อา"
                        when d28 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d28 = "13" then "08.00 - 21.00 ส-อา"
                        when d28 = "9" then "12.00 - 21.00 ส-อา"  end d28 ,
                    case when d29 = "4" then "16.00 - 20.00 จ-ศ"
                        when d29 = "5" then "16.00 - 21.00 จ-ศ"
                        when d29 = "8" then "08.00 - 16.00 ส-อา"
                        when d29 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d29 = "12" then "08.00 - 20.00 ส-อา"
                        when d29 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d29 = "13" then "08.00 - 21.00 ส-อา"
                        when d29 = "9" then "12.00 - 21.00 ส-อา"  end d29 ,
                    case when d30 = "4" then "16.00 - 20.00 จ-ศ"
                        when d30 = "5" then "16.00 - 21.00 จ-ศ"
                        when d30 = "8" then "08.00 - 16.00 ส-อา"
                        when d30 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d30 = "12" then "08.00 - 20.00 ส-อา"
                        when d30 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d30 = "13" then "08.00 - 21.00 ส-อา"
                        when d30 = "9" then "12.00 - 21.00 ส-อา"  end d30 ,
                    case when d31 = "4" then "16.00 - 20.00 จ-ศ"
                        when d31 = "5" then "16.00 - 21.00 จ-ศ"
                        when d31 = "8" then "08.00 - 16.00 ส-อา"
                        when d31 = "4.0001" then "12.00 - 16.00 ส-อา"
                        when d31 = "12" then "08.00 - 20.00 ส-อา"
                        when d31 = "8.0001" then "12.00 - 20.00 ส-อา"
                        when d31 = "13" then "08.00 - 21.00 ส-อา"
                        when d31 = "9" then "12.00 - 21.00 ส-อา"  end d31
                    from ot
                    ';
        $sql_model = ot::findBySql($sql)->all();
        $date1 = date("Y-m-d");
        $SDateThai = Yii::$app->helper->dateThaiFull($date1);
        $datecutS = explode( " ",$SDateThai);
//        var_dump($datecutS);die();
        if(Yii::$app->request->post('Check-button') == 1){
            $this->ExcelReport($sql_model);
        }
        return $this->render('index', [
            'sql_model' => $sql_model,
            'datecutS' => $datecutS,
        ]);
    }

    protected function newPHPexcel($property)
    {
        //คู่มือใช่งาน Spreadsheet แบบ PHP
        //https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/
        // https://www.htmlgoodies.com/beyond/exploring-phpspreadsheets-formatting-capabilities.html

        $objPHPExcel = new Spreadsheet();
        // Set properties
        $objPHPExcel->getProperties()
            ->setCreator($property['creator'])
            ->setLastModifiedBy($property['lastModifiedBy'])
            ->setTitle($property['title'])
            ->setSubject($property['subject'])
            ->setDescription($property['description'])
            ->setKeywords($property['keywords'])
            ->setCategory($property['category']);

        return $objPHPExcel;
    }

    public function ExcelReport($sql_model)
    {
        ini_set("memory_limit", "300M");
        /////////////////Excel Head///////////////////
        $objPHPExcel = $this->newPHPexcel([
            'creator' => 'Serazu',
            'lastModifiedBy' => 'Serazu',
            'title' => 'รายงานOT',
            'subject' => 'รายงานOT',
            'description' => 'รายงานOT',
            'keywords' => 'pdf php',
            'category' => 'Serazu Report',
        ]);
        $date1 = date("Y-m-d");
        $SDateThai = Yii::$app->helper->dateThaiFull($date1);
        $datecutS = explode( " ",$SDateThai);
        //header
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'เดือน')
            ->setCellValue('B1', $datecutS[1])
            ->setCellValue('C1', 'ปี')
            ->setCellValue('D1', $datecutS[3])
            ->setCellValue('A2', 'รหัส')
            ->setCellValue('B2', 'ชื่อ-นามสกุล')
            ->setCellValue('C2', 'สถานะ')
            ->setCellValue('D2', 'D1')
            ->setCellValue('E2', 'D2')
            ->setCellValue('F2', 'D3')
            ->setCellValue('G2', 'D4')
            ->setCellValue('H2', 'D5')
            ->setCellValue('I2', 'D6')
            ->setCellValue('J2', 'D7')
            ->setCellValue('K2', 'D8')
            ->setCellValue('L2', 'D9')
            ->setCellValue('M2', 'D10')
            ->setCellValue('N2', 'D11')
            ->setCellValue('O2', 'D12')
            ->setCellValue('P2', 'D13')
            ->setCellValue('Q2', 'D14')
            ->setCellValue('R2', 'D15')
            ->setCellValue('S2', 'D16')
            ->setCellValue('T2', 'D17')
            ->setCellValue('U2', 'D18')
            ->setCellValue('V2', 'D19')
            ->setCellValue('W2', 'D20')
            ->setCellValue('X2', 'D21')
            ->setCellValue('Y2', 'D22')
            ->setCellValue('Z2', 'D23')
            ->setCellValue('AA2', 'D24')
            ->setCellValue('AB2', 'D25')
            ->setCellValue('AC2', 'D26')
            ->setCellValue('AD2', 'D27')
            ->setCellValue('AE2', 'D28')
            ->setCellValue('AF2', 'D29')
            ->setCellValue('AG2', 'D30')
            ->setCellValue('AH2', 'D31');

        //============================ ใส่ Color ให้ตราง  ===============================
        $objPHPExcel->getActiveSheet()->getStyle('A2:AH2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('ff5bccc8');
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('ff5bccc8');

        /////////////////Excel Head///////////////////
        $count = 3;
        ///////Begin Data Loop///////////////////
        foreach ($sql_model as $data) {
            //========== ใส่ Color ให้ตราง  https://ankiewicz.com/color/picker/ff0000 =============
            if( $data->status == "0"){
                $StatusThai = "ดำเนินการ";
                $objPHPExcel->getActiveSheet()->getStyle('C' . $count)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('ffdcd488');
            }else if($data->status == "1"){
                $StatusThai = "เสร็จสิ้น";
                $objPHPExcel->getActiveSheet()->getStyle('C' . $count)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('ff80dcd9');
            }else {
                $StatusThai = "ไม่ทำ";
                $objPHPExcel->getActiveSheet()->getStyle('C' . $count)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('fff3969a');
            };
            //========== ใส่ Color ให้ตราง  https://ankiewicz.com/color/picker/ff0000 =============

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $count, $data->id)
                ->setCellValue('B' . $count,  $data->name)
                ->setCellValue('C' . $count, $StatusThai)
                ->setCellValue('D' . $count, $data->d1)
                ->setCellValue('E' . $count, $data->d2)
                ->setCellValue('F' . $count, $data->d3)
                ->setCellValue('G' . $count, $data->d4)
                ->setCellValue('H' . $count, $data->d5)
                ->setCellValue('I' . $count, $data->d6)
                ->setCellValue('J' . $count, $data->d7)
                ->setCellValue('K' . $count, $data->d8)
                ->setCellValue('L' . $count, $data->d9)
                ->setCellValue('M' . $count, $data->d10)
                ->setCellValue('N' . $count, $data->d11)
                ->setCellValue('O' . $count, $data->d12)
                ->setCellValue('P' . $count, $data->d13)
                ->setCellValue('Q' . $count, $data->d14)
                ->setCellValue('R' . $count, $data->d15)
                ->setCellValue('S' . $count, $data->d16)
                ->setCellValue('T' . $count, $data->d17)
                ->setCellValue('U' . $count, $data->d18)
                ->setCellValue('V' . $count, $data->d19)
                ->setCellValue('W' . $count, $data->d20)
                ->setCellValue('X' . $count, $data->d21)
                ->setCellValue('Y' . $count, $data->d22)
                ->setCellValue('Z' . $count, $data->d23)
                ->setCellValue('AA' . $count, $data->d24)
                ->setCellValue('AB' . $count, $data->d25)
                ->setCellValue('AC' . $count, $data->d26)
                ->setCellValue('AD' . $count, $data->d27)
                ->setCellValue('AE' . $count, $data->d28)
                ->setCellValue('AF' . $count, $data->d29)
                ->setCellValue('AG' . $count, $data->d30)
                ->setCellValue('AH' . $count, $data->d31);
            $count++;
        }
        //============================ ใส่ Border ให้ตราง   =================================
        $BorderCount = $count-1;
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle('A2:'.'A11')->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle('B2:'.'B11')->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle('C2:'.'C11')->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle('A2:'.'AH2')->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle('A2:'.'AH'. $BorderCount)->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
        //===========================================================================

        //============================ ปรับขนาด ให้ตราง   =================================
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30, 'pt');
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(150, 'pt');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(70, 'pt');
        //===========================================================================

        /////////////////Begin Data Loop///////////////////


        /////////////////Excel Foot///////////////////
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('OT ALL');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        self::setHttpHeaders('Record OT');
        //Xlsx
//        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xlsx');
//        $objWriter->setIncludeCharts(true);
//        $objWriter->save('php://output');
        //Xls
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xls');
        $objWriter->save('php://output');
        exit();
//        return 1;
//        /////////////////Excel Foot///////////////////
    }

    protected function setHttpHeaders($filename)
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
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
