<?php

/**
 * This is the model class for table "tbl_source_hungarian_peregovits_literature".
 *
 * The followings are the available columns in table 'tbl_source_hungarian_peregovits_literature':
 * @property integer $PUB_ID
 * @property string $Authors
 * @property string $Title
 * @property integer $Year
 * @property string $Type
 * @property string $Series_journal_title
 * @property string $volume_no
 * @property string $Publisher
 * @property string $Publisher_city
 * @property string $edition
 * @property string $ISBN
 * @property integer $pages
 *
 * The followings are the available model relations:
 * @property SourceHungarianPeregovits[] $sourceHungarianPeregovits
 */
class SourceHungarianPeregovitsLiterature extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SourceHungarianPeregovitsLiterature the static model class
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
		return 'tbl_source_hungarian_peregovits_literature';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PUB_ID, Year, pages', 'numerical', 'integerOnly'=>true),
			array('Authors, Title, Series_journal_title', 'length', 'max'=>255),
			array('Type, volume_no, edition', 'length', 'max'=>10),
			array('Publisher, Publisher_city', 'length', 'max'=>100),
			array('ISBN', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PUB_ID, Authors, Title, Year, Type, Series_journal_title, volume_no, Publisher, Publisher_city, edition, ISBN, pages', 'safe', 'on'=>'search'),
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
			'sourceHungarianPeregovits' => array(self::HAS_MANY, 'SourceHungarianPeregovits', 'PUB_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PUB_ID' => 'Pub',
			'Authors' => 'Authors',
			'Title' => 'Title',
			'Year' => 'Year',
			'Type' => 'Type',
			'Series_journal_title' => 'Series Journal Title',
			'volume_no' => 'Volume No',
			'Publisher' => 'Publisher',
			'Publisher_city' => 'Publisher City',
			'edition' => 'Edition',
			'ISBN' => 'Isbn',
			'pages' => 'Pages',
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

		$criteria->compare('PUB_ID',$this->PUB_ID);
		$criteria->compare('Authors',$this->Authors,true);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Year',$this->Year);
		$criteria->compare('Type',$this->Type,true);
		$criteria->compare('Series_journal_title',$this->Series_journal_title,true);
		$criteria->compare('volume_no',$this->volume_no,true);
		$criteria->compare('Publisher',$this->Publisher,true);
		$criteria->compare('Publisher_city',$this->Publisher_city,true);
		$criteria->compare('edition',$this->edition,true);
		$criteria->compare('ISBN',$this->ISBN,true);
		$criteria->compare('pages',$this->pages);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}