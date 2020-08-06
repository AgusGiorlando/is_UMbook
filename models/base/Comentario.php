<?php

namespace app\models\base;

/**
 * This is the model class for table "comentario".
 *
 * @property int $id_comentario
 * @property int $id_usuario
 * @property int $id_autor
 * @property int|null $id_foto 
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

    public static function borrar($id_comentario)
    {
        try {
            $comentario = self::findOne([
                'id_comentario' => $id_comentario
            ]);

            $comentario->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getByUsuarioId($id_usuario)
    {
        $query = new \yii\db\Query();
        $query->from(['c' => 'comentario'])
            ->select(['c.id_comentario', 'c.contenido', 'c.id_autor', 'u.nombre', 'u.apellido'])
            ->innerJoin(['u' => 'user'], '`c`.`id_autor` = `u`.`id_usuario`')
            ->where(['c.id_usuario' => $id_usuario])
            ->all();
        return $query->all();
    }
}
