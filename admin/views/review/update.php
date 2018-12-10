<?php

use pantera\reviews\admin\Module;
use pantera\reviews\models\Review;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Review */
/* @var $module Module */

$this->title = Yii::t('reviews', 'Update Review: {NAME}', [
    'NAME' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('reviews', 'Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('reviews', 'Update');
?>
<div class="review-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'module' => $module,
    ]) ?>

</div>
