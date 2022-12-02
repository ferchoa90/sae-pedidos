<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use app\components\GlobalData;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = ['label' => 'Restaurante', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//var_dump($pedidos);
$urlpost='formeditarestatuspedido';



?>

<div class="col-12">
 

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red"><?= date('Y-m-d') ?></span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <?php foreach ($pedidos as $key => $value) { 
                $btncancelar=""; $btnpedido="";
                switch ($value->estatuspedido) {
                    case 'NUEVO':
                        $estilo="primary";
                        $btnpedido="<button class=\"btn btn-primary btn-sm\" onclick=\"javascript:estatusPedido(this,'".$value->id."','1');\">ACEPTAR</button>";
                        $btncancelar="<button class=\"btn btn-info btn-sm\" onclick=\"javascript:estatusPedido(this,'".$value->id."','7');\">CANCELAR</button>";
                        break;
                    case 'ACEPTADO':
                        $estilo="success";
                        $btnpedido="<button class=\"btn btn-success btn-sm\" onclick=\"javascript:estatusPedido(this,'".$value->id."','2');\">PREPARAR</button>";
                        $btncancelar="<button class=\"btn btn-info btn-sm\" onclick=\"javascript:estatusPedido(this,'".$value->id."','7');\">CANCELAR</button>";
                        break;
                    case 'PREPARANDO':
                        $estilo="secondary";
                        $btnpedido="<button class=\"btn btn-secondary btn-sm\" onclick=\"javascript:estatusPedido(this,'".$value->id."','3');\">A ENTREGAR</button>";
                        $btncancelar="<button class=\"btn btn-info btn-sm\" onclick=\"javascript:estatusPedido(this,'".$value->id."','7');\">CANCELAR</button>";
                        break;
                    
                    case 'EN CAMINO':
                        $estilo="info";
                        $btnpedido="<button class=\"btn btn-success btn-sm\" onclick=\"javascript:estatusPedido(this,'".$value->id."','4');\">ENTREGADO</button>";
                        $btncancelar="<button class=\"btn btn-info btn-sm\" onclick=\"javascript:estatusPedido(this,'".$value->id."','7');\">CANCELAR</button>";
                        
                        break;
                    case 'ENTREGADO':
                        $estilo="success";
                        break;

                    default:
                        # code...
                        break;
                }   
                
              ?>
              <div>
                <i class="fa fa-cutlery bg-red"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> <?= substr($value->fechacreacion,11,8)?></span>
                  <h3 class="timeline-header"><a href="#"># <?= $value->id ?> : <?= $value->idcliente0->nombres.' '. $value->idcliente0->apellidos ?></a> - <b>Dirección :</b> <?= $value->idcliente0->cliente->direccion ?> | <span class="badge badge-<?=$estilo ?>"> <?= $value->estatuspedido ?></span></h3>

                  <div class="timeline-body">
                    
                  <div id="accordion">
                                <div class="card pedidos" style="padding:10px">
                              
                                            <!--Table-->
                                            <table class="table table-striped w-100">
                                                <!--Table head-->
                                                <thead>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <th>Nombre</th>
                                                    <th>Descripcion</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <!--Table head-->
                                                <!--Table body-->
                                                <tbody>
                                                <?php $cont=0; $subtotal=0; $total=0;$recargo=0; ?>
                                                <?php foreach ($pedidosdetalle["detalle"][$value->id] as $key => $valuedet) { ?>

                                                    <?php if ($cont % 2 ==0){ $style="table-info2"; }else{ $style=""; } ?>
                                                    <?php $subtotal+=$valuedet["subtotal"]*$valuedet["cantidad"]; ?>
                                                    <?php $recargo+=$valuedet["recargo"]?>
                                                    <tr class="<?=$style ?>" style="">
                                                        <td scope="row"><?= $valuedet["cantidad"] ?></th>
                                                        <td><?= $valuedet["nombre"] ?></td>
                                                        <td><?= $valuedet["descripcion"] ?></td>
                                                        <td>$ <?= number_format($valuedet["subtotal"]*$valuedet["cantidad"],2) ?></td>
                                                    </tr>

                                                    <?php $cont++; ?>
                                                <?php }?>
                                                <?php $total=$subtotal + $recargo + $value->recargo; ?>

                                                <tr class="" style="border-top: 1px solid darkred;">
                                                    <td colspan="3" style=" text-align:right;"><b>SUBTOTAL</b></td>
                                                    <td><b>$ <?= number_format($subtotal,2);  ?></b></td>
                                                </tr>
                                                <tr class="" >
                                                    <td colspan="3"  style=" text-align:right;"><b>UTENSILIOS + ENVIO</b></td>
                                                    <td><b>$ <?= number_format($recargo+$value->recargo,2);  ?></b></td>
                                                </tr>
                                                <tr class="" >
                                                    <td colspan="3"  style=" text-align:right;"><b>TOTAL</b></td>
                                                    <td><b>$ <?= number_format($total,2);  ?></b></td>
                                                </tr>
                                                </tbody>
                                                <!--Table body-->
                                            </table>
                                            <!--Table-->
                                </div>
                            </div>
                            <div class="timeline-footer">
                                <?= $btnpedido ?>
                                <?= $btncancelar ?>
                                <!--<a class="btn btn-danger btn-sm">Delete</a>-->
                            </div>
                  </div>
                 
                </div>
              </div>
              <?php } ?>
              <!-- END timeline item -->
               
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
    <?php $form = ActiveForm::begin(['id'=>'frmDatos']); ?>
        <input type="hidden" id="token" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">        
    <?php ActiveForm::end(); ?>
  </div>
  <!-- /.content-wrapper -->
  <script>
    function estatusPedido(objeto,id,estado)
    {
        $(objeto).attr('disabled','disabled');
        if (typeof(id)== "undefined")
        {
            notificacion("Error al enviar la información","error");
            $(objeto).attr('disabled','');
            return false;
        }
        if (estado==1 || estado==2 || estado==3 || estado==4 || estado==5 || estado==7) //ACEPTA EL PEDIDO
        {
            if (gestionarPedido(id,estado)===true){
                $(objeto).removeAttr('disabled');
              
                //return true;
            }else{
                return false;
            }
        }
    }
    function gestionarPedido(id,estado)
    {
        console.log(id+':'+estado)
        loading(1);
        var form    = $('#frmDatos');
        $.ajax({
            url: '<?= $urlpost ?>',
            async: 'false',
            cache: 'false',
            type: 'POST',
            data: form.serialize()+ '&id=' + id+ '&nuevoestado=' + estado,
            success: function(response){
            data=JSON.parse(response);
            //console.log(response);
            //console.log(data.success);
            if ( data.success == true ) {
                // ============================ Not here, this would be too late
                notificacion(data.mensaje,data.tipo);
                //$this.data().isSubmitted = true;
                //$('#frmDatos')[0].reset();
                
                setTimeout(() => {
                    loading(0);    
                    window.location.reload();
                }, "1500")
                return true;
            }else{
                loading(0);
                return false;
                notificacion(data.mensaje,data.tipo);
            }
        }
        });
        
    }

    
  </script>