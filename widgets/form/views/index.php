<?php

use pantera\reviews\models\Review;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Review */
?>
<?php $form = ActiveForm::begin([
    'action' => ['/reviews/default/create'],
    'options' => [
        'class' => 'review-form',
    ],
]) ?>

<?= $form->field($model, 'email')->textInput([
    'type' => 'email',
]) ?>

<?= $form->field($model, 'name')->textInput() ?>

<?= $this->render('@pantera/reviews/admin/views/review/_metrics', [
    'form' => $form,
    'model' => $model
]) ?>

<?= Html::activeHiddenInput($model, 'model_class') ?>
<?= Html::activeHiddenInput($model, 'model_id') ?>

<?= Html::submitButton(Html::tag('span', Yii::t('reviews', 'Add review'), [
    'class' => 'ladda-label',
]), [
    'class' => 'btn btn-success ladda-button',
    'data' => [
        'style' => 'zoom-in',
    ],
]) ?>

<?php ActiveForm::end();
