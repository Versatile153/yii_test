<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

$this->title = 'Party Scores and Polling Unit Results';

// Define the default value for the selected local government
$selectedLocalGovernment = Yii::$app->request->post('local_government');
// ...
$selectedLocalGovernment = Yii::$app->request->post('local_government');
var_dump($selectedLocalGovernment);
die;
// ...


$form = ActiveForm::begin(['action' => ['results'], 'method' => 'post']);
?>
<div class="mb-3">
    <?= Html::dropDownList('local_government', $selectedLocalGovernment, 
        ['' => '-- Select Local Government --'] + $localGovernments,
        ['class' => 'form-control']
    ) ?>
</div>
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
