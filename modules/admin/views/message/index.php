<?php

use app\modules\admin\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a('Create Message', ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'user_id',
            [
                'attribute' => 'user_id',
                'value' => function ($data) {
                    $name = User::find()->select('username')->where(['id' => $data->user_id])->one();
                    // debug($data, 1);
                    return $name->username;
                }
            ],
            'text',
            // 'status',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    $result = '<span class="text-';
                    switch ($data->status) {
                        case '0':
                            $result .= 'danger">';
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
                'filter'    => ["0" => "Некорректное", "1" => "Опубликовано"],
                'format' => 'raw',
            ],
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>