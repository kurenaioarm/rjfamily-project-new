<?php
include ("master_Query/ClassProfile.php");

$insid=isset($_REQUEST["ins_id"])?$_REQUEST["ins_id"]:'';

                  $oci = new funcondb ();
                  $sql = "   SELECT 
                                PERSON.HOSPCODE,
                                HPT.NAME AS HPTNAME,
                                        PERSON.PID,
                                       PERSON.CID,
                                       PERSON.NAME,
                                       PERSON.LNAME,
                                       PERSON.HN,
                                       PERSON.SEX,
                                       PERSON.BIRTH,
                                       PERSON.MSTATUS,
                                       MRTLST.NAME AS MNAME,
                                       PERSON.OCCUPATION_NEW,
                                      -- OCCPTN.NAME AS OCCPTNNAME,
                                       PERSON.RACE,
                                       A.NAME AS RACENAME,
                                       PERSON.NATION,
                                       B.NAME AS NATIONNAME,
                                       PERSON.RELIGION,
                                       RLGN.NAME AS RLGNNAME,
                                       PERSON.EDUCATION,
                                       EDULEVEL.NAME AS EDUNAME,
                                       ADDRESS.HOUSENO,
                                       ADDRESS.ROAD,
                                        CASE 
                                          WHEN  ADDRESS.VILLAGE = '99' THEN ''
                                            ELSE ADDRESS.VILLAGE END AS MOO,
                                       ADDRESS.TAMBON,
                                       TUMBON.NAME AS TBNM,
                                       ADDRESS.AMPUR,
                                       AMPUR.NAME AS AUMPNM,
                                       ADDRESS.CHANGWAT,
                                       CHANGWAT.NAME AS CGWTNM,
                                       ADDRESS.POSTAL_CODE/* ,
                                      CHANGWAT.CHANGWAT || '' || ADDRESS.AMPUR,
                                       CHANGWAT.CHANGWAT || '' || ADDRESS.AMPUR || '' || ADDRESS.TAMBON*/
                                  FROM S_PHR.PERSON
                                  LEFT JOIN RJVT.MRTLST
                                  ON PERSON.MSTATUS = MRTLST.MRTLST
                                  LEFT JOIN RJVT.NTNLTY A
                                  ON PERSON.RACE = A.FILE50CODE
                                  LEFT JOIN RJVT.NTNLTY B
                                  ON PERSON.NATION = B.FILE50CODE
                                  LEFT JOIN RJVT.RLGN
                                  ON PERSON.RELIGION = RLGN.FILE50CODE
                                  /*LEFT JOIN RJVT.OCCPTN
                                  ON PERSON.OCCUPATION_NEW = OCCPTN.FILE50CODE*/
                                  LEFT JOIN RJVT.EDULEVEL
                                  ON PERSON.EDUCATION = EDULEVEL.FILE50CODE
                                  LEFT JOIN S_PHR.ADDRESS 
                                  ON PERSON.PID = ADDRESS.PID
                                  LEFT JOIN RJVT.HPT
                                  ON PERSON.HOSPCODE = HPT.HPT
                                  LEFT JOIN RJVT.CHANGWAT
                                  ON ADDRESS.CHANGWAT = CHANGWAT.CHANGWAT
                                  LEFT JOIN RJVT.AMPUR
                                  ON ADDRESS.CHANGWAT = AMPUR.CHANGWAT
                                  AND AMPUR.AMPUR = CHANGWAT.CHANGWAT || '' || ADDRESS.AMPUR
                                  LEFT JOIN RJVT.TUMBON
                                  ON ADDRESS.CHANGWAT = TUMBON.CHANGWAT
                                  AND TUMBON.AMPUR = CHANGWAT.CHANGWAT || '' || ADDRESS.AMPUR
                                  AND TUMBON.TUMBON = CHANGWAT.CHANGWAT || '' || ADDRESS.AMPUR || '' || ADDRESS.TAMBON
                                 WHERE PERSON.PID = '".$_SESSION['person']."' OR PERSON.CID =  '".$_SESSION['person']."' ";

                  $data_s = $oci->SelectRecord($sql);
                  //echo $sql;

?>