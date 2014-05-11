<?php
use frontend\tests\unit\TestCase;
use common\models\User;
class UserTest extends TestCase{
	public function testAdd(){
		$addUser = new User();
		$addUser->birthday = '2013-04-22';
		
	}
}