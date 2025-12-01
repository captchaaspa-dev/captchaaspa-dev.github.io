<?php


function runApi($method, $apiUrl, $apiParams=[]) {
    $curlHandle = curl_init();

    curl_setopt($curlHandle, CURLOPT_TIMEOUT, 1000);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlHandle, CURLOPT_URL, $apiUrl);

    echo "url: {$apiUrl}";
    echo "\n";

    switch (strtoupper($method)) {
        case "GET":
            curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($curlHandle, CURLOPT_POST, false);
            break;
        case "POST":
            curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curlHandle, CURLOPT_POST, true);
            break;
        /*case "PUT":
            curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "PUT");
            break;
        case "PATCH":
            curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "PATCH");
            break;
        case "DELETE":
            curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "DELETE"); 
            break;
        */
        default:
            return null;
    } //switch (strtoupper($method))

    $curlHeaders = array();
    $authToken = base64_encode("javier@javierlopezfernandez.es:Javier-2020");
    $curlHeaders[] = "Authorization: Basic {$authToken}";
    $curlHeaders[] = "OCS-APIRequest: true";
    $curlHeaders[] = "Accept: application/json";
    //$curlHeaders[] = "Authorization: Basic QWRtaW5pc3RyYWRvcjoyMTVhbGZhZGVsdGE=";
    curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $curlHeaders);
    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, http_build_query(!empty($apiParams) ? $apiParams : []));

    $ret = curl_exec($curlHandle);
    if ($error = curl_error($curlHandle)) {
        return $error;
    }
    curl_close($curlHandle);

    return $ret;
}


//https://panel.colaboras.cloud/ocs/v2.php/apps/spreed/api/v4/room?clbdomain=aspa.cloud

//$host = "https://clouddeb02.colaboras.cloud";
//$host = "https://panel.colaboras.cloud";
//$apiAction = "room";
$apiUrl = "https://clouddeb02.colaboras.cloud/ocs/v2.php/apps/spreed/api/v4/room?clbdomain=javierlopezfernandez.es";
//$apiUrl = "https://clouddeb02.colaboras.cloud/apps/spreed/api/v4/room?clbdomain=javierlopezfernandez.es";
$apiParams = [];



//$ret = runApi("GET", "{$host}/apps/spreed/api/1.0/{$apiAction}", $apiParams);
$ret = runApi("GET", $apiUrl, $apiParams);
//$retArray = json_decode($ret, true);


echo "SALIDA\n";
echo "-------\n\n";
echo print_r($ret, true);
echo "\n";
echo "-------\n\n";