<html>
<head>
<meta charset="utf-8">
<title> ทดสอบเช็ค Hn  </title>
</head>
	<body>
		<form action="index.php" name="index" method="post">
			<input type="text" name="search" >
			<input type="submit" name="submit" value="ตกลง">

			<?PHP
			//include "splitText.php";
			include "ClassProfile.php";
			$ClassProfile = new ClassProfile(); //ประกาศตัวแปร Class ClassProfile
			
			$_search = $_POST["search"];
			
			$ClassProfile->ChkText($_search);
			echo $ClassProfile->Hn();
			echo "<br>";
			
			echo $ClassProfile->An();
			echo "<br>";
			
			echo $ClassProfile->Sub_an();
			echo "<br>";
			
			echo $ClassProfile->Sub_hn();
			echo "<br>";
			
			echo $ClassProfile->Dspname();
			echo "<br>";
			
			echo $ClassProfile->Age();
			echo "<br>";
			
			echo $ClassProfile->Sex();
			echo "<br>";
			
			echo $ClassProfile->Cardno();
			echo "<br>";
			
			echo $ClassProfile->Incprvlg();
			echo "<br>";
			
			
			?>
			

			
			
		</form>
	</body>
</html>