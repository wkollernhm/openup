<?php

/**
 * This is the model class for table "tbl_source_hebrew_linda".
 *
 * The followings are the available columns in table 'tbl_source_hebrew_linda':
 * @property integer $ID1
 * @property string $alien
 * @property string $delete
 * @property string $ID
 * @property string $ID_concord
 * @property string $NPA_Species_Code
 * @property string $LatinName
 * @property string $NPA_Hebrew
 * @property string $Frag_Latin_No
 * @property string $CleanScientific_Name
 * @property string $CleanScientific
 * @property string $Name
 * @property string $empty
 * @property string $Frag_Hebrew
 * @property string $HebrewGenus
 * @property string $HebrewSpecies
 * @property string $Frag_Family_Code
 * @property string $Frag_Family_Name
 * @property string $matched_by_hand
 * @property string $new
 * @property string $merged
 * @property string $problematic
 * @property string $Field17
 * @property string $Field18
 * @property string $Field19
 * @property string $Field20
 * @property string $Field21
 * @property string $Field22
 * @property string $Field23
 * @property string $Field24
 * @property string $Field25
 */
class SourceHebrewLinda extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SourceHebrewLinda the static model class
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
		return 'tbl_source_hebrew_linda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID1', 'numerical', 'integerOnly'=>true),
			array('alien, matched_by_hand, new, merged', 'length', 'max'=>50),
			array('delete, ID, ID_concord, NPA_Species_Code, Frag_Latin_No, empty, Frag_Family_Code, Frag_Family_Name, Field17, Field18, Field19, Field20, Field21, Field22, Field23, Field24, Field25', 'length', 'max'=>10),
			array('LatinName, CleanScientific, Name, problematic', 'length', 'max'=>100),
			array('NPA_Hebrew', 'length', 'max'=>43),
			array('CleanScientific_Name', 'length', 'max'=>150),
			array('Frag_Hebrew', 'length', 'max'=>39),
			array('HebrewGenus', 'length', 'max'=>20),
			array('HebrewSpecies', 'length', 'max'=>18),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID1, alien, delete, ID, ID_concord, NPA_Species_Code, LatinName, NPA_Hebrew, Frag_Latin_No, CleanScientific_Name, CleanScientific, Name, empty, Frag_Hebrew, HebrewGenus, HebrewSpecies, Frag_Family_Code, Frag_Family_Name, matched_by_hand, new, merged, problematic, Field17, Field18, Field19, Field20, Field21, Field22, Field23, Field24, Field25', 'safe', 'on'=>'search'),
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
			'ID1' => 'Id1',
			'alien' => 'Alien',
			'delete' => 'Delete',
			'ID' => 'ID',
			'ID_concord' => 'Id Concord',
			'NPA_Species_Code' => 'Npa Species Code',
			'LatinName' => 'Latin Name',
			'NPA_Hebrew' => 'Npa Hebrew',
			'Frag_Latin_No' => 'Frag Latin No',
			'CleanScientific_Name' => 'Clean Scientific Name',
			'CleanScientific' => 'Clean Scientific',
			'Name' => 'Name',
			'empty' => 'Empty',
			'Frag_Hebrew' => 'Frag Hebrew',
			'HebrewGenus' => 'Hebrew Genus',
			'HebrewSpecies' => 'Hebrew Species',
			'Frag_Family_Code' => 'Frag Family Code',
			'Frag_Family_Name' => 'Frag Family Name',
			'matched_by_hand' => 'Matched By Hand',
			'new' => 'New',
			'merged' => 'Merged',
			'problematic' => 'Problematic',
			'Field17' => 'Field17',
			'Field18' => 'Field18',
			'Field19' => 'Field19',
			'Field20' => 'Field20',
			'Field21' => 'Field21',
			'Field22' => 'Field22',
			'Field23' => 'Field23',
			'Field24' => 'Field24',
			'Field25' => 'Field25',
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

		$criteria->compare('ID1',$this->ID1);
		$criteria->compare('alien',$this->alien,true);
		$criteria->compare('delete',$this->delete,true);
		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('ID_concord',$this->ID_concord,true);
		$criteria->compare('NPA_Species_Code',$this->NPA_Species_Code,true);
		$criteria->compare('LatinName',$this->LatinName,true);
		$criteria->compare('NPA_Hebrew',$this->NPA_Hebrew,true);
		$criteria->compare('Frag_Latin_No',$this->Frag_Latin_No,true);
		$criteria->compare('CleanScientific_Name',$this->CleanScientific_Name,true);
		$criteria->compare('CleanScientific',$this->CleanScientific,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('empty',$this->empty,true);
		$criteria->compare('Frag_Hebrew',$this->Frag_Hebrew,true);
		$criteria->compare('HebrewGenus',$this->HebrewGenus,true);
		$criteria->compare('HebrewSpecies',$this->HebrewSpecies,true);
		$criteria->compare('Frag_Family_Code',$this->Frag_Family_Code,true);
		$criteria->compare('Frag_Family_Name',$this->Frag_Family_Name,true);
		$criteria->compare('matched_by_hand',$this->matched_by_hand,true);
		$criteria->compare('new',$this->new,true);
		$criteria->compare('merged',$this->merged,true);
		$criteria->compare('problematic',$this->problematic,true);
		$criteria->compare('Field17',$this->Field17,true);
		$criteria->compare('Field18',$this->Field18,true);
		$criteria->compare('Field19',$this->Field19,true);
		$criteria->compare('Field20',$this->Field20,true);
		$criteria->compare('Field21',$this->Field21,true);
		$criteria->compare('Field22',$this->Field22,true);
		$criteria->compare('Field23',$this->Field23,true);
		$criteria->compare('Field24',$this->Field24,true);
		$criteria->compare('Field25',$this->Field25,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}