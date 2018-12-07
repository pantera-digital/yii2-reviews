<?php

use kartik\depdrop\DepDrop;
use pantera\reviews\admin\Module;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model pantera\reviews\models\Review */
/* @var $form yii\widgets\ActiveForm */
/* @var $module Module */
?>
<div class="review-form">
    <?php $form = ActiveForm::begin([
        'validateOnChange' => false,
        'validateOnBlur' => false,
    ]); ?>
    <?= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->checkbox() ?>
    <?= $form->field($model, 'likes')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'dislikes')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'model_class')->dropDownList($module->getClassesList(), [
        'prompt' => Yii::t('reviews', 'Choose a review type'),
    ]) ?>
    <?= $form->field($model, 'model_id')->widget(DepDrop::class, [
        'options' => ['id' => 'subcat-id'],
        'type' => DepDrop::TYPE_SELECT2,
        'pluginOptions' => [
            'depends' => ['review-model_class'],
            'placeholder' => Yii::t('reviews', 'Select...'),
            'url' => Url::to(['load-models']),
        ]
    ]); ?>
    <?= $this->render('_metrics', [
        'form' => $form,
        'model' => $model
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('reviews', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
