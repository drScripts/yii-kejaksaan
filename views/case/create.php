<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CaseModel $model */

$this->title = $this->title = $_ENV["APP_NAME"] . ' - Create Case Model';
$this->params['breadcrumbs'][] = ['label' => 'Case Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>