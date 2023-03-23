<html>
<head>
<meta charset="utf-8">
<title> ทดสอบเช็ค Hn  </title>
</head>
	<body>
		<form action="save.php" name="index" method="post">
			ID :<input type="text" name="id" ><br>
			FNAME :<input type="text" name="fname" ><br>
			LNAME :<input type="text" name="lname" ><br>
			DATE  :<input type="date" name="datex"><br>
			<input type="submit" name="submit" value="ตกลง">

			
			<?PHP
/* 					$objConnect = oci_connect("hisrjvt","hisrjvt","192.168.1.231/rjvtdb");
					$strSQL = "SELECT * FROM psy";
					$objParse = oci_parse ($objConnect, $strSQL);
					oci_execute ($objParse,OCI_DEFAULT);
					$intNumField = oci_num_fields($objParse);
					$i = 0;
					echo "<b>Table CUSTOMER have $intNumField Fields.</b><br>";
					for($i=1;$i<=$intNumField;$i++)
					{
						echo $i."=".oci_field_name($objParse,$i)." (".oci_field_type($objParse,$i).")<br>";	
						
					}
					oci_close($objConnect); */
					
					include ("funcondb.php"); 
					show_psy();
					//แสดงข้อมูล
		/* 			$funcondb1 =new funcondb();
					$strSQL = "SELECT * FROM psy";
					$funcondb1->queryOci($strSQL);
					$R_ipt =$funcondb1->fetch_array();
					$row = $funcondb1->num_rows();
					
					for($i=1; $i<=$row; $i++)
					{
						echo $R_ipt[$i]['ID'].":".$R_ipt[$i]['FNAME']."<br>";
					}  */
					//END แสดงข้อมูล
					
				/* 	$funcondb1 =new funcondb();
					$strSQL = "SELECT ID FROM psy";
					//$strSQL = "SELECT MAX(ITEMNO) AS MAX_ITEMNO FROM DrujoinDise ";
					$objSelect = array();
					$objSelect = $funcondb1->SelectRecord($strSQL);
				 	if(!$objSelect)
					{
						echo "Record not found<br>";
					}
					else 
					{
						//echo oci_num_rows($objSelect);
						$i=0;
						foreach($objSelect as $value)
						{
							echo $i.$value['ID']."<br>";
							$i++;
						}
					}  */
					
				/* 	$funcondb1->queryOci($strSQL);
					$xx = $funcondb1->fetch_array();
					echo $xx[0]['MAX_ITEMNO']; */
		
				
				
				
				function show_psy()
				{
					$funcondb1 =new funcondb();
					$strSQL = "SELECT ID FROM psy";
					//$strSQL = "SELECT MAX(ITEMNO) AS MAX_ITEMNO FROM DrujoinDise ";
					$objSelect = array();
					$objSelect = $funcondb1->SelectRecord($strSQL);
					
					//print_r($objSelect);
					
				 	if(!$objSelect)
					{
						echo "Record not found<br>";
					}
					else 
					{
						//echo oci_num_rows($objSelect);
						$i=0;
						foreach($objSelect as $value)
						{
							echo $i.'||'.$value['ID']."<br>";
							$i++;
						}
					} 
					
				}
				
			?>
			
			
			
		</form>
	</body>
</html>