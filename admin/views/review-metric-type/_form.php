<?php

use pantera\reviews\models\ReviewMetricType;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ReviewMetricType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-metric-type-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'type')->dropDownList($model::getTypes(), ['prompt' => 'Select type of assessment']) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('reviews', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
