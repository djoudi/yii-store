<?php

class BlogController extends Controller
{
	/**
	 * @return array
	 */
	public function behaviors()
	{
		return array(
			'comment' => array(
				'class' => 'ext.comment.CommentControllerBehavior',
			),
		);
	}

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
	 * @param int $id
	 */
	public function actionView($id)
	{
		$model = Blog::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'Запрашиваемая страница не существует.');

		$this->render('view', array(
			'model' => $model,
			'prevPost' => Blog::model()->findPrevPost($model->id),
			'nextPost' => Blog::model()->findNextPost($model->id),
			'comment' => $this->newComment($model),
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Blog', array(
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
