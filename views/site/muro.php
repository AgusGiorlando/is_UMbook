<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'UMbook';
?>
<div class="site-muro">
    <div class="container">
        <div>
            <div class="card text-white bg-primary" style="padding: 20px;">
                <h4 class="card-title">Nuevo comentario</h4>
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                        'action' => ['comentario/nuevo'],
                        'method' => 'POST',
                        'id' => 'comment-form',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-1 control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'contenido')->textarea(array('style' => 'width: 1000px; height: 80px;'))->label((false)) ?>
                    <?= Html::submitButton('Comentar', ['class' => 'btn btn-success', 'name' => 'comment-button']) ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div>
            <?php foreach ($comentarios as $item) : ?>
                <br>
                <div class="card text-white bg-info" style="padding: 20px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p>
                                    <?= sprintf(
                                        '<b>%s %s</b>: %s',
                                        $item['nombre'],
                                        $item['apellido'],
                                        $item['contenido']
                                    ) ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <?php if ($item['propio'] == true) : ?>
                                    <?= Html::a('Eliminar', ['comentario/eliminar', 'id' => $item['id_comentario']], ['class' => 'btn btn-danger']) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>