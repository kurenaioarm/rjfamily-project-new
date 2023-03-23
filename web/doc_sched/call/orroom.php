<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('../lib/orroom_api.class.php');
$orClass = new Orroom();
function dateNext($date) {
    $arrdate = explode('/', $date);
    $y = $arrdate[2];
    $m = $arrdate[1] - 1;
    $d = $arrdate[0];
    return $y . ',' . $m . ',' . $d;
}
function hn($id) {
    $HN1 = substr($id, 0, 2);
    $HN2 = substr($id, 2);
    $ShwHn = $HN2 . '-' . $HN1;

    return $ShwHn;
}
if (isset($_GET['model'])) {
    switch ($_GET['model']) {
        case 'que':
            $result = $orClass->que($_GET['varcode'], $_GET['orroom'], $_GET['month'], $_GET['year']);
            if ($result->json_result) {
                $arrayoapp = array();
                foreach ($result->json_data as $item) {
                    $arrayoapp[] = array(
                        'startDate' =>  $item->ESTMDATE,
                        'endDate' =>  $item->ESTMDATE,
                        'nextTime' =>  $item->ESTMTIME,
                        // 'nextURL' =>  (string)'?p=or_detail&hn=' . base64_encode(base64_encode($item->HN)) . '&nm=' . base64_encode(base64_encode($item->PTNAME)),
                        'nextHN' =>  hn($item->HN),
                        'nextNM' =>  $item->PTNAME,
                        'orNM' =>  $item->NAME . ' ลำดับที่ ' . $item->ORORDER,
                        'orNO' => $item->ORROOM
                    );
                }
                echo json_encode($arrayoapp);
            } else {
                echo json_encode($result);
            }

            break;
        case 'que_surgeon':
            $result = $orClass->que_surgeon($_GET['varcode'], $_GET['orroom'], $_GET['month'], $_GET['year'], $_GET['surgeon']);
            if ($result->json_result) {
                $arrayoapp = array();
                foreach ($result->json_data as $item) {
                    $arrayoapp[] = array(
                        'startDate' =>  $item->ESTMDATE,
                        'endDate' =>  $item->ESTMDATE,
                        'nextTime' =>  $item->ESTMTIME,
                        'nextPage' =>  'surgeon_detail',
                        'nextHN' =>  hn($item->HN),
                        'nextNM' =>  $item->PTNAME,
                        'orNM' =>  $item->NAME . ' ลำดับที่ ' . $item->ORORDER,
                        'orNO' => $item->ORROOM
                    );
                }
                echo json_encode($arrayoapp);
            } else {
                echo json_encode($result);
            }

            break;
        case 'dct':
            $result = $orClass->dct();
            echo json_encode($result);
            break;
        case 'pt_data':
            $result = $orClass->pt_data($_GET['varcode'], $_GET['estmdate'], $_GET['hn']);
            echo json_encode($result);
            break;
        case 'pt_img':
            $result = $orClass->pt_img($_GET['hn']);
            echo json_encode($result);
            break;
        default:
            # code...
            break;
    }
}
