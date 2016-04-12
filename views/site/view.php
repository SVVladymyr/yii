<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserView */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User Views', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'password_hash',
            'auth_key',
            'confirmed_at',
            'unconfirmed_email:email',
            'blocked_at',
            'registration_ip',
            'created_at',
            'updated_at',
            'flags',
        ],
    ]) ?>

</div>
