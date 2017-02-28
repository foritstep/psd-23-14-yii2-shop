<?php

$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['category/index']];
$this->params['breadcrumbs'][] = 'New category';

?>

<h1 class="text-center">New category</h1>

<div class="col-lg-6 col-lg-offset-3">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'enableClientValidation' => false
    ]) ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'parentId')->dropDownList($categories, ['prompt' => 'Choose category...']) ?>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

    <?php \yii\bootstrap\ActiveForm::end(); ?>
</div>
