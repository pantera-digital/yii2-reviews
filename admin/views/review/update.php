<?php

use pantera\reviews\admin\Module;
use pantera\reviews\models\Review;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Review */
/* @var $module Module */

$this->title = 'Update Review: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="review-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'module' => $module,
    ]) ?>

</div>
