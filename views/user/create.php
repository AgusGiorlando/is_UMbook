<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\user\User */

$this->title = 'Registro';
?>
<div class="user-create">

    <h1>Registro de usuario</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
