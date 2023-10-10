<?php
/* @var $this yii\web\View */
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use backend\components\Contenido;
use backend\components\Modal;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\components\Grid;
use yii\web\View;
 
$this->title = 'SAE - Sistema Administrativo Contable';
?>
 
<?php

$grid= new Grid;
$botones= new Botones;
//$this->title = "Editar profesion";
//$this->params['breadcrumbs'][] = $this->title;

$urlpost='formcierrecaja';

var_dump($caja[0]);
 
//$totalEfectivo= number_format($caja[0]["data"][0]["subtotalEfectivo"],2);
$objeto= new Objetos;
$div= new Bloques;

 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'oculto', 'nombre'=>'id', 'id'=>'id', 'valor'=>$data->id, 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'totalefectivo', 'id'=>'totalefectivo', 'valor'=>'0.00','etiqueta'=>'T. Efectivo: ', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false, 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'totaltarjeta', 'id'=>'totaltarjeta', 'valor'=>'0.00','etiqueta'=>'T. Tarjeta: ', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false, 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'totalcredito', 'id'=>'totalcredito', 'valor'=>'0.00','etiqueta'=>'T. Créditos: ', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false, 'col'=>'col-6 col-md-3', 'adicional'=>''),
       // array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'totaltransferencia', 'id'=>'totaltransferencia', 'valor'=>'0.00','etiqueta'=>'T. Transferencias: ', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false, 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'totalfaltante', 'id'=>'totalfaltante', 'valor'=>'0.00','etiqueta'=>'T. Transferencias: ', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false, 'col'=>'col-6 col-md-3', 'adicional'=>''),

    ),true
);

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'getModal();' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'regresar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$contenidoClass= new contenido;
if ($data->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
$estatus='<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$data->estatus.'</span>';
$contenido2=$contenidoClass->getContenidoArrayr(
    array(
        array('tipo'=>'div','nombre'=>'nombre', 'id' => 'nombre', 'titulo'=>'Estatus:&nbsp;&nbsp;','contenido'=>$estatus, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'div','nombre'=>'fechac', 'id' => 'fechac', 'titulo'=>'Fecha C:','contenido'=>$data->fechacreacion, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'div','nombre'=>'usuarioc', 'id' => 'usuarioc', 'titulo'=>'Usuario C:','contenido'=>$data->usuariocreacion0->username, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'div','nombre'=>'fechaa', 'id' => 'fechaa', 'titulo'=>'Fecha M:','contenido'=>$data->fechaact, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'div','nombre'=>'usuarioa', 'id' => 'usuarioa', 'titulo'=>'Usuario M:','contenido'=>$data->usuarioactualizacion0->username, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
    )
);
$data=$contenidoClass->getContenidoArrayr(
  array(
      //array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
      array('tipo'=>'config','clase'=>'', 'estilo'=>'border: 1px solid #429EEA;', 'color'=>''),
      array('tipo'=>'titulo','nombre'=>'tot', 'id' => 'tot', 'titulo'=>'Facturación:&nbsp;','contenido'=>'', 'col'=>'col-12 col-md-12','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'facturas','adicional'=>''),
      array('tipo'=>'div','nombre'=>'tot1', 'id' => 'tot1', 'titulo'=>'Fecha Cierre:&nbsp;','contenido'=>$caja[0]["data"][0]["fechacierre"], 'col'=>'col-6 col-md-4','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'','adicional'=>''),
      array('tipo'=>'div','nombre'=>'tot2', 'id' => 'tot2', 'titulo'=>'Total de Facturas:&nbsp;','contenido'=>$caja[0]["data"][0]["numerofacturas"], 'col'=>'col-6 col-md-4','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'','adicional'=>''),
      array('tipo'=>'div','nombre'=>'tot3', 'id' => 'tot3', 'titulo'=>'Total de Productos:&nbsp;','contenido'=>$caja[0]["data"][0]["numeroproductos"], 'col'=>'col-6 col-md-4','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'','adicional'=>''),
      array('tipo'=>'div','nombre'=>'tot4', 'id' => 'tot4', 'titulo'=>'Total Recaudado:&nbsp;','contenido'=>number_format($caja[0]["data"][0]["totalrecaudado"],2), 'col'=>'col-6 col-md-4','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'','adicional'=>''),
      array('tipo'=>'div','nombre'=>'tot5', 'id' => 'tot5', 'titulo'=>'Rec. Efectivo:&nbsp;','contenido'=>number_format($caja[0]["data"][0]["totalEfectivo"],2), 'col'=>'col-6 col-md-4','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'','adicional'=>''),
      array('tipo'=>'div','nombre'=>'tot6', 'id' => 'tot6', 'titulo'=>'Rec. Tarjetas:&nbsp;','contenido'=>number_format($caja[0]["data"][0]["totalTarjeta"],2), 'col'=>'col-6 col-md-4','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'','adicional'=>''),
      array('tipo'=>'div','nombre'=>'tot7', 'id' => 'tot7', 'titulo'=>'Rec. Créditos:&nbsp;','contenido'=>number_format($caja[0]["data"][0]["totalCredito"],2), 'col'=>'col-6 col-md-4','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'','adicional'=>''),
      array('tipo'=>'div','nombre'=>'tot8', 'id' => 'tot8', 'titulo'=>'Rec. Transferencias:&nbsp;','contenido'=>number_format($caja[0]["data"][0]["totalTransferencia"],2), 'col'=>'col-6 col-md-4','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'','adicional'=>''),
      array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''), 
  )
);
//var_dump($objeto);
?>
 
<div class="container-fluid p-0 ">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h5 mb-0 text-gray-800">Cierre de caja</h1>
      </div>
      <?php
      $form = ActiveForm::begin(['id'=>'frmDatos']);
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos del Cierre','clase'=>'col-md-12 col-xs-12 p-0','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$data.$contenido.$botonC),
       // array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 pr-0','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),

    )
);
ActiveForm::end();
$modal= New Modal;
$modalConfirmar= $modal->getModal('okcancelhtml','modalConfirmar','modalConfirmar', 'Confirmación', '¿Esta seguro de hacer el cierre de caja?, esta acción no es reversible <br>', '', '', '','width: 90%;','cerrarCaja()','$(\'#modalConfirmar\').modal(\'hide\');','' );
echo $modalConfirmar;
?>

 


</div>

<script>

$(document).ready(function(){
  jQuery.noConflict();
     // $('#modalConfirmar').modal('show');     
    });
function getModal()
  {
    console.log("filtro");
    $('#modalConfirmar').modal('show');
  }

function cerrarCaja()
  {
    //console.log("funcion cerrarCaja");
   
      $('#modalAperturar').modal('hide');
                
                loading(1);
                $.ajax({
                    url: '/frontend/web/site/procesoCierrecaja',
                    async: 'false',
                    cache: 'false',
                    type: 'POST',
                    data:{ '_csrf-frontend':'<?=Yii::$app->request->getCsrfToken()?>'},
                    success: function(response){
                    data=JSON.parse(response);
                    console.log(response);
                    console.log(data.success);
                    if ( data.success == true ) {
                        loading(0);
                        // ============================ Not here, this would be too late
                        notificacion(data.mensaje,data.tipo);
                        //$this.data().isSubmitted = true;
                        //$('#frmDatos')[0].reset();
                        //setTimeout(facturar, 700);
                        return true;
                    }else{
                        loading(0);
                        notificacion(data.mensaje,data.tipo);
                    }
                }
            });
  }

  function facturar()
  {
    //console.log('cancelado');
    location.href='/frontend/web/site/facturar';
  }
</script>

<?php
$this->registerJs("

$(document).ready(function(){
  
  //$('#modalAperturar').modal('show');

});
    ",

    View::POS_END,
    'subjects'
);

?>

<style>
.vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  display: flex;
  align-items: center;
}
.tableFixHead          { overflow-y: auto; height: 400px; }
.tableFixHead thead th { position: sticky; top: 0; }
/* Just common table stuff. Really. */
table  { border-collapse: collapse; width: 100%; }
th, td { padding: 8px 16px; }
th     { background:#eee; }
#cliente
{
  -moz-appearance:textfield;
  -webkit-appearance: none; 
}
#cliente::-webkit-inner-spin-button, 
#cliente::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
  </style>
 