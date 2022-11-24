PayPal extension for the Yii2
====

PayPal payment extension for the Yii2.

Installation
====

Add the dependanbcy to your project via composer (recommended)

```
composer require --prefer-dist davidjeddy/yii2-paypal "*"

OR 

"davidjeddy/yii2-paypal": "dev-master"
```

Add this to your Yii2 application configuration:

```php
'paypal'=> [
    'class'        => 'davidjeddy\Paypal',
    'clientId'     => 'you_client_id',
    'clientSecret' => 'you_client_secret',
    'isProduction' => false,
    // This properties would be found in the Paypal sdk_config.ini
    'config'       => [
        'http.ConnectionTimeOut' => 30,
        'http.Retry'             => 1,
        'mode'                   => \davidjeddy\Paypal::MODE_SANDBOX, // development (sandbox) or production (live) mode
        'log.LogEnabled'         => YII_DEBUG ? 1 : 0,
        'log.FileName'           => '@runtime/logs/paypal.log',
        'log.LogLevel'           => \davidjeddy\Paypal::LOG_LEVEL_FINE,
    ]
],
```

Usage
====

```php
Class Someclass
{
    ...
    /**
     * [pay description]
     * 
     * @param  array  $paramData [description]
     * @return [type]            [description]
     */
    private function pay(array $paramData) {
        $paypalComponent = new Paypal();

        try {
            return $paypalComponent->execTransaction($paramData);
        } catch (Exception $ex) {
            echo PaypalError($e);
        }

        return flase;
    }
    ...
}
```
