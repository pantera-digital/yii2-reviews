<?php

namespace pantera\reviews\admin\controllers;

use kartik\depdrop\DepDropAction;
use pantera\reviews\admin\Module;
use pantera\reviews\models\Review;
use pantera\reviews\models\ReviewSearch;
use Yii;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\filters\AjaxFilter;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ReviewController implements the CRUD actions for Review model.
 */
class ReviewController extends Controller
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
            'ajax' => [
                'class' => AjaxFilter::class,
                'only' => ['load-models'],
            ],
        ];
    }

    public function actions()
    {
        return [
            'load-models' => [
                'class' => DepDropAction::class,
                'outputCallback' => function ($selectedId) {
                    /* @var $object ActiveRecord */
                    $object = Yii::createObject($selectedId);
                    $config = ArrayHelper::getValue($this->module->reviewAdminClasses, $selectedId);
                    if (!$config) {
                        throw new BadRequestHttpException();
                    }
                    $models = $object::find()
                        ->all();
                    return ArrayHelper::getColumn($models, function (ActiveRecord $model) use ($config) {
                        if (is_string($config['value'])) {
                            $value = $model->{$config['value']};
                        } else {
                            $value = call_user_func($config['value'], $model);
                        }
                        return [
                            'id' => $model->getPrimaryKey(),
                            'name' => $value,
                        ];
                    });
                }
            ],
        ];
    }

    /**
     * Lists all Review models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /** @noinspection MissedViewInspection */
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Review model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        /** @noinspection MissedViewInspection */
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Review model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Review();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        /** @noinspection MissedViewInspection */
        return $this->render('create', [
            'model' => $model,
            'module' => $this->module,
        ]);
    }

    /**
     * Updates an existing Review model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        /** @noinspection MissedViewInspection */
        return $this->render('update', [
            'model' => $model,
            'module' => $this->module,
        ]);
    }

    /**
     * Deletes an existing Review model.
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
     * Finds the Review model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Review the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Review::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
