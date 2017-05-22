<?php
return array(
    // set your paypal credential
    'client_id' => 'AV2eEMCSovZTGM0IpWbA8hSYIzwSDHGjrVUMH5D80vnWqNOm2vjV2ezI9Aj5lPyuieqdhUMKMppf4S2y',
    'secret' => 'EHlTkjaMiskiYlDMRGpzIdjd4cUA0U0XVMvL8wT5Hh6Yunku9XwC1BvQDWObQnovzetKTXRuiF4Z71PQ',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

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