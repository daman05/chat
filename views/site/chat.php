<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Чат';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-chat">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="chat_room" class="well well-sm">
        <div id="messages">
            <?php foreach ($messages as $message) : ?>
                <div class="message">
                    <?php
                    if (\Yii::$app->user->identity->isAdmin) {
                        if ($message->status == 1) {
                            echo Html::a('<i class="fas fa-minus-circle"></i>', Url::to(['admin/message/status-edit', 'id' => $message->id]), ['title' => 'При клике сообщение попадет в список некорректных!']);
                        } else {
                            echo Html::a('<i class="fas fa-plus-circle"></i>', Url::to(['admin/message/status-edit', 'id' => $message->id]), ['title' => 'Вернуть сообщение в чат!']);
                        }
                    }

                    ?>
                    <?= $message->created_at ?>

                    <span class="user text-primary"><?= Html::encode($message->user->username)  ?></span>
                    <?= ($message->user->isAdmin ? Html::tag('span',  Html::encode($message->text), ['class' => 'text-danger']) : Html::encode($message->text)) ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div>
        <?php $form = ActiveForm::begin(['id' => 'chat-form']); ?>
        <?= $form->field($model, 'text')->textInput(['autocomplete' => 'off', 'autofocus' => true, 'maxlength' => 255]) ?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-default', 'name' => 'chat-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>