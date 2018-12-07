<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/*  */
?>
<?php $form = ActiveForm::begin([
    'action' => ['/reviews/default/create'],
]) ?>

<?= $form->field($model, 'email')->textInput([
    'type' => 'email',
]) ?>

<?= $form->field($model, 'name')->textInput() ?>

<?= $this->render('@pantera/reviews/admin/views/review/_metrics', [
    'form' => $form,
    'model' => $model
]) ?>

<?= Html::submitButton(Yii::t('reviews', 'Add review'), [
    'class' => 'btn btn-success',
]) ?>

<?php ActiveForm::end();
