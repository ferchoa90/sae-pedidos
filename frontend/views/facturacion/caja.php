<?php
/* @var $this yii\web\View */
use backend\components\Objetos;
use backend\components\Botones;
use backend\components\Bloques;
use backend\components\Grid;
use yii\helpers\Url;
 
$this->title = 'SAE - Sistema Administrativo Contable';
$grid= new Grid;
$botones= new Botones;
?>
    <div class="container-fluid p-0 ">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800">Caja</h1>
      </div>
      <?php

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha', 'datareg' => 'nombres', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Tipo', 'datareg' => 'cedula', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Valor', 'datareg' => 'apellidos', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Usuario C.', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Fecha C.', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'doctoresreg')
        )
);

?>
  <!-- End of Main Content -->
</div>
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

  



  <!-- Bootstrap core JavaScript-->

  <script src="<?= URL::base() ?>/vendor/jquery/jquery.min.js"></script>

  <script src="<?= URL::base() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  

  <!-- Core plugin JavaScript-->

  <script src="<?= URL::base() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

  

  

  <!-- Custom scripts for all pages-->

  <script src="<?= URL::base() ?>/js/sb-admin-2.min.js"></script>

  

  <!-- Page level plugins -->

  <script src="<?= URL::base() ?>/vendor/chart.js/Chart.min.js"></script>

  

  <!-- Page level custom scripts -->

  <script src="<?= URL::base() ?>/js/demo/chart-area-demo.js"></script>

  <script src="<?= URL::base() ?>/js/demo/chart-pie-demo.js"></script>

  

  <script src="<?= URL::base() ?>/js/plugins/bootstrap3-typeahead.min.js"></script>

  <script src="<?= URL::base() ?>/js/print.min.js"></script>



  

 
  
</body>



</html>
