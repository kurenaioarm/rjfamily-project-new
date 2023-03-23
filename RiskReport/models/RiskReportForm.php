<?php
namespace RiskReport\models;

use Yii;
use yii\base\Model;

class RiskReportForm extends Model
{
    public $Statuser;
    public $SelectedDate;

    public $Report_Date;
    public $Report_Time;
    //----------------------- ข้อมูลส่วนตัว ------------------------------
    public $Reporter_Name;
    public $Reporter_agency;
    public $Phone_Number;
    public $E_Mail;
    //----------------------------------------------------------------
    public $Type_Reported;
    public $Date_Incident;
    public $Time_Incident;
    public $Mis_Drug;
    public $Correct_Drug;
    public $Quick_Details;
    public $Preliminary_Edit;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'Type_Reported',
                'Quick_Details',
                'Preliminary_Edit',
                'Phone_Number',
            ], 'required'],
            [['Reporter_Name','SelectedDate'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Statuser' => 'สถานะ',
            'SelectedDate' => 'วันที่',

            'Report_Date' => 'วันที่รายงาน',
            'Report_Time' => 'เวลาที่รายงาน',
            //------------- ข้อมูลส่วนตัว -----------------
            'Reporter_Name' => 'ชื่อผู้รายงาน',
            'Reporter_agency' => 'หน่วยงานที่รายงาน',
            'Phone_Number' => 'เบอร์โทรศัพท์',
            'E_Mail' => 'E-Mail',
            //------------------------------------------
            'Type_Reported' => 'ประเภทเรื่องที่แจ้ง',
            'Date_Incident' => 'วันที่เกิดเหตุ',
            'Time_Incident' => 'เวลาที่เกิดเหตุ',
            'Mis_Drug' => 'ข้อมูลที่ผิด (ชื่อยา)',
            'Correct_Drug' => 'ข้อมูลที่ถูก (ชื่อยา)',
            'Quick_Details' => 'รายละเอียด/เหตุการณ์โดยย่อ',
            'Preliminary_Edit' => 'การดำเนินแก้ไขเบื้องต้น',
        ];
    }
}