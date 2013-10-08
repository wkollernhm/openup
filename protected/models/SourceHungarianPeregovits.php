<?php

/**
 * This is the model class for table "tbl_source_hungarian_peregovits".
 *
 * The followings are the available columns in table 'tbl_source_hungarian_peregovits':
 * @property string $Ordo
 * @property string $Family
 * @property string $Genus
 * @property string $species
 * @property string $Auctor_year
 * @property string $HU_Common_name
 * @property string $Period
 * @property integer $PUB_ID
 *
 * The followings are the available model relations:
 * @property SourceHungarianPeregovitsLiterature $pUB
 */
class SourceHungarianPeregovits extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SourceHungarianPeregovits the static model class
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
		return 'tbl_source_hungarian_peregovits';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PUB_ID', 'numerical', 'integerOnly'=>true),
			array('Ordo, Family, Genus, species, Auctor_year, HU_Common_name, Period', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Ordo, Family, Genus, species, Auctor_year, HU_Common_name, Period, PUB_ID', 'safe', 'on'=>'search'),
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
			'pUB' => array(self::BELONGS_TO, 'SourceHungarianPeregovitsLiterature', 'PUB_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Ordo' => 'Ordo',
			'Family' => 'Family',
			'Genus' => 'Genus',
			'species' => 'Species',
			'Auctor_year' => 'Auctor Year',
			'HU_Common_name' => 'Hu Common Name',
			'Period' => 'Period',
			'PUB_ID' => 'Pub',
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

		$criteria->compare('Ordo',$this->Ordo,true);
		$criteria->compare('Family',$this->Family,true);
		$criteria->compare('Genus',$this->Genus,true);
		$criteria->compare('species',$this->species,true);
		$criteria->compare('Auctor_year',$this->Auctor_year,true);
		$criteria->compare('HU_Common_name',$this->HU_Common_name,true);
		$criteria->compare('Period',$this->Period,true);
		$criteria->compare('PUB_ID',$this->PUB_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}