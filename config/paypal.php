<?php

return array(
/** set your paypal credential **/
/** rob-facilitator@reddingdesigns.com
**/
'client_id' =>'Ab9x2OsAJZwibQS30CHNKLioW2kpZIuCoddXgYeXQ7u1ajl3f_3cM-ui5fgJtrAZH4cN5l33tZ33O3NN',
'secret' => 'EOEyKRMyBOxckh-krTG5I4DtNkGfUfqxub199SEBAFUsxiE2ovTDikHGmVus38PnH7ps50eK5d_rVzZW',
/**
* SDK configuration

* Test Connection

curl -v -u "Ab9x2OsAJZwibQS30CHNKLioW2kpZIuCoddXgYeXQ7u1ajl3f_3cM-ui5fgJtrAZH4cN5l33tZ33O3NN:EOEyKRMyBOxckh-krTG5I4DtNkGfUfqxub199SEBAFUsxiE2ovTDikHGmVus38PnH7ps50eK5d_rVzZW" "https://api.sandbox.paypal.com/v1/oauth2/token" -X POST -d "response_type=token&grant_type=client_credentials"


*/

'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 1000,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);
