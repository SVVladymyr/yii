<?php

	use yii\bootstrap\Html;
    use yii\grid\GridView;
    use yii\data\ActiveDataProvider;
	use yii\bootstrap\NavBar;
	use yii\bootstrap\Nav;
	use app\models\Todolist;
	use yii\helpers\Url;
	use yii\helpers\BaseUrl;

	
	NavBar::begin([
		'brandLabel' => '',
		'options' => [
			'class' => 'navbar navbar-default',
		]
	]);
	echo Nav::widget([
		'options' => [
			'class' => 'nav navbar-nav navbar-right',
		],
		'items' => [
			Yii::$app->user->isGuest ?
					['label' => 'Sign in', 'url' => ['/user/security/login'], 'linkOptions' => ['style' => 'margin: 3px',]] :
					['label' => 'Sign out (' . Yii::$app->user->identity->username . ')', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post', 'style' => 'margin: 3px',]],
					['label' => 'Register', 'url' => ['/user/registration/register'], 'linkOptions' => ['style' => 'margin: 3px',], 'visible' => Yii::$app->user->isGuest]
		]
	]);

	
	NavBar::end();
	
?>
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],
				'userview.username',
				'title',
				'status',
				'action:ntext',
				// 'updateDate',

				[
					'class' => 'yii\grid\ActionColumn',
					'template' => '{view} {update} {delete}',
					'buttons' => [
							'view' => function ($url) {
								$url_parse = parse_url($url);
								parse_str($url_parse['query']);
								return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['todolist/view', 'id' => $id]));
							},
							'update' => function ($url) {
								$url_parse = parse_url($url);
								parse_str($url_parse['query']);
								return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['todolist/update', 'id' => $id]));
							},
							'delete' => function ($url) {
								$url_parse = parse_url($url);
								parse_str($url_parse['query']);
								return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to(['todolist/delete', 'id' => $id]));
							},
					],
				],
			],
		]); ?>