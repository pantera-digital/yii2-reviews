<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model rivership\modules\reviews\models\ReviewMetric */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-metric-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'review_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metric_type_id')->textInput() ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
