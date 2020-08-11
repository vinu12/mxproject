<?php
/** set your paypal credential **/

$config['client_id'] = 'AZi82NS-Hp8MLKssBw-_ROo3yEAWqNe_3cUU4hfBss-9BymtFdNiNyG3T_pl2a8s9X0Gi3l4xlWX9EFj';
$config['secret'] = 'EIbAPuS6p4zbhF5n1FXPK5D88D-e6pkcLKd8C2YOKt4TqNUCshYNIBrgp9exVMNXZPvLc65PvoH0VrJw';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

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
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);
