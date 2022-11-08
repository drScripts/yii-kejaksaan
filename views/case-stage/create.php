<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CaseStageModel $model */

$this->title = 'Create Case Stage Model';
$this->params['breadcrumbs'][] = ['label' => 'Case Stage Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-stage-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
