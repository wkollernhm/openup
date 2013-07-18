<?php

/**
 * This is the model class for table "tbl_source_russian_plantarium".
 *
 * The followings are the available columns in table 'tbl_source_russian_plantarium':
 * @property integer $ID
 * @property string $scientific_name
 * @property string $author
 * @property string $russian_name
 * @property integer $type
 */
class SourceRussianPlantarium extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SourceRussianPlantarium the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_source_russian_plantarium';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, scientific_name, author, russian_name, type', 'required'),
			array('ID, type', 'numerical', 'integerOnly'=>true),
			array('scientific_name, russian_name', 'length', 'max'=>150),
			array('author', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, scientific_name, author, russian_name, type', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'scientific_name' => 'Scientific Name',
			'author' => 'Author',
			'russian_name' => 'Russian Name',
			'type' => 'Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('scientific_name',$this->scientific_name,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('russian_name',$this->russian_name,true);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}