<?php

/**
 * This is the model class for table "{{products}}".
 *
 * The followings are the available columns in table '{{products}}':
 * @property integer $id
 * @property string $url
 * @property integer $brand_id
 * @property string $name
 * @property string $annotation
 * @property string $body
 * @property integer $visible
 * @property integer $position
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $created
 * @property integer $featured
 * @property string $external_id
 */
class Products extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{products}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, annotation, body, meta_title, meta_keywords, meta_description, created, external_id', 'required'),
			array('brand_id, visible, position, featured', 'numerical', 'integerOnly' => true),
			array('url', 'length', 'max' => 255),
			array('name, meta_title, meta_keywords, meta_description', 'length', 'max' => 500),
			array('external_id', 'length', 'max' => 36),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, url, brand_id, name, annotation, body, visible, position, meta_title, meta_keywords, meta_description, created, featured, external_id', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'brand' => array(self::HAS_ONE, 'Brands', 'brand_id'),
			'categories' => array(self::MANY_MANY, 'Categories',
				's_products_categories(product_id, category_id)'),
			'variants' => array(self::HAS_MANY, 'Variants', 'product_id',
				'order' => 'variants.position'),
			'images' => array(self::HAS_MANY, 'Images', 'product_id',
				'order' => 'images.product_id, images.position'),
			'features' => array(self::MANY_MANY, 'Features',
				's_options(product_id, feature_id)'),
			'related' => array(self::MANY_MANY, 'Products',
				's_related_products(product_id, related_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'url' => 'Url',
			'brand_id' => 'Brand',
			'name' => 'Name',
			'annotation' => 'Annotation',
			'body' => 'Body',
			'visible' => 'Visible',
			'position' => 'Position',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'created' => 'Created',
			'featured' => 'Featured',
			'external_id' => 'External',
		);
	}

	/**
	 * Ссылка на продукт
	 *
	 * @return mixed
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('product/view', array(
			'url' => $this->url,
		));
	}

	public function findRelated(array $products_ids)
	{
		return $this->with('related')->findAll(array(

		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('brand_id', $this->brand_id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('annotation', $this->annotation, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('visible', $this->visible);
		$criteria->compare('position', $this->position);
		$criteria->compare('meta_title', $this->meta_title, true);
		$criteria->compare('meta_keywords', $this->meta_keywords, true);
		$criteria->compare('meta_description', $this->meta_description, true);
		$criteria->compare('created', $this->created, true);
		$criteria->compare('featured', $this->featured);
		$criteria->compare('external_id', $this->external_id, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}