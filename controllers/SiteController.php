<?php

namespace app\controllers;

use app\models\Social;
use app\models\Article;
use app\models\Category;
use app\models\Tag;
use app\models\CommentForm;
use app\models\TagSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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

    public function actionIndex() {
        $categories = Category::getAll();
        $socials = Social::getAll();
        
        $query = Article::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index',[
            'models' => $models,
            'pages' => $pages,
            'categories' => $categories,
            'socials' => $socials
        ]);
    }
    
    public function actionView($id) {
        $article = Article::findOne($id);
        $categories = Category::getAll();
        $social = Social::getAll();
        $comments = $article->getArticleComments();
        $tags = $article->getSelectedTags();
        $commentForm = new CommentForm();

        $article->viewedCounter();

        return $this->render('single',[
            'article'=>$article,
            'categories'=>$categories,
            'tags'=>$tags,
            'comments'=>$comments,
            'commentForm'=>$commentForm,
            'socials'=>$social
        ]);
    }
    
    public function actionCategory($id) {
        $data = Category::getArticlesByCategory($id);
        $categories = Category::getAll();
        $social = Social::getAll();
        return $this->render('category',[
            'articles'=>$data['articles'],
            'categories'=>$categories,
            'socials'=>$social,
        ]);
    }

    public function actionSearch($params) {
        $data = Article::find();
        $categories = Category::getAll();
        $social = Social::getAll();
        return $this->render('category',[
            'articles'=>$data['articles'],
            'categories'=>$categories,
            'socials'=>$social,
        ]);
    }

    public function actionTag($id) {
        $data = Tag::getArticlesByTags($id);
        $categories = Category::getAll();
        $social = Social::getAll();
        $tags = TagSearch::getAll();
        return $this->render('tag',[
            'articles'=>$data,
            'categories'=>$categories,
            'socials'=>$social,
            'tags'=>$tags
        ]);
    }

    public function actionComment($id) {
        $model = new CommentForm();
        if(Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id)) {
                return $this->redirect(['site/view','id'=>$id]);
            }
        }
    }
}
