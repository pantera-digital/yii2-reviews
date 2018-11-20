<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 11/20/18
 * Time: 12:26 PM
 */

namespace pantera\reviews\controllers;

use pantera\reviews\models\Review;
use Yii;
use yii\filters\AjaxFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use function is_null;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => AjaxFilter::class,
                'only' => ['like', 'dislike'],
            ],
        ];
    }

    public function actionLike($id)
    {
        $model = $this->findModel($id);
        $sessionDislikeKey = 'review-dislike-' . $id;
        $sessionLikeKey = 'review-like-' . $id;
        if (Yii::$app->session->has($sessionDislikeKey)) { //Удалим дизлайк если есть
            Yii::$app->session->remove($sessionDislikeKey);
            $model->dislikes = $model->dislikes - 1;
        }
        if (Yii::$app->session->has($sessionLikeKey) === false) {
            Yii::$app->session->set($sessionLikeKey, 1);
            $model->likes = $model->likes + 1;
        } elseif (Yii::$app->session->has($sessionLikeKey)) {
            Yii::$app->session->remove($sessionLikeKey);
            $model->likes = $model->likes - 1;
        }
        if ($model->save()) {
            return $this->asJson([
                'status' => true,
                'likes' => $model->likes ?: 0,
                'dislikes' => $model->dislikes ?: 0,
            ]);
        }
    }

    public function actionDislike($id)
    {
        $model = $this->findModel($id);
        $sessionDislikeKey = 'review-dislike-' . $id;
        $sessionLikeKey = 'review-like-' . $id;
        if (Yii::$app->session->has($sessionLikeKey)) { //Удалим лайк если есть
            Yii::$app->session->remove($sessionLikeKey);
            $model->likes = $model->likes - 1;
        }
        if (Yii::$app->session->has($sessionDislikeKey) === false) {
            Yii::$app->session->set($sessionDislikeKey, 1);
            $model->dislikes = $model->dislikes + 1;
        } elseif (Yii::$app->session->has($sessionDislikeKey)) {
            Yii::$app->session->remove($sessionDislikeKey);
            $model->dislikes = $model->dislikes - 1;
        }
        if ($model->save()) {
            return $this->asJson([
                'status' => true,
                'likes' => $model->likes ?: 0,
                'dislikes' => $model->dislikes ?: 0,
            ]);
        }
    }

    protected function findModel($id)
    {
        $model = Review::findOne($id);
        if (is_null($model)) {
            throw new NotFoundHttpException();
        }
        return $model;
    }
}
