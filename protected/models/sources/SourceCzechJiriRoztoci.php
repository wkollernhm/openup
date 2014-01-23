<?php

/**
 * This is the model class for table "tbl_source_czech_jiri_roztoci".
 *
 * The followings are the available columns in table 'tbl_source_czech_jiri_roztoci':
 * @property string $latin_name
 * @property string $czech_name
 * @property string $first_synonym
 * @property string $second_synonym
 */
class SourceCzechJiriRoztoci extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SourceCzechJiriRoztoci the static model class
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
		return 'tbl_source_czech_jiri_roztoci';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('latin_name, czech_name, first_synonym, second_synonym', 'required'),
			array('latin_name, czech_name, first_synonym, second_synonym', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('latin_name, czech_name, first_synonym, second_synonym', 'safe', 'on'=>'search'),
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
			'latin_name' => 'Latin Name',
			'czech_name' => 'Czech Name',
			'first_synonym' => 'First Synonym',
			'second_synonym' => 'Second Synonym',
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

		$criteria->compare('latin_name',$this->latin_name,true);
		$criteria->compare('czech_name',$this->czech_name,true);
		$criteria->compare('first_synonym',$this->first_synonym,true);
		$criteria->compare('second_synonym',$this->second_synonym,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}