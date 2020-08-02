<?php

namespace app\models\base;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "comentario".
 *
 * @property int $id_comentario
 * @property int|null $id_usuario
 * @property int|null $id_autor
 * @property string|null $contenido
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_autor', 'contenido'], 'required'],
            [['contenido'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_comentario' => 'Id Comentario',
            'id_usuario' => 'Id Usuario',
            'contenido' => 'Contenido',
        ];
    }

    public static function guardar($comentario)
    {
        try {
            $comentario->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getByEntityId($entity_id)
    {
        $query = new \yii\db\Query();
        $query->from(['c' => 'comentario'])
            ->select(['c.contenido', 'u.nombre', 'u.apellido'])
            ->innerJoin(['u' => 'user'], '`c`.`id_autor` = `u`.`id_usuario`')
            ->all();
        return $query->all();
    }
}
