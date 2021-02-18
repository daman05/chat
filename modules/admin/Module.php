<?php

namespace app\modules\admin;

use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'except' => ['error'],
                // 'denyCallback' => function ($rule, $action) {
                //     throw new \yii\web\NotFoundHttpException('Страница не найдена.');
                // },
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if (isset(\Yii::$app->user->identity->isAdmin) && \Yii::$app->user->identity->isAdmin == 1) {
                                return true;
                            }
                        }
                    ],
                ],
            ],
        ];
    }
}
