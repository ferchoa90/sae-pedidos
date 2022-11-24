<?php
/**
 * File Paypal.php.
 *
 * @author Marcio Camello <marciocamello@outlook.com>
 * @see https://github.com/paypal/rest-api-sdk-php/blob/master/sample/
 * @see https://developer.paypal.com/webapps/developer/applications/accounts
 */

namespace davidjeddy;

use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\base\Component;

use PayPal\Api\Address;
use PayPal\Api\CreditCard;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\FundingInstrument;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\RedirectUrls;
use PayPal\Rest\ApiContext;

class Paypal extends Component
{
    //region Mode (production/development)
    const MODE_SANDBOX = 'sandbox';
    const MODE_LIVE    = 'live';
    //endregion

    //region Log levels
    /*
     * Logging level can be one of FINE, INFO, WARN or ERROR.
     */
    const LOG_LEVEL_FINE  = 'FINE';
    const LOG_LEVEL_INFO  = 'INFO';
    const LOG_LEVEL_WARN  = 'WARN';
    const LOG_LEVEL_ERROR = 'ERROR';
    //endregion

    // class properties
    /**
     * [$config description]
     * @var array
     */
    public $config = [];

    /** @var ApiContext */
    private $_apiContext = null;

    /**
     * @setConfig 
     * _apiContext in init() method
     */
    public function init()
    {
        $this->config = \Yii::$app->components['paypal'];

        // ### Api context
        // Use an ApiContext object to authenticate
        // API calls. The clientId and clientSecret for the
        // OAuthTokenCredential class can be retrieved from
        // developer.paypal.com

        $this->_apiContext = new ApiContext(
            new OAuthTokenCredential(
                $this->config['clientId'],
                $this->config['clientSecret']
            )
        );

        // Set log file name
        $logFileName = \Yii::getAlias($this->config['log']['FileName']);
        if ($logFileName) {
            if (!file_exists($logFileName)) {
                if (!touch($logFileName)) {
                    throw new ErrorException('Can\'t create paypal.log file at: ' . $logFileName);
                }
            }
        }

        return $this->_apiContext;
    }

