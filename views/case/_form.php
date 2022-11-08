<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\CaseModel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="case-model-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php
    $dataPost = ArrayHelper::map(\app\models\SatKerModel::find()->asArray()->all(), 'id', 'name');
    echo $form->field($model, 'satKerId')
        ->dropDownList(
            $dataPost,
            ['id' => 'name']
        );
    ?>

    <?php
    $dataPost = ArrayHelper::map(\app\models\LocationModel::find()->asArray()->all(), 'id', 'name');
    echo $form->field($model, 'locationId')
        ->dropDownList(
            $dataPost,
            ['id' => 'name']
        );
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spdpNumber')->input("number", ['maxlength' => true]) ?>

    <?= $form->field($model, 'spdpDate')->input("date") ?>

    <?php
    $dataPost = ArrayHelper::map(\app\models\CaseTypeModel::find()->asArray()->all(), 'id', 'name');
    echo $form->field($model, 'caseTypeId')
        ->dropDownList(
            $dataPost,
            ['id' => 'name']
        );
    ?>

    <?= $form->field($model, 'document')->input("file") ?>

    <?php
    $dataPost = ArrayHelper::map(\app\models\CaseStageModel::find()->asArray()->all(), 'id', 'name');
    echo $form->field($model, 'caseStageId')
        ->dropDownList(
            $dataPost,
            ['id' => 'name']
        );
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>