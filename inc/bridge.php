<?php

function get_soldipubblici_array($codicecomparto, $codiceente, $cosa, $debug) {

    $query='codicecomparto='.$codicecomparto.'&codiceente='.$codiceente.'&cosa='.$cosa;

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL, 'http://soldipubblici.gov.it/it/ricerca');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=UTF-8','Accept: Application/json','X-Requested-With: XMLHttpRequest','Content-Type: application/octet-stream','Content-Type: application/download','Content-Type: application/force-download','Content-Transfer-Encoding: binary '));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);

    $data = curl_exec($ch);
    curl_close($ch);

    if ($debug) { var_dump( $data ); }

    return json_decode($data);
}
?>
