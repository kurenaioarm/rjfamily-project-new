<?php 
//require_once ('config.php');
include ("funcondb.php"); 
?>

<?PHP
	Class ClassProfile 
	{
		//extends funcondb //สืบทอด Class
		
		//require_once ('funcondb.php');
		
        private  $_sub_hn = null;
        private  $_hn = null;
        private  $_dspname = null;
        private  $_age = null;
        private  $_sex = null;
        private  $_incprvlg = null;
        private  $_an = null;
        private  $_sub_an = null;
        private  $_cardno = null;

        private  $chkerror = null;
        private  $chkRowPT = null;
		
		private  $_datenew =null;
		private  $_timenew =null;
		private  $_pttpye=null;
		
	   public function Hn()
	   {
		  return $this->_hn;
	   }
	   
	   public function An()
	   {
		  return $this->_an;
	   }
	   
	   public function Sub_hn()
	   {
		  return $this->_sub_hn;
	   }
	   
	   public function Sub_an()
	   {
		  return $this->_sub_an;
	   }
	   
	   public function Cardno()
	   {
		  return $this->_cardno;
	   }
	   
	   public function DspName()
	   {
		  return $this->_dspName;
	   }
	   
	   public function Age()
	   {
		  return $this->_age;
	   }
	   
	   public function Sex()
	   {
		  return $this->_sex;
	   }
	   
	    public function Incprvlg()
	   {
		  return $this->_incprvlg;
	   }
	   
	   public function DateNew()
	   {
		   return $this->_datenew;
		   
	   }
	   
	    public function TimeNew()
	   {
		   return $this->_timenew;
		   
	   }
	   
	   public function PtType()
	   {
		   return $this->_pttpye;
		   
	   }

	   public function ChkText($searcg)
	   {
		   if($searcg != "" && strlen(trim($searcg)) > 0)
		   {
			   $this->ClearProfile();
			   //$this->_hn = $searcg;
			   //เช็คเครื่องหมาย 
				$arrchk_Number = array();
				$arrchk_Number =str_split($searcg);
				
				$DATA_NUMBER="";
				$i=0;
				foreach($arrchk_Number as $value)
				{
					if($arrchk_Number[$i] == "."){$DATA_NUMBER =".";}
					if($arrchk_Number[$i] == "-"){$DATA_NUMBER ="-";}
					if($arrchk_Number[$i] == "/"){$DATA_NUMBER ="/";}
					$i++ ; 
				}
				//END เครื่องหมาย
						
				//เช็คว่าเป็น HN , An 
				$an_split = array();
				switch($DATA_NUMBER)
				{
					case ".":
						$an_split = explode(".",$searcg);
						 $this->_an = $this->SplitAN('.',$an_split[0]);
						
					break;
					case "-":
						 $this->_hn = $this->SplitHN('-',$searcg);
					break;
					case "/":
						 $this->_hn = $this->SplitHN('/',$searcg);
					break;
					default:
						 $this->_hn = $searcg;
					break;
				}
				//END เช็คว่าเป็น HN , An 
				
				$this->SelectProfile();
		   }
		   else 
		   {
			   $this->ClearProfile();
		   }
			
	   }
	  
		private function SplitAN($data , $an)
		{
			$counStr = strlen($an);
			$ADD_0="";
			$retan="";
			
			if($counStr < 7 )
			{
				// เพิ่มจำนวนตัวเลขให้ครบ 7 หลักจากทางซ้าย
				$ADD_0 = str_pad($an,7,"0",STR_PAD_LEFT);
			}
			
			if($counStr < 7 )
			{
				$retan = $ADD_0;
				
			}
			else
			{
				$retan = $an;
			}
			return  $retan ;
			
		}

		private function SplitHN($data , $hn)
		{
			$hn_split= array();
			$hn_split = explode($data,$hn); //split data ออก
			$counStr2 = strlen($hn_split[0]); // หาจำนวน ตัวอักษร
			$ADD_02="";
			$rethn="";
			
			if($counStr2 < 6 )
			{
				// เพิ่มจำนวนตัวเลขให้ครบ 6 หลักจากทางซ้าย
				$ADD_02 = str_pad($hn_split[0],6,"0",STR_PAD_LEFT); 
			}
			
			if($counStr2 < 6 )
			{
				$rethn = $hn_split[1].$ADD_02;
				
			}
			else
			{
				$rethn = $hn_split[1].$hn_split[0];
			}
			return  $rethn ;
			
		}
		
		
		private function SelectProfile()
		{
			$funcondb1 =new funcondb();
			//chk hn ว่ามี An ไม
			if($this->_hn != null)
			{
				$sqlChkAn = " SELECT ipt.an FROM rjvt.ipt ipt "
				." WHERE ipt.dchdate is null "
				." AND ipt.canceldate is null "
				." AND ipt.hn ='$this->_hn'";
				
				$funcondb1->queryOci($sqlChkAn);
				$R_ipt =$funcondb1->fetch_array();
				$row = $funcondb1->num_rows();
				if($row > 0 )
				{
					$this->_an =$R_ipt[0]['AN'];
				}
			}
			//end An 
			
			
			//ดึง hn จาก an และ เช็คขีดว่าอะไร
			if($this->_an != null)
			{
				 $SQLAn = " SELECT ipt.an ,pt.hn,ipt.andept "
                        ." FROM rjvt.ipt ipt"
                        ." left outer join rjvt.pt pt on ipt.hn=pt.hn"
                        ." where ipt.an=$this->_an";
						
				$funcondb1->queryOci($SQLAn);
				$R_an =$funcondb1->fetch_array();
				$row = $funcondb1->num_rows();
				if($row > 0 )
				{
					//print_r($SQLAn);
					$this->_hn =$R_an[0]['HN'];
					
					//เช็คขีดว่า null ไม
					$_andept="";
					if($R_an[0]['ANDEPT'] != null && $R_an[0]['ANDEPT'] != 0 ) 
					{
						$_andept = $R_an[0]['ANDEPT'];
					}
					// end เช็คขีดว่า
					
					if($_andept != "")
					{
						$this->_sub_an = $R_an[0]['AN'];
						$this->_sub_an .="-".$_andept; 
					}
				}
			}
			//end ดึง hn จาก an
			
			$this->Pt();//ดึงข้อมูล PT
			$this->Intprvlg();//ดึงสิทธิการรักษา
			$this->DateTimeX();
		}


		private function Pt()//ดึงข้อมูล PT
		{
			$funcondb2 =new funcondb();
			
			//ดึงข้อมูลส่วนตัวไปแสดง 
            $sqlPT = "SELECT * FROM Profile_n WHERE hn=$this->_hn";
			$funcondb2->queryOci($sqlPT);
			$R_PT =$funcondb2->fetch_array();
			$row_PT = $funcondb2->num_rows(); 
			if($row_PT > 0 )
			{
				if($R_PT[0]['SUB_HN'] != null)
				{
					$this->_sub_hn = $R_PT[0]['SUB_HN'];
				}
				
				if($R_PT[0]['DSPNAME'] != null)
				{
					$this->_dspName = $R_PT[0]['DSPNAME'];
				}
				
				if($R_PT[0]['AGE_YEAR'] != null)
				{
					$this->_age = $R_PT[0]['AGE_YEAR'];
				}
				
				if($R_PT[0]['MALE'] != null)
				{
					switch($R_PT[0]['MALE'])
					{
						case 1:
							$this->_sex = "ชาย";
							break;
						case 2:
							$this->_sex = "หญิง";
							break;
					}
				}
				
				if($R_PT[0]['CARDNO'] != null)
				{ 
					$this->_cardno = $R_PT[0]['CARDNO'];
				}

			}
		}
		
		//เช็คสิทธ์การรักษา
		private function Intprvlg()
		{
			$funcondb3 =new funcondb();
			
			$sql_intprvlg = "SELECT pttype.NAME,incprvlg.PTTYPEST,pttype.PTTYPE " 
			." FROM rjvt.incprvlg incprvlg " 
			." LEFT OUTER JOIN rjvt.pttype pttype ON incprvlg.pttype=pttype.pttype " 
			." WHERE " 
			." incprvlg.subtype = 10 " 
			." AND incprvlg.pttypest in(10,20) ";
				
			if($this->_hn != null && $this->_an != null)
			{
				//ดึงสิทธิ์รักษาแบบ An
				 $sql_intprvlg .=" AND incprvlg.hn =$this->_hn"
                                ." AND incprvlg.an =$this->_an";
			}
			else
			{
				//ดึงสิทธิ์รักษาแบบ Hn
                $sql_intprvlg .=" AND incprvlg.issdate =to_date(sysdate) "
                              ." AND incprvlg.hn =$this->_hn";
			}
			
			//print_r($sql_intprvlg);
			
			$funcondb3->queryOci($sql_intprvlg);
			$R_incprvlg =$funcondb3->fetch_array();
			$row_incprvlg = $funcondb3->num_rows(); 
			if($row_incprvlg > 0 )
			{
				switch( $R_incprvlg[0]['PTTYPEST'])
				{
					case 10:
							$this->_incprvlg = $R_incprvlg[0]['NAME'];
							$this->_pttpye = $R_incprvlg[0]['PTTYPE'];
						break;
					case 20:
							$this->_incprvlg = $R_incprvlg[0]['NAME']."(รออนุมัติสิทธิ์)";
							$this->_pttpye = $R_incprvlg[0]['PTTYPE'];
						break;
					default:
							$this->_incprvlg = "ชำระเงินเอง";
							$this->_pttpye ="101";
						break;
					
				}
			}
			else
			{
				$this->_incprvlg = "ชำระเงินเอง";
				$this->_pttpye ="101";
			}
		}
		
		public function DateTimeX()
		{
			date_default_timezone_set('Asia/Bangkok');
			//วันทีประจุบัน
			$source = date("Y-m-d");
			$date_new = new DateTime($source);
			$this->_datenew = $date_new->format('d/m/Y');
			//end วันทีประจุบัน

			//เวลาประจุบัน
			date("H:i:s")."<br>";
			$this->_timenew = $this->convert_time(date("H:i:s"),"");
			//end เวลาประจุบัน
		}
		
		private function convert_time ($time,$type)
		{
			$time_con = "";

			if($type == 'none')
			{

				$time_con = substr($time,0,2).":".substr($time,2,2).":".substr($time,4,2);

			}
			else
			{
				$cut_time = explode(":", $time);
				foreach ($cut_time as $index) 
			{
					$time_con .= $index;
				}             

			}

			return $time_con;
		}

		
		
		public Function ClearProfile()
		{
		  $this->_sub_hn = null;
          $this->_hn = null;
          $this->_dspname = null;
          $this->_age = null;
          $this->_sex = null;
          $this->_incprvlg = null;
          $this->_an = null;
          $this->_sub_an = null;
          $this->_cardno = null;
		}
		
		
		
		
	}
	
?>		