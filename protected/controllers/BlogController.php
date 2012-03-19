<?php

class BlogController extends Controller
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
	 * Displays a particular model
	 *
	 * @param string $url
	 */
	public function actionView($url)
	{
		$model = Blog::model()->find(array(
			'condition' => 'blog.status=:status AND blog.url=:url',
			'params' => array(
				':status' => Blog::STATUS_ENABLED,
				':url' => $url,
			),
		));
		if ($model === null)
			throw new CHttpException(404, 'Запрашиваемая страница не существует.');

		$this->render('view', array(
			'model' => $model,
			'prevPost' => Blog::model()->findPrev($model->id),
			'nextPost' => Blog::model()->findNext($model->id),
			'comment' => $this->newComment($model),
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Blog', array(
			'criteria' => array(
				'condition' => 'blog.status=:status',
				'params' => array(':status' => Blog::STATUS_ENABLED),
			),
			'pagination' => array(
				'pageSize' => Yii::app()->params['postsPageSize'],
			),
		));

		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * @param Blog $blog
	 * @return Comment
	 */
	public function newComment(Blog $blog)
	{
		$comment = new Comment;

		if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}

		if (isset($_POST['Comment']))
		{
			$comment->attributes = $_POST['Comment'];

			if ($blog->addComment($comment))
			{
				Yii::app()->user->setFlash('commentSubmitted', true);
				$this->refresh();
			}
		}

		return $comment;
	}

}
