<?php

namespace app\models\user;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id_usuario
 * @property string|null $nombre
 * @property string|null $apellido
 * @property string $username
 * @property string|null $email
 * @property string|null $password
 * @property string|null $nacimiento
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['nacimiento'], 'safe'],
            [['nombre', 'apellido', 'username', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'username' => 'Usuario',
            'email' => 'Email',
            'password' => 'Clave',
            'nacimiento' => 'Nacimiento',
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne(['id_usuario' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Busca un usuario por su username
     * @param string $username
     * @return User
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id_usuario;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->password === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function registrar($user)
    {
        try {
            $user->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
