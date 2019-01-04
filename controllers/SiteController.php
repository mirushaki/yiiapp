<?php

namespace app\controllers;

use app\models\Calculator;
use app\models\MailTemplate;
use app\models\TestModel;
use Yii;
use yii\base\InvalidRouteException;
use yii\base\Model;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
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
        /*$templates = MailTemplate::getAllTemplates();*/
        $templateAssocArray = MailTemplate::getAllTemplatesAsAssocArray();
        /*var_dump(MailTemplate::getAllTemplates()); exit;*/

        /*var_dump(Yii::$app->params); exit;*/
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            $template = new MailTemplate($model->template);
            if($model->contact(Yii::$app->params['adminEmail'], $template)) {
                Yii::$app->session->setFlash('contactFormSubmitted');
            }
            return $this->refresh();
            /*return $this->render('render', ['content' => $model->body, 'template' => $template]);*/
        }
        return $this->render('contact', [
            'model' => $model,
            'templateAssocArray' => $templateAssocArray
        ]);
    }

    public function actionRender()
    {
        //
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        //return $this->runAction('dummy', ['prop1' => 'value1', 'prop2' => 'value2']);
        return $this->render('about');
    }

    public function actionTest()
    {
        if(Yii::$app->request->isPost)
        {
            $model = new TestModel(['scenario' => TestModel::SCENARIO_ALL]);
            $model->attributes = Yii::$app->request->post('TestModel');
            $model->password = Yii::$app->request->post('TestModel')['password'];

            $data = $model->toArray();
            Yii::$app->session->setFlash('message', 'Successfully poseted');
            return $this->render('test', ['model' => $model, 'data' => $data]);
        }
        else if(Yii::$app->request->isGet)
        {
            $model = new TestModel();
            $model->setScenario(TestModel::SCENARIO_ALL);
            $data = Yii::$app->request->getUserIP();

            return $this->render('test', ['model' => $model, 'data' => $data]);
        }
        else throw new BadRequestHttpException();
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

    public function actionUnderConstruction()
    {
        return $this->render('under-construction');
    }
}
