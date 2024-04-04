<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=04/04/2024&date_req2=04/04/2024&VAL_NM_RQ=R01235');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
$xmlobj = new SimpleXMLElement($output);
print_r(date('d/m/Y'));