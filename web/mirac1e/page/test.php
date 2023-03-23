<?php
$hn='64024108';
$drug=$oci->Drugallergy($hn, $token);
?>

        <div class="row">

          <div class="col-md-6">
            <div class="warning">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <h3> รายการที่ <?php echo $round+1;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>รหัสยาที่มีประวัติการแพ้ : </b> <?php echo $drug->json_data[$round]->DRUGALLERGY;?>
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>ระดับความรุนแรงของการแพ้ยา : </b> <?php echo $drug->json_data[$round]->ALEVEL;?>
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <b>ลักษณะอาการของการแพ้ยาที่พบ : </b> <?php echo $drug->json_data[$round]->ALGYSIGN2;?>
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>


          <div class="col-md-6">
            <div class="warning">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      <h3> รายการที่ <?php echo $round+2;?> </h3> 
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      รหัสยาที่มีประวัติการแพ้ : <?php echo $drug->json_data[$round]->DRUGALLERGY;?>
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      ระดับความรุนแรงของการแพ้ยา : <?php echo $drug->json_data[$round]->ALEVEL;?>
                    </fieldset>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <fieldset>
                      ลักษณะอาการของการแพ้ยาที่พบ : <?php echo $drug->json_data[$round]->ALGYSIGN2;?>
                    </fieldset>
                  </div>

                  </div>
                 </div>
                </div>

        </div>