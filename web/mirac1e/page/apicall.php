<?php
include("../sqlcom/FunctionWebservice.php");

 $fam = new Webservice43();

$action = $_POST['action'];

if($action == 'drug'){
$run=0;
$drug = $fam->Drugallergy($_POST['hn'],$_POST['token']);
if($drug->json_total>0){
foreach ($drug->json_data as $value) { ?>

          <div class="col-md-6">
            <div class="warning">
                <div class="row" >

                  <div class="col-md-12 col-sm-12" >
                  <fieldset>
                      <h3> รายการที่ <?php $run+=1;echo $run;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>รหัสยาที่มีประวัติการแพ้ : </b> <?php echo $value->DRUGALLERGY;?>
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>ระดับความรุนแรงของการแพ้ยา : </b> <?php echo $value->ALEVEL;?>
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>ลักษณะอาการของการแพ้ยาที่พบ : </b> <?php echo $value->ALGYSIGN2;?>
                    </fieldset>
                </div>

                  </div>
                 </div>
                </div>
<?php }//foreach
		 }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติการแพ้ยา </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if drug

if($action == 'ncd'){
$run=0;
	$ncd = $fam->NCDscreen($_POST['hn'],$_POST['token']); 
	if($ncd->json_total>0){

 ?>
          <div class="col-md-12">
            
            <div class="warning">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>ประวัติสูบบุหรี่ : <?php  echo $ncd->json_data[0]->SMOKENM;?> </b> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>ประวัติดื่มเครื่องดื่มแอลกอฮอลล์ : <?php  echo $ncd->json_data[0]->ALCOHOLNM;?> </b> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>ประวัติเบาหวานในญาติสายตรง : <?php  echo $ncd->json_data[0]->DMFAMILYNM;?> </b> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>ประวัติความดันสูงในญาติสายตรง : <?php  echo $ncd->json_data[0]->HTFAMILYNM;?> </b> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>วิธีการตรวจน้ำตาลในเลือด : <?php  echo $ncd->json_data[0]->BSTEST;?> </b>  
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>
<?php }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติข้อมูลโรคไม่ติดต่อเรื้อรัง </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if ncd

if($action == 'chr'){
$run=0;
	$chr = $fam->chronicfu($_POST['hn'],$_POST['token']); 
	if($chr->json_total>0){

 ?>
          <div class="col-md-12">
            
            <div class="warning">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>ตรวจเท้า : <?php echo $chr->json_data[0]->FOOTNM;?> </b> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>ตรวจจอประสาทตา : <?php echo $chr->json_data[0]->RETINANM;?> </b> 
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>
<?php }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติข้อมูลโรคไม่ติดต่อเรื้อรัง </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if chr

if($action == 'dopd'){
$run=0;
	$diaopd = $fam->diagnosis_opd($_POST['hn'],$_POST['token']); 
if($diaopd->json_total>0){
foreach ($diaopd->json_data as $value) { ?>

          <div class="col-md-6">
            <div class="warning">
                <div class="row" >

                  <div class="col-md-12 col-sm-12" >
                  <fieldset>
                      <h3> รายการที่ <?php $run+=1;echo $run;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>รหัสโรคที่วินิจฉัย : </b> <?php echo $value->DIAGCODE.':'.$value->ICDNAME;?>
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>
<?php }//foreach
		 }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติ </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if dopd

if($action == 'dipd'){
$run=0;
	$diaipd = $fam->diagnosis_ipd($_POST['hn'],$_POST['token']); 
if($diaipd->json_total>0){
foreach ($diaipd->json_data as $value) { ?>

          <div class="col-md-6">
            <div class="warning">
                <div class="row" >

                  <div class="col-md-12 col-sm-12" >
                  <fieldset>
                      <h3> รายการที่ <?php $run+=1;echo $run;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>แผนกที่รับผู้ป่วย : <?php echo $value->WARDDIAG;?> </b></br>
                      <b>ประเภทการวินิจฉัย : <?php echo$value->DIAGTYPENM;?> </b></br>
                      <b>รหัสโรคที่วินิจฉัย : </b> <?php echo $value->DIAGCODE.':'.$value->ICDNAME;?>
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>
<?php }//foreach
		 }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติ </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if dipd

if($action == 'cron'){
$run=0;
	$chronic = $fam->chronic($_POST['hn'],$_POST['token']); 
if($chronic->json_total>0){
foreach ($chronic->json_data as $value) { ?>

          <div class="col-md-6">
            <div class="warning">
                <div class="row" >

                  <div class="col-md-12 col-sm-12" >
                  <fieldset>
                      <h3> รายการที่ <?php $run+=1;echo $run;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>รหัสวินิจฉัยโรคเรื้อรัง : <?php echo $value->CHRONIC;?> </b></br>
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>
<?php }//foreach
		 }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติ </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if cron

if($action == 'proo'){
$run=0;
	$procedure_opd = $fam->procedure_opd($_POST['hn'],$_POST['token']); 
if($procedure_opd->json_total>0){
foreach ($procedure_opd->json_data as $value) { ?>

          <div class="col-md-6">
            <div class="warning">
                <div class="row" >

                  <div class="col-md-12 col-sm-12" >
                  <fieldset>
                      <h3> รายการที่ <?php $run+=1;echo $run;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>รหัสวินิจฉัยหัตถการ : <?php echo $value->PROCEDCODE;?> </b></br>
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>
<?php }//foreach
		 }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติ </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if proo

if($action == 'proi'){
$run=0;
	$procedureipd = $fam->procedure_ipd($_POST['hn'],$_POST['token']); 
if($procedure_ipd->json_total>0){
foreach ($procedure_ipd->json_data as $value) { ?>

          <div class="col-md-6">
            <div class="warning">
                <div class="row" >

                  <div class="col-md-12 col-sm-12" >
                  <fieldset>
                      <h3> รายการที่ <?php $run+=1;echo $run;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>รหัสวินิจฉัยหัตถการ : <?php echo $value->PROCEDCODE;?> </b></br>
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>
<?php }//foreach
		 }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติ </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if proi	

if($action == 'pror'){
$run=0;
	$procedurerefer = $fam->procedure_refer($_POST['hn'],$_POST['token']); 
if($procedure_refer->json_total>0){
foreach ($procedure_refer->json_data as $value) { ?>

          <div class="col-md-6">
            <div class="warning">
                <div class="row" >

                  <div class="col-md-12 col-sm-12" >
                  <fieldset>
                      <h3> รายการที่ <?php $run+=1;echo $run;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>รหัสวินิจฉัยหัตถการ : <?php echo $value->PROCEDCODE;?> </b></br>
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>
<?php }//foreach
		 }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติ </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if pror	

if($action == 'labf'){
$run=0;
	$labfu = $fam->labfu($_POST['hn'],$_POST['token']); 
if($labfu->json_total>0){
foreach ($labfu->json_data as $value) { ?>

          <div class="col-md-6">
            <div class="warning">
                <div class="row" >

                  <div class="col-md-12 col-sm-12" >
                  <fieldset>
                      <h3> รายการที่ <?php $run+=1;echo $run;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>ICD-10-TM : <?php echo $value->LABTEST;?> </b></br>
                      <b>Result : <?php echo $value->LABRESULT;?> </b></br>
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>
<?php }//foreach
		 }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติ </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if labf	

if($action == 'invr'){
$run=0;
	$investigationrefer = $fam->investigation_refer($_POST['hn'],$_POST['token']); 
if($investigationrefer->json_total>0){
foreach ($investigationrefer->json_data as $value) { ?>

          <div class="col-md-6">
            <div class="warning">
                <div class="row" >

                  <div class="col-md-12 col-sm-12" >
                  <fieldset>
                      <h3> รายการที่ <?php $run+=1;echo $run;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>CODE : <?php echo $value->PROCEDCODE;?> </b></br>
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>
<?php }//foreach
		 }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติ </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if invr	

if($action == 'appo'){
$run=0;
	$appointment = $fam->appointment($_POST['hn'],$_POST['token']); 
if($appointment->json_total>0){
foreach ($appointment->json_data as $value) { ?>

          <div class="col-md-6">
            <div class="warning">
                <div class="row" >

                  <div class="col-md-12 col-sm-12" >
                  <fieldset>
                      <h3> รายการที่ <?php $run+=1;echo $run;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>รหัสโรคที่นัดมาตรวจ : <?php echo $value->APDIAG;?> </b></br>
                      <b>รหัสแผนกที่รับบริการ : <?php echo $value->PROVIDER;?> </b></br>
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>
<?php }//foreach
		 }else{ ?>
		 <div class="col-md-12">
            
            <div class="warning">
                    <fieldset>
                      <b> ไม่มีประวัติ </b>
                    </fieldset>
            </div>
        </div>

		 <?php }
		}//if appo	

else{

}

?>

