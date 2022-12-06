<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 12/11/21
 * Time: 10:16
 */

class Pedido extends Component
{
    public function getEstatuspedido($estatuspedido)
    {
        switch ($estatuspedido) {
            case 'NUEVO':
                return "Gestionando su orden";
                break;

            case 'ACEPTADO':
                return "Orden aceptada";
                break;
            case 'PREPARANDO':
                return "Estamos preparando su orden";
                break;
            case 'EN CAMINO':
                return "Su orden está en camino";
                break;
            case 'LISTO':
                return "Su orden está lista para servir";
                break;
            case 'SERVIDO':
                return "Buen provecho!";
                break;
            case 'ENTREGADO':
                return "Su orden ha sido entregada, buen provecho!";
                break;
            case 'CANCELADO':
                return "Lo sentimos, orden cancelada!";
                break;

            default:
                return "";
                break;
        }
                return "Estatus no identificado";
    }

    public function getListapedidos($idpedido,$tipo)
    {
        switch ($tipo) {
            case 'grid':
                return $this->consultarPedidos();
                break;

            default:
                # code...
                break;
        }
    }

    private function consultarPedidos()
    {
        return "Pedido 1";
    }

    public function getSeparador($clase='',$estilo='', $color='')
    {
        switch ($color) {
            case !'':
                return '<hr style="color: '.$color.'" />';
                break;

            default:
                return '<hr style="color: #0056b2;" />';
                break;
        }
    }
}