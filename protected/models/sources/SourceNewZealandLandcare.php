<?php
/**
 * This is the model class for table "tbl_source_newZealand_landcare".
 *
 * The followings are the available columns in table 'tbl_source_newZealand_landcare':
 * @property string $nameguid
 * @property string $NameFull
 * @property string $VernacularGuid
 * @property string $VernacularName
 * @property string $ReferenceGenCitation
 * @property string $GeoRegionName
 * @property string $LanguageEnglish
 * @property string $LanguageISOCode
 */
class SourceNewZealandLandcare extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SourceNewZealandLandcare the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_source_newZealand_landcare';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nameguid, VernacularGuid', 'length', 'max' => 36),
            array('NameFull, VernacularName', 'length', 'max' => 200),
            array('ReferenceGenCitation', 'length', 'max' => 255),
            array('GeoRegionName', 'length', 'max' => 100),
            array('LanguageEnglish', 'length', 'max' => 30),
            array('LanguageISOCode', 'length', 'max' => 6),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('nameguid, NameFull, VernacularGuid, VernacularName, ReferenceGenCitation, GeoRegionName, LanguageEnglish, LanguageISOCode', 'safe', 'on' => 'search'),
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
            'nameguid' => 'Nameguid',
            'NameFull' => 'Name Full',
            'VernacularGuid' => 'Vernacular Guid',
            'VernacularName' => 'Vernacular Name',
            'ReferenceGenCitation' => 'Reference Gen Citation',
            'GeoRegionName' => 'Geo Region Name',
            'LanguageEnglish' => 'Language English',
            'LanguageISOCode' => 'Language Isocode',
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

        $criteria->compare('nameguid', $this->nameguid, true);
        $criteria->compare('NameFull', $this->NameFull, true);
        $criteria->compare('VernacularGuid', $this->VernacularGuid, true);
        $criteria->compare('VernacularName', $this->VernacularName, true);
        $criteria->compare('ReferenceGenCitation', $this->ReferenceGenCitation,
                true);
        $criteria->compare('GeoRegionName', $this->GeoRegionName, true);
        $criteria->compare('LanguageEnglish', $this->LanguageEnglish, true);
        $criteria->compare('LanguageISOCode', $this->LanguageISOCode, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
}