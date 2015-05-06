<?php

/**
 * This is the model class for table "tbl_room_tariff".
 *
 * The followings are the available columns in table 'tbl_room_tariff':
 * @property string $id
 * @property integer $room_id
 * @property string $tariff_date
 * @property double $price
 * @property integer $currency_id
 * @property string $added_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property TblRoom $room
 * @property TblCurrency $currency
 */
class RoomTariff extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_room_tariff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tariff_date, price, added_at, updated_at', 'required'),
			array('room_id, currency_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, room_id, tariff_date, price, currency_id, added_at, updated_at', 'safe', 'on'=>'search'),
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
			'room' => array(self::BELONGS_TO, 'Room', 'room_id'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'room_id' => 'Room',
			'tariff_date' => 'Tariff Date',
			'price' => 'Price',
			'currency_id' => 'Currency',
			'added_at' => 'Added At',
			'updated_at' => 'Updated At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('room_id',$this->room_id);
		$criteria->compare('tariff_date',$this->tariff_date,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('added_at',$this->added_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RoomTariff the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
