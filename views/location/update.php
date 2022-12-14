<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LocationModel $model */

$this->title = $this->title = $_ENV["APP_NAME"] . ' - Update Location Model: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Location Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="location-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>