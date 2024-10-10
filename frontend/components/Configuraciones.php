<?php
namespace frontend\components;
use Yii;
use common\models\Configuraciones as Config;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by PHPSTORM.
 * User: Mario Aguilar
 * Date: 27/09/23
 * Time: 16:16
 */

class Configuraciones extends Component
{
    public function crearCrearconfiguracion($data)
    {
        $response= (Object)["response"=>true,"success"=> false, "data"=>[], "mensaje"=> "" ];
        return $response;
    }

    public function getConfiguracion($id=0,$name='')
    {
        $response= (Object)["response"=>true,"success"=> false, "data"=>[], "mensaje"=> "" ];
        if ($id==0)
        {
            //Búsqueda por Nombre
            $configuracion= Config::find()->where(["isDeleted"=>0,"estatus"=>"ACTIVO","nombre"=>$name])->one();
            if ($configuracion)
            {
                $response->success=true;
                $response->data=$configuracion->valor;
            }else{
                $response->success=true;
                $response->data=$configuracion->valor;
            }
        }else{
            //Búsqueda por ID
            $configuracion= Config::find()->where(["isDeleted"=>0,"estatus"=>"ACTIVO","id"=>$id])->one();
            if ($configuracion)
            {
                $response->success=true;
                $response->data=$configuracion->valor;
            }
        }
        return $response;
    }

    public function eliminarConfiguracion($id)
    {
        $response= (Object)["response"=>true,"success"=> false, "data"=>[], "mensaje"=> "" ];
        return $response;
    }

    public function edicionConfiguracion($data)
    {
        $response= (Object)["response"=>true,"success"=> false, "data"=>[], "mensaje"=> "" ];
        return $response;
    }


}