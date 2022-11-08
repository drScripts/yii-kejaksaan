<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SatKerModel $model */

$this->title = 'Create Sat Ker Model';
$this->params['breadcrumbs'][] = ['label' => 'Sat Ker Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sat-ker-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
