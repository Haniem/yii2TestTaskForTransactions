<?php

namespace app\controllers;

use app\models\Contact;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ContactSearch;
use app\models\Transaction;
use app\models\TransactionSearch;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $contactSearchModel = new ContactSearch();
        $contactDataProvider = $contactSearchModel->search($this->request->queryParams);
        
        $transactionSearchModel = new TransactionSearch();
        $transactionDataProvider = $transactionSearchModel->search($this->request->queryParams);


        return $this->render('index', [
            'contactSearchModel' => $contactSearchModel,
            'contactDataProvider' => $contactDataProvider,
            'transactionSearchModel' => $transactionSearchModel,
            'transactionDataProvider' => $transactionDataProvider,
        ]);
    }

    public function actionCurentContact($id)
    {
        $contact = Contact::findOne($id);
        if ($contact === null) {
            throw new NotFoundHttpException("Contact not found");
        }

        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $contactTransactions = $contact->getTransactions()->all();
        return $this->render('curentContact', [
            'contact' => $contact,  
            'dataProvider' => $dataProvider,
            'contactTransactions' => $contactTransactions,
        ]);
    }

    public function actionCurentTransaction($id)
    {   
        $transaction = Transaction::findOne($id);

        if ($transaction === null) {
            throw new NotFoundHttpException("Transaction not found");
        }

        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $transactionContact = $transaction->getContact()->all();

        return $this->render('curentTransaction', [
            'transaction' => $transaction,
            'dataProvider' => $dataProvider,
            'transactionContact' => $transactionContact,
        ]);
    }
}
