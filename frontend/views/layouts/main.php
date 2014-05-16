<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'AUVTime',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => \Yii::t('auvtime','Home'), 'url' => ['/site/index']],
            ];
            if (!Yii::$app->user->isGuest) {
            	$menuItems[] = ['label' => \Yii::t('auvtime','Life Time'), 'url' => ['/site/life-time']];
            }
            $menuItems[] = ['label' => \Yii::t('auvtime','About Us'), 'url' => ['/site/about']];
            $menuItems[] = ['label' => \Yii::t('auvtime','Contact Us'), 'url' => ['/site/contact']];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => \Yii::t('auvtime','Sign Up'), 'url' => ['/site/signup']];
                $menuItems[] = ['label' => \Yii::t('auvtime','Log In'), 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => \Yii::t('auvtime','Log Out') .'('. Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        	<p class="pull-left auvtime-footer">&copy; auvtime <?= date('Y') ?>. All Rights Reserved.</p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
