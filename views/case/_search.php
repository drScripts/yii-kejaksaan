<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CaseModelSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="case-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'satKerId') ?>

    <?= $form->field($model, 'locationId') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'spdpNumber') ?>

    <?php // echo $form->field($model, 'spdpDate') ?>

    <?php // echo $form->field($model, 'caseTypeId') ?>

    <?php // echo $form->field($model, 'document') ?>

    <?php // echo $form->field($model, 'caseStageId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
