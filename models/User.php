<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $password;
   
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            ['email', 'email'],
            ['username', 'unique', 'targetClass' => static::class, 'message' => 'This username has already been taken.'],
        ];
    }

    public static function tableName()
    {
        return 'users';
    }

    // Define any other relevant properties, validations, and behaviors.

    // IdentityInterface methods:

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Implement this method if you have an access token-based authentication.
        // For now, we won't use it, so we'll just return null.
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        // For simplicity, we won't use the authKey in this example.
        // You can implement a more secure method if needed.
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        // For simplicity, we won't use the authKey in this example.
        // You can implement a more secure method if needed.
        return true;
    }
 /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


   


    // Assuming the User model already has a getFriendshipRequests() method to fetch the friendship requests
// public function isFriendRequestSent($recipientId)
// {
//     $requests = $this->getFriendshipRequests()->where(['user_id2' => $recipientId])->all();
//     return !empty($requests);
// }

}
