<?php

namespace backend\controllers;
use app\components\GlobalData;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use common\models\Productos;
use common\models\Pedidos;
use common\models\Pedidosdetalle;
use yii\db\Query;
use backend\components\Botones;
use backend\components\Pedidos_general;
use backend\models\User;
use common\models\Menurestaurante;

/**
 * Default controller for the `admin` module
 */
class RestauranteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'view', 'delete', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'view', 'delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPedidos()
    {
      $date=date('Y-m-d');
        $pedidos =  Pedidos::find()->where(['estatus' =>  "ACTIVO"])->andWhere(['between', 'fechacreacion', $date.' 00:00:00', $date.' 23:59:59' ])->orderBy(["fechacreacion" => SORT_DESC])->all();
       // $pedidosuser= array();
        $pedidosuser["cabecera"]=new \stdClass();
        //$pedidosuser["detalle"]=new \stdClass();
       
        //$pedidosuser["cabecera"]->subtotal = NULL;
        //$pedidosuser["cabecera"]= array();
       
        $cont=0;
        $combo=false;
       //die(var_dump($pedidos));

        foreach ($pedidos as $key => $valueped) {

            $pedidosDetalle= Pedidosdetalle::find()->where(['idpedido' => $valueped->id])->orderBy(["id" => SORT_ASC])->all();
            $pedidosuser["cabecera"]->subtotal=$valueped->subtotal;
            $pedidosuser["cabecera"]->iva=$valueped->iva;
            $pedidosuser["cabecera"]->total=$valueped->total;
            $pedidosuser["cabecera"]->recargo=$valueped->recargo;
            $idpedido=$valueped->id;
            
            //if ($pedidosDetalle->combo!=0){  }
            //$pedidosuser["detalle"][$valueped->id][]=new \stdClass();
            //die($idpedido);
            //$pedidosuser["detalle"][$valueped->id][$cont]= new \stdClass();
            
            foreach ($pedidosDetalle as $key => $valuepedet) {
                // die(var_dump($valuepedet->nombreprod));
                $pedidosuser["detalle"][$valueped->id][$cont]["nombre"]=$valuepedet->nombreprod;
                $pedidosuser["detalle"][$valueped->id][$cont]["descripcion"]=$valuepedet->descripcion;
                $pedidosuser["detalle"][$valueped->id][$cont]["cantidad"]=$valuepedet->cantidad;
                $pedidosuser["detalle"][$valueped->id][$cont]["subtotal"]=$valuepedet->subtotal;
                $pedidosuser["detalle"][$valueped->id][$cont]["descuento"]=$valuepedet->descuento;
                $pedidosuser["detalle"][$valueped->id][$cont]["recargo"]=$valuepedet->recargo;
                $pedidosuser["detalle"][$valueped->id][$cont]["iva"]=$valuepedet->iva;
                $cont++;
            }
        }


        return $this->render('pedidos', [
            'pedidos' => $pedidos,
            'pedidosdetalle' => $pedidosuser,
        ]);
    }



    public function actionAlmuerzos()
    {
        return $this->render('almuerzos');
    }
    public function actionMenudiario()
    {
        return $this->render('menudiario');
    }

    public function actionFormeditarestatuspedido()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        //die(var_dump($_FILES));
        $data= new Pedidos_general;
        $data= $data->setEstado($_POST);
        $response=$data;
        return json_encode($response);

    }

    public function actionAlmuerzosreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "productos";
        $model = Productos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        $botones= new Botones;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                $arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                if ($id == "id") {
                    $arrayResp[$key]['num'] = $text;

                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombreproducto") || ($id == "descripcion")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "imagen") || ($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        
        return json_encode($arrayResp);
    }
 
    public function actionMenudiarioreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "productos";
        
        $fechas = Menurestaurante::find()->where(['isDeleted' => '0'])->groupBy(["fechavisual"])->all();
        //$arrayResp[] = array();
        $count = 1;
        $botones= new Botones;

         
        $index=1;
        foreach ($fechas as $key => $value) {
            $model = Menurestaurante::find()->where(['isDeleted' => '0','fechavisual'=>$value->fechavisual])->orderBy(["fechacreacion" => SORT_DESC])->all(); 
            $contenidoMenu= array();
            //$arrayResp[$value->fechavisual]=array();
            $producto1=0;$producto2=0;$producto3=0;$producto4=0;
            $nproducto1="";$nproducto2="";$nproducto3="";$nproducto4="";
            foreach ($model as $keyM => $valueM) {
                $arrayResp[$key]["num"]= $index;
                //array_push($arrayResp[$value->fechavisual],["nombre"=>$valueM->nombre,"id_producto1"=>$valueM->producto1,"nombre_producto1"=>$valueM->producto10->nombreproducto,"id_producto2"=>$valueM->producto2,"nombre_producto2"=>$valueM->producto20->nombreproducto,"id_producto3"=>$valueM->producto3,"nombre_producto3"=>$valueM->producto30->nombreproducto,"id_producto4"=>$valueM->producto4,"nombre_producto4"=>$valueM->producto40->nombreproducto]);
                if ($valueM->producto1 && $valueM->producto2 && $valueM->producto3 && $valueM->producto4 ){ 
                    $producto1=$valueM->producto1;$nproducto1=$valueM->producto10->nombreproducto; 
                    $producto2=$valueM->producto1;$nproducto2=$valueM->producto20->nombreproducto; 
                    $producto3=$valueM->producto1;$nproducto3=$valueM->producto30->nombreproducto; 
                    $producto4=$valueM->producto1;$nproducto4=$valueM->producto40->nombreproducto; 
                    $arrayResp[$key]["fecha"]= $value->fechavisual;
                    $arrayResp[$key]["producto1"]= $producto1;
                    $arrayResp[$key]["nproducto1"]= $nproducto1;
                    $arrayResp[$key]["producto2"]= $producto2;
                    $arrayResp[$key]["nproducto2"]= $nproducto2;
                    $arrayResp[$key]["producto3"]= $producto3;
                    $arrayResp[$key]["nproducto3"]= $nproducto3;
                    $arrayResp[$key]["producto4"]= $producto4;
                    $arrayResp[$key]["nproducto4"]= $nproducto4;
                    
                }else{
                    if ($valueM->producto1 && $valueM->producto2 && $valueM->producto3 ){ 
                        $producto1=$valueM->producto1;$nproducto1=$valueM->producto10->nombreproducto; 
                        $producto2=$valueM->producto1;$nproducto2=$valueM->producto20->nombreproducto; 
                        $producto3=$valueM->producto1;$nproducto3=$valueM->producto30->nombreproducto; 
                        $producto4="";$nproducto4=""; 
                        $arrayResp[$key]["fecha"]= $value->fechavisual;
                        $arrayResp[$key]["producto1"]= $producto1;
                        $arrayResp[$key]["nproducto1"]= $nproducto1;
                        $arrayResp[$key]["producto2"]= $producto2;
                        $arrayResp[$key]["nproducto2"]= $nproducto2;
                        $arrayResp[$key]["producto3"]= $producto3;
                        $arrayResp[$key]["nproducto3"]= $nproducto3;
                        $arrayResp[$key]["producto4"]= $producto4;
                        $arrayResp[$key]["nproducto4"]= $nproducto4;
                        
                    }
                }
            }
            $index++;

            
            
        }
        //die(json_encode($arrayResp,JSON_UNESCAPED_UNICODE));
        return json_encode($arrayResp);
    }
 

}

