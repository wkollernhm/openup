<?php

/**
 * This is the model class for table "tbl_source_allearter_dk".
 *
 * The followings are the available columns in table 'tbl_source_allearter_dk':
 * @property string $Videnskabeligt_navn
 * @property string $Autor
 * @property string $Dansk_navn
 * @property string $Artsgruppe
 * @property string $Artsgruppe_dk
 * @property string $Taxontype
 * @property string $Taxonstatus
 * @property string $Rige
 * @property string $Rige_dk
 * @property string $Række
 * @property string $Række_dk
 * @property string $Underrække
 * @property string $Underrække_dk
 * @property string $Overklasse
 * @property string $Overklasse_dk
 * @property string $Klasse
 * @property string $Klasse_dk
 * @property string $Underklasse
 * @property string $Underklasse_dk
 * @property string $Infraklasse
 * @property string $Infraklasse_dk
 * @property string $Overorden
 * @property string $Overorden_dk
 * @property string $Orden
 * @property string $Orden_dk
 * @property string $Underorden
 * @property string $Underorden_dk
 * @property string $Infraorden
 * @property string $Infraorden_dk
 * @property string $Overfamilie
 * @property string $Overfamilie_dk
 * @property string $Familie
 * @property string $Familie_dk
 * @property string $Underfamilie
 * @property string $Underfamilie_dk
 * @property string $Tribus
 * @property string $Tribus_dk
 * @property string $Synonymer
 * @property string $Synonymer_dk
 * @property string $Referencenavn
 * @property integer $Referenceår
 * @property string $Referencetekst
 * @property string $Systematik
 * @property string $Forekomst
 * @property string $Økologi
 * @property string $Status
 * @property string $Dato
 * @property string $Sortering
 * @property string $Den_danske_rødliste
 * @property string $Fredede_arter
 * @property string $EF_habitatdirektivet
 * @property string $EF_fuglebeskyttelsesdirektivet
 * @property string $Bern_konventionen
 * @property string $Bonn_konventionen
 * @property string $CITES
 * @property string $Øvrige_forvaltningskategorier
 * @property string $NOBANIS
 * @property string $NOBANIS_herkomst
 * @property string $NOBANIS_etableringsstatus
 * @property string $NOBANIS_invasiv_optraeden
 */
