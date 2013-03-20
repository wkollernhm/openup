<?php

/**
 * This is the model class for table "tbl_source_slovak_bratislava".
 *
 * The followings are the available columns in table 'tbl_source_slovak_bratislava':
 * @property string $fldName
 * @property string $fldNameSK_prefix
 * @property string $fldNameSK
 */
class SourceSlovakBratislava extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SourceSlovakBratislava the static model class
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
		return 'tbl_source_slovak_bratislava';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fldName, fldNameSK_prefix, fldNameSK', 'required'),
			array('fldName', 'length', 'max'=>150),
			array('fldNameSK_prefix, fldNameSK', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fldName, fldNameSK_prefix, fldNameSK', 'safe', 'on'=>'search'),
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
			'fldName' => 'Fld Name',
			'fldNameSK_prefix' => 'Fld Name Sk Prefix',
			'fldNameSK' => 'Fld Name Sk',
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

		$criteria->compare('fldName',$this->fldName,true);
		$criteria->compare('fldNameSK_prefix',$this->fldNameSK_prefix,true);
		$criteria->compare('fldNameSK',$this->fldNameSK,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}