<?php
$this->params['breadcrumbs'][] = 'Users';
use yii\helpers\Url;
?>

<h1>User list <a class="btn btn-primary pull-right" href="<?= Url::to(['user/create'])?>">Add user</a></h1>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'columns' => [
        'id',
        'login',
        'password',
        'createdAt',
        'updatedAt',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}'
        ]
    ]
]) ?>