<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class WebsiteController extends Controller {
	public function actionIndex() {
		echo "index";
	}
	public function actionPage($alias) {
		echo "page is $alias";
	}
	public function actionTest() {
		
	}
}