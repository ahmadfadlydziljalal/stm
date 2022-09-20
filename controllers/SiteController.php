<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'error', 'contact', 'captcha'],
                    ],
                    [
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

    /**
     * {@inheritdoc}
     */
    public function actions(): array
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
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

        $this->layout = 'login';
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
    public function actionLogout(): Response
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

        if (Yii::$app->user->isGuest) {
            $this->layout = 'login';
        }

        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAccountInformation(): string
    {
        $image = Yii::$app->cache->get('sihrd-user-image' . Yii::$app->user->identity->id);
        $dataKaryawan = Yii::$app->cache->get('sihrd-karyawan' . Yii::$app->user->identity->id);

        if (empty($image)) {
            Yii::$app->user->identity->saveCacheForImage();
            $image = Yii::$app->cache->get('sihrd-user-image' . Yii::$app->user->identity->id);
        }

        if (empty($dataKaryawan)) {
            Yii::$app->user->identity->saveCacheForDataKaryawan();
            $dataKaryawan = Yii::$app->cache->get('sihrd-karyawan' . Yii::$app->user->identity->id);
        }

        return $this->render('account_information', [
            'dataKaryawan' => $dataKaryawan,
            'image' => $image
        ]);
    }

    public function actionAbout(): string
    {
        return $this->render('about', ['withBreadcrumb' => true]);
    }

}