<?php
namespace RJMedicalRecord\models;

use Yii;
use yii\base\Model;

class MedicalRecordForm extends Model
{
    public $HN;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'HN',
            ], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [

            'HN' => 'รหัสผู้ป่วย',
        ];
    }
}