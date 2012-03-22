<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Евгений
 * Date: 22.03.12
 * Time: 10:52
 * To change this template use File | Settings | File Templates.
 */
class TaobaoController extends Controller
{

	/**
	 * @param string $term
	 */
	public function actionSearch($term)
	{
		if (Yii::app()->request->isAjaxRequest)
		{
			if (!empty($term))
			{
				Yii::import('application.extensions.taobao.request.*');
				$request = new ItemsSearchRequest;
				$request->setQ($term);
				$request->setFields('title,pic_url');
				$shop = Yii::app()->taobao->execute($request);

				if (isset($shop->item_search))
					echo CJSON::encode($shop->item_search->items->item);
			}

			Yii::app()->end();
		}
	}

}