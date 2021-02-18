<?php

namespace app\models;

use yii\base\Model;


class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;



    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_repeat'], 'required'],
            [['username', 'email', 'password', 'password_repeat'], 'trim'],
            [['username'], 'string', 'min' => 2, 'max' => 50],
            [['username'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'username', 'message' => 'Уже занято!'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email', 'message' => 'Уже занято!'],
            [['password'], 'string', 'min' => 2, 'max' => 50],
            [['email'], 'email'],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают!'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_repeat' => 'Подтверждение пароля',
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPasswordHash($this->password);
        // debug($user->save(), 1);
        // $user->create();
        return $user->save();
    }
}
