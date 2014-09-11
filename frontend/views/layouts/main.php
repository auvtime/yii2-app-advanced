<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\assets\HeadroomAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
HeadroomAsset::register($this);
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
            	'id' => 'auvtime-nav',
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
            	$menuItems[] = ['label' => \Yii::t('auvtime','My Cares'), 'url' => ['/my-care/index']];
            	$menuItems[] = ['label' => \Yii::t('auvtime','My Experiences'), 'url' => ['/experience/index']];
            	$menuItems[] = ['label' => \Yii::t('auvtime','My Achievements'), 'url' => ['/achievement/index']];
            	$menuItems[] = ['label' => \Yii::t('auvtime','Leave Time'), 'url' => ['/site/leave-time']];
            }
            $menuItems[] = ['label' => \Yii::t('auvtime','About Us'), 'url' => ['/site/about']];
            $menuItems[] = ['label' => \Yii::t('auvtime','Contact Us'), 'url' => ['/site/contact']];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => \Yii::t('auvtime','Sign Up'), 'url' => ['/site/signup']];
                $menuItems[] = ['label' => \Yii::t('auvtime','Log In'), 'url' => ['/site/login']];
            } else {
            	$user = Yii::$app->user->identity;
                $menuItems[] = [
                    'label' => \Yii::t('auvtime','My profile') .'('. Yii::$app->user->identity->username . ')',
					'items' => [
						['label' => \Yii::t('auvtime','View profile'),
							'url' => ['/my/view'],
							'linkOptions' => ['data-method' => 'post'],],
						['label' => \Yii::t('auvtime','Edit profile'),
							'url' => ['/my/edit'],
							'linkOptions' => ['data-method' => 'post'],],
						['label' => \Yii::t('auvtime','Edit face'),
							'url' => ['/my/face'],
							'linkOptions' => ['data-method' => 'post'],],
						['label' => \Yii::t('auvtime','Log Out'),
							'url' => ['/site/logout'],
							'linkOptions' => ['data-method' => 'post'],],
					],
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
            <div class="row">
            	<p class="pull-left auvtime-footer">Copyright &copy; AUVTime <?= date('Y') ?>. All Rights Reserved.</p>
            	<div class="pull-right footer-beian"><a href="http://www.beianbeian.com/beianxinxi/24ad3436-4819-424a-a2e7-e96ea36ec959.html" target="blank">苏ICP备14040689号-1</a></div>
        	</div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
