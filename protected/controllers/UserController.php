<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 21:19
 * To change this template use File | Settings | File Templates.
 */
class UserController extends Controller
{

	/**
	 * Declares class-based actions
	 *
	 * @return array
	 */
	public function actions()
	{
		return array(
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
		);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new User('login');

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}

		// display the login form
		$this->render('login', array(
			'model' => $model,
		));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Displays the register page
	 */
	public function actionRegister()
	{
		$model = new User('register');

		if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if (isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			if ($model->save())
			{
				// Auto login
				$login = new User('login');
				$login->attributes = $_POST['User'];
				$login->login();

				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->render('register', array(
			'model' => $model,
		));
	}

	/**
	 * Displays the index page
	 */
	public function actionProfile()
	{
		$model = User::model()->find(Yii::app()->user->id);
		$model->scenario = 'profile';

		if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if (isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			if ($model->save())
			{
				//$this->refresh();
			}
		}

		$this->render('profile', array(
			'model' => $model,
		));
	}

}
