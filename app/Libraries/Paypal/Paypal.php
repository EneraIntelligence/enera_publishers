<?php
namespace Publishers\Libraries\Paypal;
/**
 * Created by PhpStorm.
 * User: pedroluna
 * Date: 12/21/15
 * Time: 10:35 AM
 */
class Paypal
{
    /**
     * object to authenticate the call.
     * @param object $_apiContext
     */
    private $_apiContext;

    /**
     * Set the ClientId and the ClientSecret.
     * @param
     *string $_ClientId
     *string $_ClientSecret
     */
    private $_ClientId = 'AVJx0RArQzkCCsWC0evZi1SsoO4gxjDkkULQBdmPNBZT4fc14AROUq-etMEY';
    private $_ClientSecret = 'EH5F0BAxqonVnP8M4a0c6ezUHq-UT-CWfGciPNQOdUlTpWPkNyuS6eDN-tpA';

    /*
     *   These construct set the SDK configuration dynamiclly,
     *   If you want to pick your configuration from the sdk_config.ini file
     *   make sure to update you configuration there then grape the credentials using this code :
     *   $this->_cred= Paypalpayment::OAuthTokenCredential();
    */
    public function __construct()
    {

        // ### Api Context
        // Pass in a `ApiContext` object to authenticate
        // the call. You can also send a unique request id
        // (that ensures idempotency). The SDK generates
        // a request id if you do not pass one explicitly.

        $this->_apiContext = Paypalpayment::apiContext($this->_ClientId, $this->_ClientSecret);

        // Uncomment this step if you want to use per request
        // dynamic configuration instead of using sdk_config.ini

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => __DIR__ . '/../PayPal.log',
            'log.LogLevel' => 'FINE'
        ));

    }

}