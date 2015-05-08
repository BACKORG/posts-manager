<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
\yii\web\View::registerJsFile('https://code.jquery.com/jquery-2.1.4.min.js', ['position' => \yii\web\View::POS_HEAD]);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="pmApp">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <?php
        NavBar::begin([
            'brandLabel' => '',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
                Yii::$app->user->isGuest ?
                    ['label' => 'Login', 'url' => ['/site/login']] :
                    ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']],
            ],
        ]);
        NavBar::end();
    ?>

    <div class="clearfix"></div>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>

    <footer>
        <div class="container">
            <p class="pull-left copy">&copy; Post Manager <?= date('Y') ?></p>

            <div class="share-div pull-right clearfix">
                <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?=$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];?>" class="fa fa-facebook">
                </a>

                <a target="_blank" href="http://twitter.com/home?status=<?=$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];?>" class="fa fa-twitter">
                </a>

                <a target="_blank" href="http://plus.google.com/share?url=<?=$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];?>" class="fa fa-google-plus" >
                </a>

                <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];?>" class="fa fa-linkedin" >
                </a>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
