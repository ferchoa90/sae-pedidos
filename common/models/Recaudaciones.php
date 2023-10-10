<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recaudaciones".
 *
 * @property int $id
 * @property int|null $idcomprobante
 * @property int $idtipocomprobante
 * @property float $valor
 * @property float $subtotal
 * @property float $iva
 * @property int $idtipopago
 * @property int $idcliente
 * @property string $nombrecliente
 * @property int $idempresa
 * @property string $nombreempresa
 * @property int $naturaleza
 * @property int $isDeleted
 * @property string $fechamovimiento
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string|null $fechaact
 * @property int|null $usuarioact
 * @property string|null $estatus
 */
class Recaudaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recaudaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcomprobante', 'idtipocomprobante', 'idtipopago', 'idcliente', 'idempresa', 'naturaleza', 'isDeleted', 'usuariocreacion', 'usuarioact'], 'integer'],
            [['valor', 'subtotal', 'iva', 'idtipopago', 'nombrecliente', 'nombreempresa', 'fechamovimiento', 'usuariocreacion'], 'required'],
            [['valor', 'subtotal', 'iva'], 'number'],
            [['fechamovimiento', 'fechacreacion', 'fechaact'], 'safe'],
            [['estatus'], 'string'],
            [['nombrecliente'], 'string', 'max' => 200],
            [['nombreempresa'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idcomprobante' => 'Idcomprobante',
            'idtipocomprobante' => 'Idtipocomprobante',
            'valor' => 'Valor',
            'subtotal' => 'Subtotal',
            'iva' => 'Iva',
            'idtipopago' => 'Idtipopago',
            'idcliente' => 'Idcliente',
            'nombrecliente' => 'Nombrecliente',
            'idempresa' => 'Idempresa',
            'nombreempresa' => 'Nombreempresa',
            'naturaleza' => 'Naturaleza',
            'isDeleted' => 'Is Deleted',
            'fechamovimiento' => 'Fechamovimiento',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechaact' => 'Fechaact',
            'usuarioact' => 'Usuarioact',
            'estatus' => 'Estatus',
        ];
    }
}
