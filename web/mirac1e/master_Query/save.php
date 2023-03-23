<html>
<head>
<meta charset="utf-8">
<title> SAVE  </title>
</head>
	<body>
			<?PHP
				include ("funcondb.php"); 
				date_default_timezone_set('Asia/Bangkok');
				$dateY = $_POST['datex'];
				$datex = new DateTime($dateY);

				echo $_POST['id']."<br>";
				echo $_POST['fname']."<br>";
				echo $_POST['lname']."<br>";
				echo $datex->format('d/m/Y');
				
				insert_psy($_POST['id'],$_POST['fname'],$_POST['lname'],$datex->format('d/m/Y'));
//				insert_psy2();
				
				
					/* $funcondb1 =new funcondb();
					$sql = " insert into psy ";
					$sql .=" (ID,FNAME,LNAME)";
					$sql .=" VALUES ";
					$sql .=" ('".$_POST['id']."','".$_POST['fname']."','".$_POST['lname']."') ";
					$objInsert = $funcondb1->insertRecord($sql);
					print_r($objInsert);
					if($objInsert)
					{
						echo "บันทึกแล้ว";
					}
					else
					{
						echo "ไม่สามารถบันทึกได้";
						print_r($sql);
					}  */
				

				function insert_psy($hn,$fname,$lname,$datex)
				{
					date_default_timezone_set('Asia/Bangkok');
					$funcondb1 =new funcondb();
					$sql = " insert into psy ";
					$sql .=" (ID,FNAME,LNAME,DATEX)";
					$sql .=" VALUES ";
					$sql .=" ('".$hn."','".$fname."','".$lname."',to_date('".$datex."','dd/mm/yyyy'))";
					$objInsert = $funcondb1->insertRecord($sql);
					print_r($objInsert);
					if($objInsert)
					{
						
						echo "บันทึกแล้ว";
						print_r($sql);
						insert_psy2();
					}
					else
					{
						echo "ไม่สามารถบันทึกได้";
						print_r($sql);
					} 
					
				}
				
				
				function insert_psy2()
				{
					date_default_timezone_set('Asia/Bangkok');
					$funcondb2 =new funcondb();
					$sql2 = " insert into psy ";
					$sql2 .=" (ID,FNAME,LNAME)";
					$sql2 .=" VALUES ";
					$sql2 .=" (
								'9999994'
								,'XX1'
								,'Xxx2'
								)
					";
					$YY = $funcondb2->insertRecord($sql2);
					if($YY)
					{
						
						echo "บันทึกแล้ว";
						print_r($sql2);
					}
					else
					{
						echo "ไม่สามารถบันทึกได้";
						print_r($sql2);
					} 
				}
				
				
				
			?>
	</body>
</html>