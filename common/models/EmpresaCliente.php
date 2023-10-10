<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "empresa_cliente".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $ruc
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $estatus
 *
 * @property Productos[] $productos
 * @property User $usuariocreacion0
 */
class EmpresaCliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresa_cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'ruc'], 'required'],
            [['fechacreacion'], 'safe'],
            [['usuariocreacion'], 'integer'],
            [['estatus'], 'string'],
            [['nombre', 'descripcion'], 'string', 'max' => 200],
            [['ruc'], 'string', 'max' => 13],
            [['ruc'], 'unique'],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'ruc' => 'Ruc',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Productos::className(), ['idempresa' => 'id']);
    }

    /**
     * Gets query for [[Usuariocreacion0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }
}
