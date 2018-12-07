<?php

namespace pantera\reviews\admin\controllers;

use pantera\reviews\admin\Module;
use pantera\reviews\models\ReviewMetricType;
use pantera\reviews\models\ReviewMetricTypeSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ReviewMetricTypeController implements the CRUD actions for ReviewMetricType model.
 */
class ReviewMetricTypeController extends Controller
{
    public $layout = 'menu';
    /* @var Module */
    public $module;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->permissions,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ReviewMetricType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReviewMetricTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /** @noinspection MissedViewInspection */
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ReviewMetricType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReviewMetricType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        /** @noinspection MissedViewInspection */
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ReviewMetricType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        /** @noinspection MissedViewInspection */
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ReviewMetricType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ReviewMetricType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ReviewMetricType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReviewMetricType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