class SourceAllearterDk extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SourceAllearterDk the static model class
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
		return 'tbl_source_allearter_dk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Referenceår', 'numerical', 'integerOnly'=>true),
			array('Videnskabeligt_navn', 'length', 'max'=>24),
			array('Autor', 'length', 'max'=>17),
			array('Dansk_navn, Artsgruppe, Taxonstatus, Række, Underrække_dk, Overklasse, Overklasse_dk, Underklasse, Underklasse_dk, Infraklasse, Infraklasse_dk, Overorden, Overorden_dk, Orden, Underorden_dk, Infraorden, Infraorden_dk, Overfamilie, Overfamilie_dk, Familie_dk, Underfamilie, Underfamilie_dk, Tribus, Tribus_dk, Synonymer, Synonymer_dk, Systematik, Forekomst, Økologi, Status, Dato, Sortering, Den_danske_rødliste, Fredede_arter, EF_habitatdirektivet, EF_fuglebeskyttelsesdirektivet, Bern_konventionen, Bonn_konventionen, CITES, Øvrige_forvaltningskategorier, NOBANIS, NOBANIS_herkomst, NOBANIS_etableringsstatus, NOBANIS_invasiv_optraeden', 'length', 'max'=>10),
			array('Artsgruppe_dk, Orden_dk', 'length', 'max'=>15),
			array('Taxontype', 'length', 'max'=>3),
			array('Rige, Underrække, Klasse_dk, Familie', 'length', 'max'=>8),
			array('Rige_dk', 'length', 'max'=>9),
			array('Række_dk', 'length', 'max'=>6),
			array('Klasse', 'length', 'max'=>7),
			array('Underorden', 'length', 'max'=>11),
			array('Referencenavn', 'length', 'max'=>14),
			array('Referencetekst', 'length', 'max'=>103),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Videnskabeligt_navn, Autor, Dansk_navn, Artsgruppe, Artsgruppe_dk, Taxontype, Taxonstatus, Rige, Rige_dk, Række, Række_dk, Underrække, Underrække_dk, Overklasse, Overklasse_dk, Klasse, Klasse_dk, Underklasse, Underklasse_dk, Infraklasse, Infraklasse_dk, Overorden, Overorden_dk, Orden, Orden_dk, Underorden, Underorden_dk, Infraorden, Infraorden_dk, Overfamilie, Overfamilie_dk, Familie, Familie_dk, Underfamilie, Underfamilie_dk, Tribus, Tribus_dk, Synonymer, Synonymer_dk, Referencenavn, Referenceår, Referencetekst, Systematik, Forekomst, Økologi, Status, Dato, Sortering, Den_danske_rødliste, Fredede_arter, EF_habitatdirektivet, EF_fuglebeskyttelsesdirektivet, Bern_konventionen, Bonn_konventionen, CITES, Øvrige_forvaltningskategorier, NOBANIS, NOBANIS_herkomst, NOBANIS_etableringsstatus, NOBANIS_invasiv_optraeden', 'safe', 'on'=>'search'),
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
			'Videnskabeligt_navn' => 'Videnskabeligt Navn',
			'Autor' => 'Autor',
			'Dansk_navn' => 'Dansk Navn',
			'Artsgruppe' => 'Artsgruppe',
			'Artsgruppe_dk' => 'Artsgruppe Dk',
			'Taxontype' => 'Taxontype',
			'Taxonstatus' => 'Taxonstatus',
			'Rige' => 'Rige',
			'Rige_dk' => 'Rige Dk',
			'Række' => 'Række',
			'Række_dk' => 'Række Dk',
			'Underrække' => 'Underrække',
			'Underrække_dk' => 'Underrække Dk',
			'Overklasse' => 'Overklasse',
			'Overklasse_dk' => 'Overklasse Dk',
			'Klasse' => 'Klasse',
			'Klasse_dk' => 'Klasse Dk',
			'Underklasse' => 'Underklasse',
			'Underklasse_dk' => 'Underklasse Dk',
			'Infraklasse' => 'Infraklasse',
			'Infraklasse_dk' => 'Infraklasse Dk',
			'Overorden' => 'Overorden',
			'Overorden_dk' => 'Overorden Dk',
			'Orden' => 'Orden',
			'Orden_dk' => 'Orden Dk',
			'Underorden' => 'Underorden',
			'Underorden_dk' => 'Underorden Dk',
			'Infraorden' => 'Infraorden',
			'Infraorden_dk' => 'Infraorden Dk',
			'Overfamilie' => 'Overfamilie',
			'Overfamilie_dk' => 'Overfamilie Dk',
			'Familie' => 'Familie',
			'Familie_dk' => 'Familie Dk',
			'Underfamilie' => 'Underfamilie',
			'Underfamilie_dk' => 'Underfamilie Dk',
			'Tribus' => 'Tribus',
			'Tribus_dk' => 'Tribus Dk',
			'Synonymer' => 'Synonymer',
			'Synonymer_dk' => 'Synonymer Dk',
			'Referencenavn' => 'Referencenavn',
			'Referenceår' => 'Referenceår',
			'Referencetekst' => 'Referencetekst',
			'Systematik' => 'Systematik',
			'Forekomst' => 'Forekomst',
			'Økologi' => 'Økologi',
			'Status' => 'Status',
			'Dato' => 'Dato',
			'Sortering' => 'Sortering',
			'Den_danske_rødliste' => 'Den Danske Rødliste',
			'Fredede_arter' => 'Fredede Arter',
			'EF_habitatdirektivet' => 'Ef Habitatdirektivet',
			'EF_fuglebeskyttelsesdirektivet' => 'Ef Fuglebeskyttelsesdirektivet',
			'Bern_konventionen' => 'Bern Konventionen',
			'Bonn_konventionen' => 'Bonn Konventionen',
			'CITES' => 'Cites',
			'Øvrige_forvaltningskategorier' => 'Øvrige Forvaltningskategorier',
			'NOBANIS' => 'Nobanis',
			'NOBANIS_herkomst' => 'Nobanis Herkomst',
			'NOBANIS_etableringsstatus' => 'Nobanis Etableringsstatus',
			'NOBANIS_invasiv_optraeden' => 'Nobanis Invasiv Optraeden',
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

		$criteria->compare('Videnskabeligt_navn',$this->Videnskabeligt_navn,true);
		$criteria->compare('Autor',$this->Autor,true);
		$criteria->compare('Dansk_navn',$this->Dansk_navn,true);
		$criteria->compare('Artsgruppe',$this->Artsgruppe,true);
		$criteria->compare('Artsgruppe_dk',$this->Artsgruppe_dk,true);
		$criteria->compare('Taxontype',$this->Taxontype,true);
		$criteria->compare('Taxonstatus',$this->Taxonstatus,true);
		$criteria->compare('Rige',$this->Rige,true);
		$criteria->compare('Rige_dk',$this->Rige_dk,true);
		$criteria->compare('Række',$this->Række,true);
		$criteria->compare('Række_dk',$this->Række_dk,true);
		$criteria->compare('Underrække',$this->Underrække,true);
		$criteria->compare('Underrække_dk',$this->Underrække_dk,true);
		$criteria->compare('Overklasse',$this->Overklasse,true);
		$criteria->compare('Overklasse_dk',$this->Overklasse_dk,true);
		$criteria->compare('Klasse',$this->Klasse,true);
		$criteria->compare('Klasse_dk',$this->Klasse_dk,true);
		$criteria->compare('Underklasse',$this->Underklasse,true);
		$criteria->compare('Underklasse_dk',$this->Underklasse_dk,true);
		$criteria->compare('Infraklasse',$this->Infraklasse,true);
		$criteria->compare('Infraklasse_dk',$this->Infraklasse_dk,true);
		$criteria->compare('Overorden',$this->Overorden,true);
		$criteria->compare('Overorden_dk',$this->Overorden_dk,true);
		$criteria->compare('Orden',$this->Orden,true);
		$criteria->compare('Orden_dk',$this->Orden_dk,true);
		$criteria->compare('Underorden',$this->Underorden,true);
		$criteria->compare('Underorden_dk',$this->Underorden_dk,true);
		$criteria->compare('Infraorden',$this->Infraorden,true);
		$criteria->compare('Infraorden_dk',$this->Infraorden_dk,true);
		$criteria->compare('Overfamilie',$this->Overfamilie,true);
		$criteria->compare('Overfamilie_dk',$this->Overfamilie_dk,true);
		$criteria->compare('Familie',$this->Familie,true);
		$criteria->compare('Familie_dk',$this->Familie_dk,true);
		$criteria->compare('Underfamilie',$this->Underfamilie,true);
		$criteria->compare('Underfamilie_dk',$this->Underfamilie_dk,true);
		$criteria->compare('Tribus',$this->Tribus,true);
		$criteria->compare('Tribus_dk',$this->Tribus_dk,true);
		$criteria->compare('Synonymer',$this->Synonymer,true);
		$criteria->compare('Synonymer_dk',$this->Synonymer_dk,true);
		$criteria->compare('Referencenavn',$this->Referencenavn,true);
		$criteria->compare('Referenceår',$this->Referenceår);
		$criteria->compare('Referencetekst',$this->Referencetekst,true);
		$criteria->compare('Systematik',$this->Systematik,true);
		$criteria->compare('Forekomst',$this->Forekomst,true);
		$criteria->compare('Økologi',$this->Økologi,true);
		$criteria->compare('Status',$this->Status,true);
		$criteria->compare('Dato',$this->Dato,true);
		$criteria->compare('Sortering',$this->Sortering,true);
		$criteria->compare('Den_danske_rødliste',$this->Den_danske_rødliste,true);
		$criteria->compare('Fredede_arter',$this->Fredede_arter,true);
		$criteria->compare('EF_habitatdirektivet',$this->EF_habitatdirektivet,true);
		$criteria->compare('EF_fuglebeskyttelsesdirektivet',$this->EF_fuglebeskyttelsesdirektivet,true);
		$criteria->compare('Bern_konventionen',$this->Bern_konventionen,true);
		$criteria->compare('Bonn_konventionen',$this->Bonn_konventionen,true);
		$criteria->compare('CITES',$this->CITES,true);
		$criteria->compare('Øvrige_forvaltningskategorier',$this->Øvrige_forvaltningskategorier,true);
		$criteria->compare('NOBANIS',$this->NOBANIS,true);
		$criteria->compare('NOBANIS_herkomst',$this->NOBANIS_herkomst,true);
		$criteria->compare('NOBANIS_etableringsstatus',$this->NOBANIS_etableringsstatus,true);
		$criteria->compare('NOBANIS_invasiv_optraeden',$this->NOBANIS_invasiv_optraeden,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}