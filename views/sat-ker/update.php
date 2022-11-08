<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SatKerModel $model */

$this->title = 'Update Sat Ker Model: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sat Ker Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sat-ker-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
