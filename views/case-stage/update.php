<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CaseStageModel $model */

$this->title =  $this->title = $_ENV["APP_NAME"] . ' - Update Case Stage Model: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Case Stage Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="case-stage-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>