    /**
     * [execTransaction description]
     *
     * Pass in array of data, get Paypal transaction result
     * 
     * @param  array  $paramData [description]
     * @return [type]            [description]
     */
    public function execTransaction(array $paramData)
    {
        if (is_array($this->checkTransactionData($paramData))) {
            // to do collapse multi recursive errors into a string - DJE - 2015-11-28
            \Yii::$app->getSession()->addFlash('warning', current($paramData) . ' missing.');
            return \Yii::$app->response->redirect(\yii::$app->request->referrer);
        }


        $addr = new Address();
        $addr->setLine1(        $paramData['Address']['Line1'] );
        $addr->setLine2(        $paramData['Address']['Line2'] );
        $addr->setCity(         $paramData['Address']['City'] );
        $addr->setCountryCode(  $paramData['Address']['CountryCode'] );
        $addr->setPostalCode(   $paramData['Address']['PostalCode'] );
        $addr->setState(        $paramData['Address']['State'] );

        $card = new CreditCard();
        $card->setNumber(       $paramData['CreditCard']['Number'] );
        $card->setType(         $paramData['CreditCard']['Type'] );
        $card->setExpireMonth(  $paramData['CreditCard']['Month'] );
        $card->setExpireYear(   $paramData['CreditCard']['Year'] );
        $card->setCvv2(         $paramData['CreditCard']['Cvv2'] );
        $card->setFirstName(    $paramData['CreditCard']['FirstName'] );
        $card->setLastName(     $paramData['CreditCard']['LastName'] );
        $card->setBillingAddress($addr);

        $fi = new FundingInstrument();
        $fi->setCreditCard($card);

        $payer = new Payer();
        $payer->setPaymentMethod( isset($paramData['Payer']['Method']) ? $paramData['Payer']['Method'] : 'credit_card' );
        $payer->setFundingInstruments(array($fi));

        $amountDetails = new Details();
        $amountDetails->setSubtotal( isset($paramData['Details']['SubTotal'])   ? $paramData['Details']['SubTotal'] : 0 );
        $amountDetails->setTax(      isset($paramData['Details']['Tax'])        ? $paramData['Details']['Tax']      : 0 );
        $amountDetails->setShipping( isset($paramData['Details']['Shipping'])   ? $paramData['Details']['Shipping'] : 0 );

        $amount = new Amount();
        $amount->setCurrency(   isset($paramData['Amount']['Currency'])    ? $paramData['Amount']['Currency'] : 'USD' );
        $amount->setTotal(      isset($paramData['Amount']['Total'])       ? $paramData['Amount']['Total']    : $this->getTotal($paramData) );
        $amount->setDetails($amountDetails);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription( isset($paramData['Transaction']['Description']) ? $paramData['Transaction']['Description'] : 'Online transaction.' );

        $payment = new Payment();
        $payment->setIntent( isset($paramData['Payment']['Intent']) ? $paramData['Payment']['Intent'] : 'sale' );
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));

        return $payment->create($this->_apiContext);
    }

    /**
     * [checkTransactionData description]
     *
     * @todo  clean this up
     * @param  array  $paramData [description]
     * @return [type]            [description]
     */
    private function checkTransactionData(array $paramData)
    {
        // construct the 'template' data array
        $reqTransactionData['Address']['Line1']         = NULL;
        $reqTransactionData['Address']['City']          = NULL;
        $reqTransactionData['Address']['CountryCode']   = NULL;
        $reqTransactionData['Address']['PostalCode']    = NULL;
        $reqTransactionData['Address']['State']         = NULL;
        $reqTransactionData['CreditCard']['Number']     = NULL;
        $reqTransactionData['CreditCard']['Type']       = NULL;
        $reqTransactionData['CreditCard']['Month']      = NULL;
        $reqTransactionData['CreditCard']['Year']       = NULL;
        $reqTransactionData['CreditCard']['Cvv2']       = NULL;
        $reqTransactionData['CreditCard']['FirstName']  = NULL;
        $reqTransactionData['CreditCard']['LastName']   = NULL;
        $reqTransactionData['Details']['SubTotal']      = NULL;
        
        // compare template to provided data
        $returnData = $this->arrayDiffKeyRecursive($reqTransactionData, $paramData);

        return  (empty($returnData) ? true : $returnData);
    }

    /**
     * [getTotal description]
     * @param  [type] $paramData [description]
     * @return array            [description]
     */
    private function getTotal(array $paramData)
    {
        $returnData = (isset($paramData['Details']['SubTotal'])  ? $paramData['Details']['SubTotal'] : 0)
            + (isset($paramData['Details']['Tax'])               ? $paramData['Details']['Tax']      : 0)
            + (isset($paramData['Details']['Shipping'])          ? $paramData['Details']['Shipping'] : 0);

        return $returnData;
    }

    /**
     * @source  http://php.net/manual/en/function.array-diff-key.php
     * @author Gajus Kuizinas <gk@anuary.com>
     * @version 1.0.0 (2013 03 19)
     */
    private function arrayDiffKeyRecursive (array $arr1, array $arr2)
    {
        $diff = array_diff_key($arr1, $arr2);
        $intersect = array_intersect_key($arr1, $arr2);
        
        foreach ($intersect as $k => $v) {
            if (is_array($arr1[$k]) && is_array($arr2[$k])) {
                $d = $this->arrayDiffKeyRecursive($arr1[$k], $arr2[$k]);
                
                if ($d) {
                    $diff[$k] = $d;
                }
            }
        }
        
        return $diff;
    }

    // Depricated Demo
    
    /**
     * [payDemo description]
     *
     * @depricated 
     * @return [type] [description]
     */
    public function payDemo()
    {
        $addr = new Address();
        $addr->setLine1('52 N Main ST');
        $addr->setCity('Johnstown');
        $addr->setCountryCode('US');
        $addr->setPostalCode('43210');
        $addr->setState('OH');

        $card = new CreditCard();
        $card->setNumber('4417119669820331');
        $card->setType('visa');
        $card->setExpireMonth('11');
        $card->setExpireYear('2018');
        $card->setCvv2('874');
        $card->setFirstName('Joe');
        $card->setLastName('Shopper');
        $card->setBillingAddress($addr);

        $fi = new FundingInstrument();
        $fi->setCreditCard($card);

        $payer = new Payer();
        $payer->setPaymentMethod('credit_card');
        $payer->setFundingInstruments(array($fi));

        $amountDetails = new Details();
        $amountDetails->setSubtotal('15.99');
        $amountDetails->setTax('0.03');
        $amountDetails->setShipping('0.03');

        $amount = new Amount();
        $amount->setCurrency('USD');
        $amount->setTotal('7.47');
        $amount->setDetails($amountDetails);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('This is the payment transaction description.');

        $payment = new Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));

        return $payment->create($this->_apiContext);
    }
}
