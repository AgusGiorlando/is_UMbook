<?php

namespace app\models\base;

use yii\base\Model;

class CommentForm extends Model
{
    public $id_usuario;
    public $id_autor;
    public $contenido;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_autor', 'contenido'], 'required'],
        ];
    }

}
