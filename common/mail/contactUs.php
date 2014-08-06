<?php
use yii\helpers\Html;

/**
 *
 * @var yii\web\View $this
 * @var common\models\User $user
 */

?>

<?php echo \Yii::t('contact', 'A mail from {0},email address is {1}',[$userName,$userMail])?>,
</br>
<div class="jumbotron">
	<p><?php echo Html::mailto(Yii::t('contact','Reply to {0} ',$userName),$userMail) ?></p>
	<?php echo Html::decode($mailbody)?>
</div>