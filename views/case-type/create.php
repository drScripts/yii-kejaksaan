<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CaseTypeModel $model */

$this->title = $this->title = $_ENV["APP_NAME"] . ' - Create Case Type Model';
$this->params['breadcrumbs'][] = ['label' => 'Case Type Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-type-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>