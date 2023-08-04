<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = 'Party Scores and Polling Unit Results';

// Define the default value for the selected local government
$selectedLocalGovernment = Yii::$app->request->post('local_government');

$form = ActiveForm::begin(['action' => ['scores'], 'method' => 'post']);
?>
<div class="mb-3">
<?= Html::dropDownList('local_government', $selectedLocalGovernment, 
    ['' => '-- Select Local Government --'] + ArrayHelper::map($localGovernments, 'lga_id', 'lga_name'),
    ['class' => 'form-control']
) ?>

</div>
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>

<?php if ($selectedLocalGovernment) : ?>
    <h3>Party Scores for <?= $selectedLocalGovernment ?></h3>
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $partyScores,
            'pagination' => false,
        ]),
        'columns' => [
            'party_abbreviation',
            'total_score',
        ],
    ]) ?>

    <h3>Polling Unit Results for <?= $selectedLocalGovernment ?></h3>
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $pollingUnitResults,
            'pagination' => false,
        ]),
        'columns' => [
            'polling_unit_name',
            'party_score',
            
        ],
    ]) ?>
<?php endif; ?>
