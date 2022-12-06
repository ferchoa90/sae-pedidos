<?php
namespace backend\components;
use Yii;
use common\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Roles;
use common\models\Rolespermisos;
use backend\components\Log_errores;
use common\models\Pedidos;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 13/03/21
 * Time: 14:55
 */

class Pedidos_general extends Component
{
    const MODULO='PEDIDOS';

    public function getTipoidentificacion($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Pedidos::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Pedidos::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function setEstado($data){
        //var_dump($data);
        if ($data){
            $model=Pedidos::find()->where(["id"=>$data["id"]])->one();
            $mensaje="";
            $nuevoestado="NUEVO";
            switch ($data["nuevoestado"]) {
                case 1:
                    $mensaje="Pedido Aceptado";
                    $nuevoestado="ACEPTADO";
                    break;
                case 2:
                    $mensaje="Preparando pedido";
                    $nuevoestado="PREPARANDO";
                    break;
                case 3:
                    $mensaje="Pedido en camino";
                    $nuevoestado="EN CAMINO";
                    break;

                case 4:
                    $mensaje="Pedido Entregado";
                    $nuevoestado="ENTREGADO";
                    break;
                case 5:
                    $mensaje="Pedido listo";
                    $nuevoestado="LISTO";
                    break;
                case 6:
                    $mensaje="Pedido servido";
                    $nuevoestado="SERVIDO";
                    break;
                
                case 7:
                    $mensaje="Pedido Cancelado";
                    $nuevoestado="CANCELADO";
                    break;
                
                default:
                    $mensaje="";
                    break;
            }
            if ($model){
                $model->estatuspedido=$nuevoestado;
                $model->usuarioact=Yii::$app->user->identity->id;
                $model->fechaact=date('Y-m-d H:i:s');
            }else{
                $this->callback(1,$data->id,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al recibir data.","tipo"=>"error", "success"=>false);
            }
            
            if ($model->save())
            {
                return array("response" => true, "id" => $model->id, "mensaje"=> $mensaje,"tipo"=>"success", "success"=>true);
            }else{
                $this->callback(1,$data->id,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al recibir la data.","tipo"=>"error", "success"=>false);
            }

        }else{
            return array("response" => true, "id" => 0, "mensaje"=> "Error al recibir data.","tipo"=>"error", "success"=>false);
        }
    }
 
    public function getSelect()
    {
        $clientes = Pedidos::find()->where(["isDeleted" => 0])->orderBy(["fechacreacion" => SORT_DESC])->all();
        //var_dump($clientes);
        $clientesArray=array();
        $cont=0;
        foreach ($clientes as $key => $value) {
            if ($cont==0){ $clientesArray[$cont]["value"]="Seleccione el pedido"; $clientesArray[$cont]["id"]=-1; $cont++; }
            $clientesArray[$cont]["value"]=$value->nombre;
            $clientesArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $clientesArray;

    }

    public function Nuevo($data)
    {
        //$date = date("Y-m-d H:i:s");
        $idusuario=0;
        $idmodulo=0;
        $model= new Pedidos;
        $result=false;
        if ($data):
            $model->nombre=$data['nombre']; 
            $model->usuariocreacion=Yii::$app->user->identity->id;
            $model->estatus="ACTIVO";
            $model->isDeleted=0;
            if ($model->save()) {
                $idusuario=$model->id;
                $error=false;
                //$this->callback(1,$idusuario,$model->errors);
                return array("response" => true, "id" => $model->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$idusuario,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Factura_tipoident ",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editar($data)
    {
        $id=0;
        $result=false;
        if ($data):
            $model= Pedidos::find()->where(["id"=>$data['id']])->one();
            $model->nombre=$data['nombre'];
            $model->usuarioact=Yii::$app->user->identity->id;
            $model->fechaact= date("Y-m-d H:i:s");
            if ($model->save()) {
                $error=false;
                return array("response" => true, "id" => $model->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Factura_tipoident -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editarantecedentes($data)
    {
        $id=0;
        $result=false;
        if ($data):
            $model= Pedidos::find()->where(["id"=>$data['idpaciente']])->one();
            $model->antecedentesp=$data['antecedentesp'];
            $model->antecedenteso=$data['antecedenteso'];
            $model->antecedentesf=$data['antecedentesf'];
            $model->enfermedada=$data['enfermedada'];
            $model->antecedentesf=$data['antecedentesf'];
            $model->usuarioact=Yii::$app->user->identity->id;
            $model->fechaact= date("Y-m-d H:i:s");
            if ($model->save()) {
                $error=false;
                return array("response" => true, "id" => $model->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Factura_tipoident -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
    }


    public function Eliminar($id)
    {
        //$date = date("Y-m-d H:i:s");
        $result=false;
        if ($id):
            //$data = $usuario;
            $data= Pedidos::find()->where(["id"=>$id])->one();
            $data->isDeleted=1;
            if ($data->save()) {
                $error=false;
                return array("response" => true, "id" => $data->id, "mensaje"=> "Registro eliminado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$data->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO ID";
            $log->Nuevo(self::MODULO." :: Factura_tipoident -> eliminar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
    }

    public function callback($tipo,$id,$error)
    {
        switch ($tipo) {
            case 1:


                $log= new Log_errores;
                $observacion="ID: ".$id;
                $log->Nuevo("USUARIO ",$error,$observacion,0,Yii::$app->user->identity->id);
                //return true;
                break;

            default:
                # code...
                break;
        }
    }



}