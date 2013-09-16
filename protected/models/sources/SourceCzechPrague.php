<?php

/**
 * This is the model class for table "tbl_source_czech_prague".
 *
 * The followings are the available columns in table 'tbl_source_czech_prague':
 * @property string $Cele_jmeno
 * @property integer $ID
 * @property string $Kubat_NE
 * @property string $Celed
 * @property string $Rod
 * @property string $Druh_epitet
 * @property string $infra_rank
 * @property string $infra_epithet
 * @property string $sl_sstr
 * @property string $Autor
 * @property string $Synonyma
 * @property string $Ceske_jmeno
 */
class SourceCzechPrague extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SourceCzechPrague the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_source_czech_prague';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ID', 'numerical', 'integerOnly' => true),
            array('Cele_jmeno', 'length', 'max' => 69),
            array('Kubat_NE', 'length', 'max' => 6),
            array('Celed', 'length', 'max' => 17),
            array('Rod, infra_epithet', 'length', 'max' => 18),
            array('Druh_epitet', 'length', 'max' => 36),
            array('infra_rank', 'length', 'max' => 11),
            array('sl_sstr', 'length', 'max' => 7),
            array('Autor, Ceske_jmeno', 'length', 'max' => 86),
            array('Synonyma', 'length', 'max' => 260),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Cele_jmeno, ID, Kubat_NE, Celed, Rod, Druh_epitet, infra_rank, infra_epithet, sl_sstr, Autor, Synonyma, Ceske_jmeno', 'safe', 'on' => 'search'),
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
            'Cele_jmeno' => 'Cele Jmeno',
            'ID' => 'ID',
            'Kubat_NE' => 'Kubat Ne',
            'Celed' => 'Celed',
            'Rod' => 'Rod',
            'Druh_epitet' => 'Druh Epitet',
            'infra_rank' => 'Infra Rank',
            'infra_epithet' => 'Infra Epithet',
            'sl_sstr' => 'Sl Sstr',
            'Autor' => 'Autor',
            'Synonyma' => 'Synonyma',
            'Ceske_jmeno' => 'Ceske Jmeno',
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

        $criteria->compare('Cele_jmeno', $this->Cele_jmeno, true);
        $criteria->compare('ID', $this->ID);
        $criteria->compare('Kubat_NE', $this->Kubat_NE, true);
        $criteria->compare('Celed', $this->Celed, true);
        $criteria->compare('Rod', $this->Rod, true);
        $criteria->compare('Druh_epitet', $this->Druh_epitet, true);
        $criteria->compare('infra_rank', $this->infra_rank, true);
        $criteria->compare('infra_epithet', $this->infra_epithet, true);
        $criteria->compare('sl_sstr', $this->sl_sstr, true);
        $criteria->compare('Autor', $this->Autor, true);
        $criteria->compare('Synonyma', $this->Synonyma, true);
        $criteria->compare('Ceske_jmeno', $this->Ceske_jmeno, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}
