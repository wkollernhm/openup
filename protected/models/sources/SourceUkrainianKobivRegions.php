<?php

/**
 * This is the model class for table "tbl_source_ukrainian_kobiv_regions".
 *
 * The followings are the available columns in table 'tbl_source_ukrainian_kobiv_regions':
 * @property string $short
 * @property string $region
 */
class SourceUkrainianKobivRegions extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SourceUkrainianKobivRegions the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_source_ukrainian_kobiv_regions';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('short', 'length', 'max' => 6),
            array('region', 'length', 'max' => 36),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('short, region', 'safe', 'on' => 'search'),
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
            'short' => 'Short',
            'region' => 'Region',
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

        $criteria->compare('short', $this->short, true);
        $criteria->compare('region', $this->region, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}