<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use app\components\GlobalData;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Almuerzos';
$this->params['breadcrumbs'][] = ['label' => 'Restaurante', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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
                <span class="bg-red">10 Feb. 2014</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fa fa-cutlery bg-red"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                  <h3 class="timeline-header"><a href="#">Menú del día</a></h3>

                  <div class="timeline-body">
                    <div class="card-body">
                        <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Create first milestone</h5>
                            <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#5</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                            </div>
                        </div>
                        </div>
                    </div>
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-primary btn-sm">Agregar</a>
                    <a class="btn btn-success btn-sm">Guardar</a>
                    <!--<a class="btn btn-danger btn-sm">Delete</a>-->
                  </div>
                </div>
              </div>
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
  </div>
  <!-- /.content-wrapper -->