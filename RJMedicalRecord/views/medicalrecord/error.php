<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;


?>

<!-- on your view layout file HEAD section -->
<script src="<?=\yii\helpers\Url::to('@web/../RJMedicalRecord/js/jquery.min.js'); ?>"></script>
<script src="<?=\yii\helpers\Url::to('@web/../RJMedicalRecord/js/all.js'); ?>"></script>

<!------------------------------------------------------------------- รอโหลดหน้าเว็บ ---------------------------------------------------------------------------------------->
<style type="text/css">
    /*รอโหลดหน้า*/
    #overlay {
        position: absolute;
        top: 0px;
        left: 0px;
        /*background: #ccc;*/
        width: 100%;
        height: 100%;
        /*opacity: .75;*/
        filter: alpha(opacity=100);
        -moz-opacity: .10;
        z-index: 999;
        background: #fcfdfc url(https://rjfamily.rajavithi.go.th/assets/images/Loading/LoadindV8.gif) 50% 50% no-repeat;
    }
    .main-contain{
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    body {
        background-color: #ffffff;
    }
</style>
<div id="overlay"></div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------>


<div class="site-error main-contain">

    <div  id="Error_IMG"  align="center" >
        <br>
        <span id="replace_target"><img src="https://rjfamily.rajavithi.go.th/assets/images/Error/ErrorV2.gif" style="width: 60%; height: 65%;border: 0px solid black;"></span>
        <br><br>
    </div>

</div>


<script type="text/javascript">

    $(function(){
        //========================================รอโหลดหน้า===============================================
        $("#overlay").fadeOut();
        $(".main-contain").removeClass("main-contain");
        //===============================================================================================
    });

</script>