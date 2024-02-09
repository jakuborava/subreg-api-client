<?php

return [
    'user' => env('SUBREG_API_USER', ''),
    'password' => env('SUBREG_API_PASSWORD', ''),
    'uri' => env('SUBREG_API_SOAP_URI', 'http://soap.subreg.cz/soap'),
    'location' => env('SUBREG_API_SOAP_LOCATION', 'https://soap.subreg.cz/cmd.php'),
];
