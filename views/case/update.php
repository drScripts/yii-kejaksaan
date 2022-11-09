<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CaseModel $model */

$this->title = $this->title = $_ENV["APP_NAME"] . ' - Update Case Model: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Case Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="case-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>