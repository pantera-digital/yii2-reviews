<?php

use pantera\reviews\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model pantera\reviews\models\Review */
/* @var $form yii\widgets\ActiveForm */
/* @var $module Module */
$module = $this->context->module;
?>
<?php Pjax::begin(['id' => 'review-form']) ?>
    <div class="review-form">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'user_id')->textInput() ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->checkbox() ?>
        <?= $form->field($model, 'likes')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dislikes')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'model_class')->dropDownList($module->reviewAdminClasses, [
            'prompt' => 'Выбрать тип отзыва',
        ]) ?>
        <?php $this->registerJs('
                var val;
                $(document).on("change", "#review-model_class", function() {
                    $(this).parents("form").submit();
                });
        ') ?>
        <?php if ($model->model_class) : ?>
            <?php $modelClassModels = $model->model_class::find()->all(); ?>
            <?= $form->field($model, 'model_id')->dropDownList(ArrayHelper::map($modelClassModels, 'id', 'title'), [
                'prompt' => 'Выберите значение'
            ]) ?>
        <?php endif; ?>
        <?= $this->render('_metrics', [
            'form' => $form,
            'model' => $model
        ]) ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php Pjax::end() ?>