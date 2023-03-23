<?php
$p = isset($_GET['p']) ? $_GET['p'] : '';
 if($p==""){
?>
<script langquage='javascript'>
 window.location="?p=login";
</script>
<?php
}else{
	if($p=="sch_calendar"){
		$pages="page/sch_calendar.php";
	}elseif($p=="or_calendar"){
		$pages="page/or_calendar.php";
	}elseif($p=="tem_upbody"){
		$pages="template/tem_upbody.php";
/*	}elseif($p=="login"){
		$pages="page/login.php";*/
	}elseif($p=="summer"){
		$pages="page/summer.php";
	}elseif($p=="exit"){
		$pages="../conn_logout/chk_logout.php";
	}else{
		$pages="error.php";
	}
	
}	
?>