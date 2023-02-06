<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label("Заголовок") ?>
    <br>
    <?= $form->field($model, 'image')->fileInput(['maxlength' => true])->label("Фото") ?>
    <br>
    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label("Которкий опис") ?>
    <br>
    <?= $form->field($model, 'content')->textarea(['rows' => 6])->label("Повний текст") ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
