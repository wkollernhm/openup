<?php

/**
 * This is the model class for table "tbl_source_linnaeus_projects".
 *
 * The followings are the available columns in table 'tbl_source_linnaeus_projects':
 * @property string $name
 * @property string $language
 * @property string $rank
 * @property string $taxon
 * @property string $source
 */
class SourceLinnaeusProjects extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SourceLinnaeusProjects the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_source_linnaeus_projects';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, language, rank, taxon, source', 'required'),
            array('name, taxon', 'length', 'max' => 150),
            array('language', 'length', 'max' => 50),
            array('rank', 'length', 'max' => 15),
            array('source', 'length', 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('name, language, rank, taxon, source', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'name' => 'Name',
            'language' => 'Language',
            'rank' => 'Rank',
            'taxon' => 'Taxon',
            'source' => 'Source',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('rank', $this->rank, true);
        $criteria->compare('taxon', $this->taxon, true);
        $criteria->compare('source', $this->source, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
