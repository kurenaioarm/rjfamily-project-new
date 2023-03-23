<?php
$p = isset($_GET['p']) ? $_GET['p'] : '';
 if($p==""){
?>
<script langquage='javascript'>
window.location="?p=features";
</script>
<?php
}else{
	if($p=="index"){
		$pages="template/features.php";
	}elseif($p=="features"){
		$pages="template/features.php";
	}elseif($p=="login"){
		$pages="template/login.php";
	}elseif($p=="survey_profile"){
		$pages="page/survey_profile.php";
		$texts='แบบฟอร์มการสำรวจข้อมูลที่พักอาศัย';
	}elseif($p=="sub_detail"){
		$pages="template/sub_detail.php";
		$texts='ประวัติผู้ป่วย';
	}elseif($p=="detail_personal"){
		$pages="page/detail_personal.php";
		$texts='รายละเอียดประวัติผู้ป่วย (Person)';
	}elseif($p=="survey_sanitary"){
		$pages="page/survey_sanitary.php";
		$texts='แบบฟอร์มการสำรวจข้อมูลสุขาภิบาลที่พักอาศัยของครอบครัว (Health Survey)';
	}elseif($p=="genogram"){
		$pages="geno/genogram.php";
		$texts='genogram (TEST)';
	}elseif($p=="pre_geno"){
		$pages="geno/pre_geno.php";
		$texts='preset genogram';
	}elseif($p=="minemap"){
		$pages="map/minemap.php";
		$texts='map location';
	}else{

	}
	
}	
?>