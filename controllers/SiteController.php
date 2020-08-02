<?php

namespace app\controllers;

use app\models\base\Comentario;
use app\models\base\CommentForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\user\User;

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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new LoginForm();
        try {

            if ($model->load(Yii::$app->request->post()) && $model->login()) {

                return $this->actionHome();
            }
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionHome()
    {
        $user = Yii::$app->user;
        $model = new CommentForm();
        $comentarios = Comentario::getByEntityId($user->getId());

        return $this->render('/site/home', [
            'model' => $model,
            'comentarios' => $comentarios
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
     * Inicia sesion.
     *
     * @return Response
     */
    public function actionSignUp()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            try {
                User::registrar($model);
            } catch (\Exception $ex) {
            }
        }

        return $this->render('sign-up', [
            'model' => $model
        ]);
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
        return $this->render('about');
    }
}
