<?php
require('webservice_login.php');
$AppointResult = new WsAppointment();


$DctSchedule = $AppointResult->AllAppointMentDCT($_GET['datatoken']);

//$nexturl = '?p=app_detail&hn=' . base64_encode(base64_encode($DctSchedule->json_data[$i]->HN)) . 'nm=' . base64_encode(base64_encode($DctSchedule->json_data[$i]->PTNM));

foreach ($DctSchedule->json_data as $item) {

    $arrayoapp[] = array(
        'startDate'         =>  dateNext($item->NEXTDATETH),
        'endDate'   =>  dateNext($item->NEXTDATETH),
        'nextTime'          =>  $item->NEXTTIMETH,
        'nextURL'          =>  (string)'?p=app_detail&hn=' . base64_encode(base64_encode($item->HN)) . '&nm=' . base64_encode(base64_encode($item->PTNM)),
        'nextHN'          =>  hn($item->HN),
        'nextNM'          =>  $item->PTNM,
        'lctNM'          =>  $item->LCTNM,
    );
}

echo json_encode($arrayoapp);
