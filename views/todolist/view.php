<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Todolist */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Todolists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="todolist-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'userId',
            'title',
            'status',
            'action:ntext',
            'updateDate',
        ],
    ]) ?>

</div>
