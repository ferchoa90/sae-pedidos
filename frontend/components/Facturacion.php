<?php
namespace frontend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by PHPSTORM.
 * User: Mario Aguilar
 * Date: 27/09/23
 * Time: 16:16
 */

class Facturacion extends Component
{
    public function crearFactura($data)
    {
        $response= (Object)["response"=>true,"success"=> false, "data"=>"", "mensaje"=> "", "conexion"=>null];
        $response->conexion= $this->conexion();
        return $response;
    }

    public function getFactura($data)
    {
        $response= (Object)["response"=>true,"success"=> false, "data"=>"", "mensaje"=> "", "conexion"=>null];
        $response->conexion= $this->conexion();
        return $response;
    }

    public function eliminarFactura($id)
    {
        $response= (Object)["response"=>true,"success"=> false, "data"=>"", "mensaje"=> "", "conexion"=>null];
        $response->conexion= $this->conexion();
        return $response;
    }

    public function edicionFactura($id)
    {
        $response= (Object)["response"=>true,"success"=> false, "data"=>"", "mensaje"=> "", "conexion"=>null];
        $response->conexion= $this->conexion();
        return $response;
    }


}