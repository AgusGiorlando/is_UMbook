<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'UMbook - Registro';
?>
<div class="site-sign-up">
    <h1>Registro</h1>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'nombre')->textInput(['autofocus' => true])->label('Nombre') ?>
    <?= $form->field($model, 'apellido')->textInput()->label('Apellido') ?>
    <?= $form->field($model, 'username')->textInput()->label('Usuario') ?>
    <?= $form->field($model, 'email')->textInput()->label('Email') ?>
    <?= $form->field($model, 'password')->passwordInput()->label('Clave') ?>
    <?= $form->field($model, 'nacimiento')->textInput()->label('Nacimiento') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Registrarme', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>