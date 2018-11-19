<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model rivership\modules\reviews\models\ReviewMetricType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-metric-type-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'type')->dropDownList($model::getTypes(), ['prompt' => 'Выбрать тип оценки']) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
