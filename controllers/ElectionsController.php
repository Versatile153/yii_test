<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use yii\data\Pagination;
use yii\db\Query;

class ElectionsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['index', 'scores', 'store'], // Specify the actions you want to protect
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // '@' means the action is accessible to authenticated users only
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */

    

     public function actionIndex()
     
        {
            $query = (new Query())
                ->select('polling_unit.polling_unit_name, polling_unit.ward_id, polling_unit.lga_id, polling_unit.polling_unit_name, announced_pu_results.party_abbreviation, announced_pu_results.party_score, announced_pu_results.party_abbreviation, announced_pu_results.entered_by_user')
                ->from('polling_unit')
                ->join('INNER JOIN', 'announced_pu_results', 'polling_unit.polling_unit_id = announced_pu_results.polling_unit_uniqueid');
    
            // Use Yii's Pagination to paginate the results
            $pagination = new Pagination([
                'defaultPageSize' => 10, // Specify the number of records per page
                'totalCount' => $query->count(),
            ]);
    
            $results = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
    
            // Render the view with the results and pagination
            return $this->render('index', [
                'results' => $results,
                'pagination' => $pagination,
            ]);
        
     }


     public function actionScores()
     {
        
            // Fetch the list of local governments for the dropdown
            $localGovernments = (new \yii\db\Query())
                ->select(['lga.lga_id', 'lga.lga_name'])
                ->distinct()
                ->from('announced_pu_results')
                ->innerJoin('polling_unit', 'announced_pu_results.polling_unit_uniqueid = polling_unit.polling_unit_id')
                ->innerJoin('lga', 'polling_unit.lga_id = lga.lga_id')
                ->all();
    
            // Initialize variables for selected local government and corresponding party scores
            $selectedLocalGovernment = Yii::$app->request->post('local_government');
            $pollingUnitResults = [];
            $partyScores = [];
    
           // Check if a local government is selected
if ($selectedLocalGovernment) {
    // Fetch the polling unit results and calculate the sum of party scores for the selected local government
    $pollingUnitResults = (new \yii\db\Query())
        ->select(['polling_unit.polling_unit_name', 'announced_pu_results.party_score'])
        ->from('announced_pu_results')
        ->innerJoin('polling_unit', 'announced_pu_results.polling_unit_uniqueid = polling_unit.polling_unit_id')
        ->where(['polling_unit.lga_id' => $selectedLocalGovernment]) // Use the selected lga_id
        ->all();

    $partyScores = (new \yii\db\Query())
        ->select(['announced_pu_results.party_abbreviation', 'SUM(announced_pu_results.party_score) as total_score'])
        ->from('announced_pu_results')
        ->innerJoin('polling_unit', 'announced_pu_results.polling_unit_uniqueid = polling_unit.polling_unit_id')
        ->where(['polling_unit.lga_id' => $selectedLocalGovernment]) // Use the selected lga_id
        ->groupBy('announced_pu_results.party_abbreviation')
        ->all();
}

            return $this->render('scores', [
                'pollingUnitResults' => $pollingUnitResults,
                'localGovernments' => $localGovernments,
                'selectedLocalGovernment' => $selectedLocalGovernment,
                'partyScores' => $partyScores,
            ]);
        }
     
        public function actionStore()
    {
        $request = Yii::$app->request;
        $postData = $request->post();

        // Perform custom validation
        $errors = $this->validateData($postData);

        if (!empty($errors)) {
            Yii::$app->session->setFlash('error', 'Please fill in all required fields.');
            return $this->redirect(Yii::$app->request->referrer);
        }

        // Insert the polling unit data into the database
        Yii::$app->db->createCommand()->insert('polling_unit', $postData)->execute();

        Yii::$app->session->setFlash('success', 'Polling unit created successfully.');
        return $this->redirect(Yii::$app->request->referrer);
    }

    // Custom validation function
    private function validateData($postData)
    {
        $requiredFields = ['polling_unit_number', 'polling_unit_name', 'polling_unit_description'];

        $errors = [];
        foreach ($requiredFields as $field) {
            if (empty($postData[$field])) {
                $errors[] = $field;
            }
        }

        return $errors;
    }
        
        
}
