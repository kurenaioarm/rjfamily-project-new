<?php
namespace RJMedicalRecord\models;

use Yii;
use yii\base\Model;

class DatachildForm extends Model
{
    public $Radio_MARITAL;
    public $RESIDENCE;
    public $TWIN;
    public $Bleeding;
    public $BBA;
    public $Membrane;
    public $Haemorrhage;
    public $Hysterectomy;
    public $Blood_tr;
    //    -----------------------
    public $HN_RJ;
    public $AN_RJ;
    public $HN_QSNICH;
    public $AN_QSNICH;
    //--------------------------
    public $OB_G;
    public $OB_P;
    public $OB_A;
    public $OB_L;
    public $EDC;
    public $Mother_BG;
    public $Rh ;
    public $ANC;
    public $Mother_da;
    public $Attendance;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[

            ], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'Radio_MARITAL' => 'MARITAL STATUS',
            'RESIDENCE'  => 'RESIDENCE',
            'TWIN' => 'TWIN',
            'Bleeding' => 'Bleeding',
            'BBA' => 'BBA',
            'Membrane' => 'Membrane',
            'Haemorrhage' => 'Haemorrhage',
            'Hysterectomy' => 'Hysterectomy',
            'Blood_tr' => 'Blood_tr',
            //    -----------------------
            'HN_RJ' => 'HN จากโรงพยาบาลราชวิถี',
            'AN_RJ' => 'AN จากโรงพยาบาลราชวิถี',
            'HN_QSNICH' => 'HN จากโรงพยาบาลเด็ก',
            'AN_QSNICH' => 'AN จากโรงพยาบาลเด็ก',
            //    -----------------------
            'OB_G' => 'OB_G',
            'OB_P' => 'OB_P',
            'OB_A' => 'OB_A',
            'OB_L' => 'OB_L',
            'EDC' => 'EDC',
            'Mother_BG' => 'Mother_BG',
            'Rh' => 'Rh',
            'ANC' => 'ANC',
            'Mother_da' => 'Mother_da',
            'Attendance' => 'Attendance',
        ];
    }
}