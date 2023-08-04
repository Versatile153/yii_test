<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

use yii\grid\GridView;


// Create the GridView widget
echo GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $results,
        'pagination' => false, // Disable pagination if you want to display all data at once
    ]),
    'columns' => [
        'polling_unit_name',
        'ward_id',
        'party_abbreviation', // Display party name
        'party_score', // Display party score
        // Add other attribute columns here
    ],
]);


// Display the pagination links
echo LinkPager::widget([
    'pagination' => $pagination,
]);
?>
