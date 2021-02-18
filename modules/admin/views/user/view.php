<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = 'Пользователь id: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            // 'password_hash',
            // 'auth_key',
            'created_at',
            'updated_at',
            // 'isAdmin',
            [
                'attribute' => 'isAdmin',
                'value' => function ($data) {
                    $result = '<span class="text-';
                    switch ($data->isAdmin) {
                        case '1':
                            $result .= 'warning">';
                            $result .= 'да';
                            break;
                        default:
                            $result .= 'success">';
                            $result .= 'нет';
                    }
                    $result .= '</span>';
                    return $result;
                },
                'format' => 'raw',

            ]
        ],
    ]) ?>

</div>