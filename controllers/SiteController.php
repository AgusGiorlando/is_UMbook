<?php

namespace app\controllers;

use app\models\base\Comentario;
use app\models\base\NuevoComentarioForm;
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

                return $this->actionMuro();
            }
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionMuro()
    {
        $user = Yii::$app->user;
        if ($user->isGuest) {
            $this->redirect('index');
        }
        $model = new NuevoComentarioForm();
        $aComentariosQuery = Comentario::getByUsuarioId($user->getId());
        $comentarios = [];

        foreach ($aComentariosQuery as $item) {
            $item['propio'] = false;
            if ($item['id_autor'] == $user->id) {
                $item['propio'] = true;
            }
            array_push($comentarios, $item);
        }
        
        return $this->render('/site/muro', [
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
    public function actionRegistro()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            try {
                User::registrar($model);
            } catch (\Exception $ex) {
            }
        }

        return $this->render('registro', [
            'model' => $model
        ]);
    }
}
