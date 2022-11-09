<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LocationModel $model */

$this->title = $this->title = $_ENV["APP_NAME"] . ' - Create Location Model';
$this->params['breadcrumbs'][] = ['label' => 'Location Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>