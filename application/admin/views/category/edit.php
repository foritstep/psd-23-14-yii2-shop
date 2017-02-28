<?php

$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['category/index']];
$this->params['breadcrumbs'][] = 'Edit category ' . $model->id;

?>

<h1 class="text-center">Edit category <?= $model->id ?></h1>

<?php if ($model->id) { ?>
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
<?php } else { ?>
    <p class="text-danger">Category not found</p>
<?php } ?>