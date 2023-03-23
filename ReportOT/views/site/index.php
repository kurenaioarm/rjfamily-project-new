<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php $form = ActiveForm::begin(); ?>
    <div class="text-center bg-transparent">
        <table>
            <div  id="replace_target" >
                <ul class="list-group list-group-flush">
                    </br>  </br>  </br>
                    <li class="list-group-item"><b>วันที่ :&nbsp;&nbsp;
                            <?php
                            $date1 = date("Y-m-d");
                            $SDateThai = Yii::$app->helper->dateThaiFull($date1);
                            $datecutS = explode( " ",$SDateThai);
                            echo  $datecutS[1];
                            ?>

                            <?php
                            $date1 = date("Y-m-d");
                            $SDateThai = Yii::$app->helper->dateThaiFull($date1);
                            $datecutS = explode( " ",$SDateThai);
                            echo  $datecutS[3];
                            ?>
                        </b>
                    </li>

                    <li class="list-group-item">
                        <b style="color: red">กรุณา Download ไฟล์ <u>Excel_Record OT UPDATE</u> เก็บไว้ที่ Folder > OT ALL</b>
                    </li>
                    <li class="list-group-item">
                        <button type="button" class="btn btn-outline-dark" onclick="location.href='https://rjfamily.rajavithi.go.th/ReportOT/images/OT ALL V10.rar'">Download Folder OT ALL</button>
                        <?= Html::submitButton('Download Excel Record OT UPDATE', ['class' => 'btn btn-outline-dark ', 'name' => 'Check-button','value'=>1]) ?>
                    </li>
                </ul>
            </div>
            <tbody>
                <tr style="border: 2px solid #343a40; background: -webkit-linear-gradient(45deg, #343a40,#000000); font-size:15px">
                    <th style="color:white" width="30 px">รหัส</th>
                    <th style="color:white" width="200 px">ชื่อ-นามสกุล</th>
                    <th style="color:white" width="30 px">สถานะ</th>
                    <th style="color:white" width="30 px">D1</th>
                    <th style="color:white" width="30 px">D2</th>
                    <th style="color:white" width="30 px">D3</th>
                    <th style="color:white" width="30 px">D4</th>
                    <th style="color:white" width="30 px">D5</th>
                    <th style="color:white" width="30 px">D6</th>
                    <th style="color:white" width="30 px">D7</th>
                    <th style="color:white" width="30 px">D8</th>
                    <th style="color:white" width="30 px">D9</th>
                    <th style="color:white" width="30 px">D10</th>
                    <th style="color:white" width="30 px">D11</th>
                    <th style="color:white" width="30 px">D12</th>
                    <th style="color:white" width="30 px">D13</th>
                    <th style="color:white" width="30 px">D14</th>
                    <th style="color:white" width="30 px">D15</th>
                    <th style="color:white" width="30 px">D16</th>
                    <th style="color:white" width="30 px">D17</th>
                    <th style="color:white" width="30 px">D18</th>
                    <th style="color:white" width="30 px">D19</th>
                    <th style="color:white" width="30 px">D20</th>
                    <th style="color:white" width="30 px">D21</th>
                    <th style="color:white" width="30 px">D22</th>
                    <th style="color:white" width="30 px">D23</th>
                    <th style="color:white" width="30 px">D24</th>
                    <th style="color:white" width="30 px">D25</th>
                    <th style="color:white" width="30 px">D26</th>
                    <th style="color:white" width="30 px">D27</th>
                    <th style="color:white" width="30 px">D28</th>
                    <th style="color:white" width="30 px">D29</th>
                    <th style="color:white" width="30 px">D30</th>
                    <th style="color:white" width="30 px">D31</th>
                </tr><br>

                <?php

                if (isset($sql_model)){
                foreach ($sql_model as $data){ //วน tr
                ?>
                <tr onMouseover="this.style.backgroundColor='#343434';  this.style.color = 'white'; " onMouseout="this.style.backgroundColor='';  this.style.color = '';">
                    <td style="font-size:14px"><?php echo $data->id;?> </td>
                    <td style="font-size:14px"><?php echo $data->name;?> </td>
                    <?php if( $data->status == "0"){ ?>
                        <td style="font-size:14px; border-left: 2px solid #000000; border-right: 2px solid #000000; color:black; background: #dc8213;"><b>ดำเนินการ</b></td>
                    <?php }else if($data->status == "1"){ ?>
                        <td style="font-size:14px; border-left: 2px solid #000000; border-right: 2px solid #000000; color:black; background: #16dcb8;"><b>เสร็จสิ้น</b></td>
                    <?php }else{ ?>
                        <td style="font-size:14px; border-left: 2px solid #000000; border-right: 2px solid #000000; color:black; background: #f3969a;"><b>ไม่ทำ</b></td>
                    <?php } ?>
                    <td style="font-size:5px"><?php echo $data->d1;?> </td>
                    <td style="font-size:5px"><?php echo $data->d2;?> </td>
                    <td style="font-size:5px"><?php echo $data->d3;?> </td>
                    <td style="font-size:5px"><?php echo $data->d4;?> </td>
                    <td style="font-size:5px"><?php echo $data->d5;?> </td>
                    <td style="font-size:5px"><?php echo $data->d6;?> </td>
                    <td style="font-size:5px"><?php echo $data->d7;?> </td>
                    <td style="font-size:5px"><?php echo $data->d8;?> </td>
                    <td style="font-size:5px"><?php echo $data->d9;?> </td>
                    <td style="font-size:5px"><?php echo $data->d10;?> </td>
                    <td style="font-size:5px"><?php echo $data->d11;?> </td>
                    <td style="font-size:5px"><?php echo $data->d12;?> </td>
                    <td style="font-size:5px"><?php echo $data->d13;?> </td>
                    <td style="font-size:5px"><?php echo $data->d14;?> </td>
                    <td style="font-size:5px"><?php echo $data->d15;?> </td>
                    <td style="font-size:5px"><?php echo $data->d16;?> </td>
                    <td style="font-size:5px"><?php echo $data->d17;?> </td>
                    <td style="font-size:5px"><?php echo $data->d18;?> </td>
                    <td style="font-size:5px"><?php echo $data->d19;?> </td>
                    <td style="font-size:5px"><?php echo $data->d20;?> </td>
                    <td style="font-size:5px"><?php echo $data->d21;?> </td>
                    <td style="font-size:5px"><?php echo $data->d22;?> </td>
                    <td style="font-size:5px"><?php echo $data->d23;?> </td>
                    <td style="font-size:5px"><?php echo $data->d24;?> </td>
                    <td style="font-size:5px"><?php echo $data->d25;?> </td>
                    <td style="font-size:5px"><?php echo $data->d26;?> </td>
                    <td style="font-size:5px"><?php echo $data->d27;?> </td>
                    <td style="font-size:5px"><?php echo $data->d28;?> </td>
                    <td style="font-size:5px"><?php echo $data->d29;?> </td>
                    <td style="font-size:5px"><?php echo $data->d30;?> </td>
                    <td style="font-size:5px"><?php echo $data->d31;?> </td>
                    <?php } }?>
                </tr>
            </tbody>
        </table>
        <?php ActiveForm::end(); ?>
    </div>
</div>





<style>
    /* CSS Table */
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        border-radius: 25px;
        border: 2px solid #000000;
    }

    td, th {
        border: 1px solid #797070;
        text-align: center;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    * {box-sizing: border-box;}
    /* ------------------------------------------------------------ */
    /* CSS Search */
    .topnav {
        overflow: hidden;
        background-color: #e9e9e9;
    }

    .topnav a {
        float: left;
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    .topnav a.active {
        background-color: #2196F3;
        color: white;
    }

    .topnav .search-container {
        float: right;
    }

    .topnav input[type=text] {
        padding: 6px;
        margin-top: 8px;
        font-size: 17px;
        border: none;
    }

    .topnav .search-container button {
        float: right;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background: #ddd;
        font-size: 17px;
        border: none;
        cursor: pointer;
    }

    .topnav .search-container button:hover {
        background: #ccc;
    }
    /* ------------------------------------------------------------ */
</style>