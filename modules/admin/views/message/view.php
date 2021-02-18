<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Message */

$this->title = 'id: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Сообщения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="message-view">

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
            'user_id',
            'text',
            // 'status',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    $result = '<span class="text-';
                    switch ($data->status) {
                        case '0':
                            $result .= 'warning">';
                            $result .= 'Некорректное';
                            break;
                        case '1':
                            $result .= 'success">';
                            $result .= 'Опубликовано';
                            break;
                        default:
                            $result .= 'danger">';
                            $result .= '---';
                    }
                    $result .= '</span>';
                    return $result;
                },
                'format' => 'raw',
            ],
            'created_at',
        ],
    ]) ?>

</div>