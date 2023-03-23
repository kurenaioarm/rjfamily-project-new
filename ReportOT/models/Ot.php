<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ot".
 *
 * @property int $id
 * @property string $name
 * @property string|null $d1
 * @property string|null $d2
 * @property string|null $d3
 * @property string|null $d4
 * @property string|null $d5
 * @property string|null $d6
 * @property string|null $d7
 * @property string|null $d8
 * @property string|null $d9
 * @property string|null $d10
 * @property string|null $d11
 * @property string|null $d12
 * @property string|null $d13
 * @property string|null $d14
 * @property string|null $d15
 * @property string|null $d16
 * @property string|null $d17
 * @property string|null $d18
 * @property string|null $d19
 * @property string|null $d20
 * @property string|null $d21
 * @property string|null $d22
 * @property string|null $d23
 * @property string|null $d24
 * @property string|null $d25
 * @property string|null $d26
 * @property string|null $d27
 * @property string|null $d28
 * @property string|null $d29
 * @property string|null $d30
 * @property string|null $d31
 * @property string|null $etc
 * @property string|null $add_timestamp
 * @property string|null $status
 */
class Ot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ot';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ot');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['add_timestamp'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['d1', 'd2', 'd3', 'd4', 'd5', 'd6', 'd7', 'd8', 'd9', 'd10', 'd11', 'd12', 'd13', 'd14', 'd15', 'd16', 'd17', 'd18', 'd19', 'd20', 'd21', 'd22', 'd23', 'd24', 'd25', 'd26', 'd27', 'd28', 'd29', 'd30', 'd31'], 'string', 'max' => 6],
            [['etc'], 'string', 'max' => 250],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'd1' => 'D 1',
            'd2' => 'D 2',
            'd3' => 'D 3',
            'd4' => 'D 4',
            'd5' => 'D 5',
            'd6' => 'D 6',
            'd7' => 'D 7',
            'd8' => 'D 8',
            'd9' => 'D 9',
            'd10' => 'D 10',
            'd11' => 'D 11',
            'd12' => 'D 12',
            'd13' => 'D 13',
            'd14' => 'D 14',
            'd15' => 'D 15',
            'd16' => 'D 16',
            'd17' => 'D 17',
            'd18' => 'D 18',
            'd19' => 'D 19',
            'd20' => 'D 20',
            'd21' => 'D 21',
            'd22' => 'D 22',
            'd23' => 'D 23',
            'd24' => 'D 24',
            'd25' => 'D 25',
            'd26' => 'D 26',
            'd27' => 'D 27',
            'd28' => 'D 28',
            'd29' => 'D 29',
            'd30' => 'D 30',
            'd31' => 'D 31',
            'etc' => 'Etc',
            'add_timestamp' => 'Add Timestamp',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OtQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OtQuery(get_called_class());
    }
}
