<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use app\models\Category;
use app\models\Social;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $categories = Category::getAll();
        $social = Social::getAll();
        return $this->render('login', [
            'model' => $model,
            'categories' => $categories,
            'socials'=>$social
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    
    public function actionSignup()
    {
        $model = new SignupForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->signup())
            {
                return $this->redirect(['auth/login']);
            }
        }
        $categories = Category::getAll();
        $social = Social::getAll();
        return $this->render('signup', [
            'model'=>$model,
            'categories' => $categories,
            'socials' => $social
        ]);
    }

    public function actionLoginVk($uid, $first_name, $photo)
    {
        $user = new User();
        if($user->saveFromVk($uid, $first_name, $photo))
        {
            return $this->redirect(['site/index']);
        }
    }
    
    public function actionTest()
    {
        $user = User::findOne(1);

        Yii::$app->user->logout();
        
        if(Yii::$app->user->isGuest)
        {
            echo 'Пользователь гость';
        }
        else
        {
            echo 'Пользователь Авторизован';
        }
    }
}