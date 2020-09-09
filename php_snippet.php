<?php

$resourceUrl = make_api_request('get_resource_path', array(
                'param1' => '162', // $resource
                'param2' => '0',          // $getfilepath
                'param3' => '',           // $size
                'param5' => 'mp4',
            ));

echo '<script type="text/javascript">',
     'console.log("resourceUrl: '.$resourceUrl.' ");',
     '</script>'
;


// Make an API request
    function make_api_request($method, $queryData) {
 
        $queryData['user'] = 'admin';
        $queryData['function'] = $method;

        $query = http_build_query($queryData, '', '&');
        // Sign the request with the private key.
        $api_key = '9885aec8ea7eb2fb8ee45ff110773a5041030a7bdf7abb761c9e682de7f03045';
        $sign = hash("sha256", $api_key . $query);

        $requestUrl = "https://resourcespace.lmta.lt/api/?" . $query . "&sign=" . $sign;

        $response = file_get_contents($requestUrl);

        return json_decode($response);
    }

?>