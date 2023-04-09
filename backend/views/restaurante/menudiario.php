<?php
use backend\components\Objetos;
use backend\components\Botones;
use backend\components\Bloques;
use backend\components\Grid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use backend\assets\AppAsset;
/* @var $this yii\web\View */

$this->title = "Administración de Menú diario";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;
?>
<div class="row col-12 p-2" >
<?php
echo $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'agregar', 'id' => 'agregar', 'titulo'=>' Agregar', 'link'=>'nuevo', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));

?>
</div>
<?php

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha', 'datareg' => 'fecha', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Producto 1', 'datareg' => 'nproducto1', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Producto 2', 'datareg' => 'nproducto2', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Producto 3', 'datareg' => 'nproducto3', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Producto 4', 'datareg' => 'nproducto4', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    //array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    //array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'menudiarioreg')
        )
);

?>


