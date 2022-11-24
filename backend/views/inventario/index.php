<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Administración de Inventario";
$this->params['breadcrumbs'][] = $this->title;

$flagIndex = 'false';

if (strpos($_SERVER['REQUEST_URI'], 'index') !== false) {
    $flagIndex = 'true';
}

$urls = explode("/", str_replace('/index', '', $_SERVER['REQUEST_URI']));
$partes = count($urls) - 1;

?>
    <!-- ========================================================================================================== -->
    <!-- Trvia box -->
    <input type="hidden" id="urlflag" value="<?= $flagIndex ?>">
    <input type="hidden" id="urlself" value="<?= $urls[$partes] ?>">
    <input type="hidden" id="token" value="<?= Yii::$app->request->getCsrfToken() ?>">
    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-plus']) . '&nbsp; Agregar Stock', ['nuevo'], ['class' => 'btn btn-primary']) ?>
<br>
<br>
    <div class="box">
        <div class="box-body">
            <div class="box-body">
                <table id="table_slider" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="tableheader">
                        <th>#</th>
                        <th>Título</th>
                        <th>Imagen</th>
                        <th>Stock</th>
                        <th>PVP Final</th>
                        <th>PVP Men.</th>
                        <th>Código Art.</th>
                        <th>Sucursal</th>
                        <th>Tipo</th>
                        <th>Presentacion</th>
                        <th>Color</th>
                        <th>Calidad</th>
                        <th>Usuario Creación</th>
                        <th>Fecha Creación</th>
                        <th>Estado</th>
                        <th>&nbsp;Acciones&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
   
<?php
//$this->registerJsFile(URL::base() . "/js/class/inventarioAdmin.js", ['depends' => [ \yii\bootstrap\BootstrapPluginAsset::className()]
//]);








