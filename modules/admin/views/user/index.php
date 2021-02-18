<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?php // echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) 
        ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            // 'password_hash',
            //'auth_key',
            // 'created_at',
            //'updated_at',
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
                'filter'    => ["0" => "нет", "1" => "да"],
                'format' => 'raw',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>