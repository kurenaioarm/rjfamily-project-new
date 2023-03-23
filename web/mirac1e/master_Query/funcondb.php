<?PHP
require_once ('config.php');

 Class funcondb
 {
	 
	private $charset = "UTF8";
	
	private $rs;
	private $_fetch_array = array();
	private $_connOci = null;
	
	//ฟังชั่นเรียกใช้งานการเชื่อมต่อ
	public function ConOra()
	{
		return $this->_connOci;
	}
	
	//ฟังชั่นเช็คค่าว่าสามารถเชื่อมต่อ Oracle ได้ไม
	private function con($user, $pass, $host) 
	{
        $conn = oci_connect($user, $pass, $host, 'AL32UTF8');
        if ($conn == true) 
		{
			//echo 'Connection pass';
            return $conn;
        } 
		else 
		{
			return false; 
        }
    }
	
	
	//เช็คการเชื่อมต่อ ORacle
	public function ChkConnOra() 
	{
		if($this->con(DB_USER, DB_PASS, DB_HOST) == true)
		{
			$this->_connOci = $this->con(DB_USER, DB_PASS, DB_HOST);
			//echo "เชื่อมต่อสำเร็จ";
		} 
		else
		{
			$e = oci_error();   // For oci_connect errors pass no handle
			echo htmlentities($e['message']);
			return FALSE;
		}
	}
	
	//คิวรี่ข้อมูล
	public function queryOci($strsql)
	{
		$this->ChkConnOra();
		$result = oci_parse($this->ConOra(), $strsql);
		$exec  = oci_execute($result);
		$this->rs = $result;
		if(!$exec)
		{
			$e= oci_error($result);
			print htmlentities($e['message']);
			print "\n<pre>\n";
			print htmlentities($e['sqltext']);
			printf("\n%".($e['offset']+1)."s", "^");
			print  "\n</pre>\n";
		}
		oci_close($this->ConOra());
		$this->Clear();
	}
	
	//นำข้อมูลที่คิวรี่ออกมาแปลใส่ลง Array 
	public function fetch_array()
	{
		if(count($this->_fetch_array) > 0)
		{
			return $this->_fetch_array;
		}
		else
		{
			while(($row = oci_fetch_assoc($this->rs)) != FALSE)
			{
				//array_push($this->_fetch_array,$row);
				$this->_fetch_array[] = $row;
				//print_r($row);
				
			}
			return $this->_fetch_array;
		}
	}
	
	//จำนวน ROwS ที่คิวรี่ แต่ต้องใช้ฟังชั่น fetch_array() นี่ก่อน
	public function num_rows()
	{
		return oci_num_rows($this->rs);
	}
	
		/**** function commit record ****/
	private function fncCommit()
	{
		return oci_commit($this->ConOra()); 
	}

	/**** function rollback record ****/
	private function fncRollBack()
	{
		return oci_rollback($this->ConOra()); 
	}
	
	
	//ฟังชั่น Insert ข้อมูล
	public function insertRecord($sql)
	{
		$this->ChkConnOra();
		$objParse = oci_parse($this->ConOra(),$sql);
		$objExecute = oci_execute($objParse,OCI_DEFAULT);
		//print_r($objExecute);
		if($objExecute)
		{
			$this->fncCommit();
			//echo "text1";
		}
		else
		{
			$e = oci_error($objParse);  // For oci_execute errors pass the statement handle
			echo htmlentities($e['message']);
			$this->fncRollBack();
			//echo "text2";
		}
		oci_close($this->ConOra());
		return $objExecute;
	}
	
	//ฟังชั่น  UPDATE ข้อมูล
	public function updateRecord($sql)
	{
		$this->ChkConnOra();
		$objParse = oci_parse($this->ConOra(),$sql);
		$objExecute = oci_execute($objParse,OCI_DEFAULT);
		if($objExecute)
		{
			$this->fncCommit();
		}
		else
		{
			$this->fncRollBack();
		}
		oci_close($this->ConOra());
		return $objExecute;
	}
	
	//ฟังชั่น  Delet ข้อมูล
	public function deleteRecord($sql)
	{
		$this->ChkConnOra();
		$objParse = oci_parse($this->ConOra(),$sql);
		$objExecute = oci_execute($objParse,OCI_DEFAULT);
		if($objExecute)
		{
			$this->fncCommit();
		}
		else
		{
			$this->fncRollBack();
		}
		oci_close($this->ConOra());
		return $objExecute;
	}
	
	
		/**** function select record ****/
	public function SelectRecord($sql)
	{
		$this->ChkConnOra();
		$objParse = oci_parse($this->ConOra(), $sql);
		oci_execute($objParse, OCI_DEFAULT);
		//return oci_fetch_array($objParse);
		//print_r($objParse);
		$res =array();
		while(($row = oci_fetch_array($objParse)) != FALSE)
		{
			$res[] = $row;
		}
		oci_close($this->ConOra());
		return $res;
	}
	
	//Clear ค่าตัวแปร
	private function Clear()
	{
		$this->_fetch_array = array();
	}
	
	public function ConvDate($dateX,$type)
	{
		$dateConv="";
		if(($dateX != "") && ($dateX != null))
		{
			if($type == "th")
			{
				list( $day, $month, $year) = split('[/.-]',$dateX);
				$ye= $year + 543;
				$dateConv = $day.'/'.$month.'/'.$ye;
			}
			elseif($type == "en")
			{
				list( $day, $month, $year) = split('[/.-]',$dateX);
				$ye= $year - 543;
				$dateConv = $day.'/'.$month.'/'.$ye;
			}
		}
		return $dateConv;
	}

	  function Thai_Date($dmy,$type_m,$format){//,$format_return
		
			if($dmy == '1900-01-01 00:00:00.000000' || $dmy == '') return '-';
			$component = explode("-",substr($dmy,0,10));
			$month = str_pad($component[1],2,"0",STR_PAD_LEFT);
			if($format == "eng-th"){
				$year = ($component[0] + 543); 
				$day = str_pad($component[2],2,"0",STR_PAD_LEFT);
			}elseif($format == "eng-th ddmmyy"){
				$year = ($component[2] + 543); 
				$day = str_pad($component[0],2,"0",STR_PAD_LEFT);
			}elseif($format == "th-eng"){
				$year = ($component[2] - 543); 
				$day = str_pad($component[0],2,"0",STR_PAD_LEFT);

			}elseif($format == "eng ddmmyy"){
				$year = ($component[0]); 
				$day = str_pad($component[2],2,"0",STR_PAD_LEFT);			

			}elseif($format == "none"){
				$year = $component[2];
				$day = str_pad($component[0],2,"0",STR_PAD_LEFT);
			}
				switch ($type_m){
					case 1 :
						$th_month = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
										 "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจืกายน","ธันวาคม");	
						$date = (int)$day." ".$th_month[intval($month)-1]." ".$year; 
						break;
					case 2 :
						$th_month = array("ม.ค.","ก.พ.","มี.ค.","เม.ษ.","พ.ค.","มิ.ย.",
										 "ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
						$date = (int)$day." ".$th_month[intval($month)-1]." ".$year; 
						break;
					case 3 :
						//$date = $day."/".$month."/".$year; 
						$date = $day."-".$month."-".$year; 
						break;
					case 4 :
						//$date = $day."/".$month."/".$year; 
						$date = $year."-".$month."-".$day; 
						break;
				}      
			return $date;
		}
	
	 
	 
 }

?>