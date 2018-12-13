<?php

namespace app\controllers;

use app\models\Calculator;
use Yii;
use yii\base\InvalidRouteException;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
            'dummy' => [
                'class' => 'app\actions\DummyAction'
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['site/test']);
        //return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {

        //return $this->runAction('dummy', ['prop1' => 'value1', 'prop2' => 'value2']);
        //return $this->render('about');
    }

    public function actionTest()
    {
        /*
        $request = Yii::$app->request;
        $fileContents = '';

        try {
            if ($request->isPost) {
                $file = UploadedFile::getInstanceByName('file');
                $file->saveAs("files/" . $file);
                $fileContents = $file;
            }
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }

        return $this->render('test', [
            'fileContents' => $fileContents
        ]);*/
        return $this->render('test');
    }

    public function actionCalculator()
    {
        $operations = Calculator::getOperationAssocArray();

        if(Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            $a = $post['a'];
            $b = $post['b'];
            $currentOperation = $post['operations'];

            $result = '';
            switch($currentOperation)
            {
                case Calculator::ADD:
                    $result = Calculator::add($a, $b);
                    break;
                case Calculator::SUBSTRACT:
                    $result = Calculator::substract($a, $b);
                    break;
                case Calculator::MULTIPLY:
                    $result = Calculator::multiply($a, $b);
                    break;
                case Calculator::DIVIDE:
                    $result = Calculator::divide($a, $b);
                    break;
            }
            return $this->render('calculation',
                ['result' => $result,
                    'a' => $a,
                    'b' => $b,
                    'operations' => $operations,
                    'currentOperation' => $currentOperation
                    ]);
        }
        else
        {
            $a = null;
            $b = null;
            return $this->render('calculation',
                ['a' => $a,
                 'b' => $b,
                 'operations' => $operations,
                 'currentOperation' => Calculator::ADD
                ]);
        }
    }
}
