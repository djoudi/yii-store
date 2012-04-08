<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 07.04.12
 * Time: 10:03
 * To change this template use File | Settings | File Templates.
 */
class OrderController extends CController
{

	public function actionView($id)
	{
		$order = Order::model()->findByPk($id);
		if ($order === null)
			throw new CHttpException(404, 'Запрашиваемая страница не существует.');

		$this->render('view', array(
			'order' => $order,
		));
	}

}
