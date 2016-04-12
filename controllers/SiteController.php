<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\UserView;
use app\models\UserViewSearch;
use app\models\Todolist;
use app\models\TodolistSearch;

class SiteController extends Controller
{

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => \yii\filters\VerbFilter::className(),
				'actions' => [
					'index'  => ['get', 'post'],
					'view'   => ['get', 'post'],
					'create' => ['get', 'post'],
					'update' => ['get', 'put', 'post'],
					'delete' => ['post', 'delete'],
					'login' => ['get', 'post'],
					'logout' => ['get', 'post'],
					'register' => ['get', 'post'],
					'todo' => ['get', 'post'],
				],
			],
		];
	}
	
    public function actionIndex()
    {
		
		$id = Yii::$app->user->id;
		$searchModel = new UserViewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$searchTodo = new TodolistSearch();;
		$todoProvider =  $searchTodo->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
		    'id' => $id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'searchTodo' => $searchTodo,
			'todoProvider' => $todoProvider,
        ]);
    }
	
	/**
     * Displays a single UserView model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

	public function actionTodo()
	{
		$id = Yii::$app->user->id;
		$searchModel = new TodolistSearch();;
		$dataProvider =  $searchModel->searchMyTodo(Yii::$app->request->queryParams);
		
        return $this->render('todo', [
		    'id' => $id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
	}
	
	public function actionNomytodo()
	{
		$id = Yii::$app->user->id;
		$searchModel = new TodolistSearch();;
		$dataProvider =  $searchModel->searchNoMyTodo(Yii::$app->request->queryParams);
		
        return $this->render('nomytodo', [
		    'id' => $id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
	}

   public function isGuestMy()
   {
     echo Yii::$app->user->isGuest;	

   }
   
   protected function findModel($id)
    {
        if (($model = UserView::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
