<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Polling Unit';
$this->params['breadcrumbs'][] = $this->title;
?>

?>

<div class="form-container">
    <h2><?= Html::encode($this->title) ?></h2>

    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(['action' => ['store'], 'method' => 'post']); ?>


    <?= $form->field($model, 'uniqueid')->textInput(['maxlength' => true, 'required' => true]) ?>
    <?= $form->field($model, 'ward_id')->textInput(['maxlength' => true, 'required' => true]) ?>
    <?= $form->field($model, 'lga_id')->textInput(['maxlength' => true, 'required' => true]) ?>
    <?= $form->field($model, 'uniquewardid')->textInput(['maxlength' => true, 'required' => true]) ?>
    <?= $form->field($model, 'polling_unit_number')->textInput(['maxlength' => true, 'required' => true]) ?>
    <?= $form->field($model, 'polling_unit_name')->textInput(['maxlength' => true, 'required' => true]) ?>
    <?= $form->field($model, 'polling_unit_description')->textarea(['rows' => 3, 'required' => true]) ?>
    <?= $form->field($model, 'lat')->textInput(['required' => true]) ?>
    <?= $form->field($model, 'long')->textInput(['required' => true]) ?>
    <?= $form->field($model, 'entered_by_user')->textInput(['required' => true]) ?>
    <?= $form->field($model, 'date_entered')->textInput(['required' => true]) ?>
    <?= $form->field($model, 'user_ip_address')->textInput(['required' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
