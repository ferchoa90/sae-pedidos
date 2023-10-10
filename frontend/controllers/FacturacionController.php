<?php

namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Contactenos;
use common\models\Mesas;
use common\models\Productos;
use common\models\Inventario;
use common\models\Factura;
use common\models\Facturadetalle;
use common\models\Tipodocumento;
use common\models\Tipopago;
use common\models\Clientes;
use common\models\Paginas;
use frontend\models\Provincias;
use backend\components\Facturacion_tipoident;
use backend\components\Facturacion_cliente;
use backend\components\Facturacion_caja;
use backend\components\Sistema_genero;
use backend\components\Botones;
use backend\components\Facturacion_electronica;


/*
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
*/
 

/**

 * Site controller

 */

class FacturacionController extends Controller
{
    
    public function actionCierredecaja()
    {
        $fecha=date("Y-m-d");
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $caja= new Facturacion_caja();
        $caja= $caja->getRecaudacion($fecha);
        return $this->render('cierredecaja',["caja"=>$caja]);
    }

    public function actionCaja()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        return $this->render('caja');
    }

    public function actionprocesoCierrecaja()
    {
        $caja= new Facturacion_caja();
        $caja= $caja->setCierrecaja($_POST);
        //var_dump($caja);
        return json_encode($caja);
    }
}