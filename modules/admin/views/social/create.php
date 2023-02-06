<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Social */

$this->title = 'Додати';
$this->params['breadcrumbs'][] = ['label' => 'Соціальні мережі', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>