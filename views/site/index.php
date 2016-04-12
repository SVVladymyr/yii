<?php

	use yii\bootstrap\Html;
	use yii\helpers\Url;
	use yii\bootstrap\BootstrapAsset;
    use yii\grid\GridView;
    use yii\data\ActiveDataProvider;
	use yii\widgets\Menu;
	use yii\bootstrap\Widget;
	use yii\bootstrap\NavBar;
	use yii\bootstrap\Nav;
	use yii\bootstrap\Alert;

	
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
	
	
		if(Yii::$app->user->isGuest){
?>
		<?= GridView::widget([
        'dataProvider' => $todoProvider,
        'filterModel' => $searchTodo,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],
				//'userId',
				'userview.username',
				'title',
				'status',
				'action:ntext',
				// 'updateDate',

				[
					'class' => 'yii\grid\ActionColumn',
					'template' => '{view}',
					'buttons' => [
								'view' => function ($url) {
									$url_parse = parse_url($url);
									parse_str($url_parse['query']);
									return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['todolist/view', 'id' => $id]));
								},
					],
				],
			],
		]); ?>
<?php	}else { ?>
			<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],
					'id',
					'username',
					'email:email',
					//'password_hash',
					//'auth_key',
					// 'confirmed_at',
					// 'unconfirmed_email:email',
					// 'blocked_at',
					// 'registration_ip',
					// 'created_at',
					// 'updated_at',
					// 'flags',

					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}',
				    ],
				],
			]); ?>
			<?= HTML::a('My todo', ['site/todo'],['class' => 'btn btn-default'])?>
			<?= HTML::a('Todolist other users', ['site/nomytodo'],['class' => 'btn btn-default'])?>
<?php	} ?>
  