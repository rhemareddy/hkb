<?php

/**
 * This is the model class for table "tbl_section_access".
 *
 * The followings are the available columns in table 'tbl_section_access':
 * @property integer $id
 * @property integer $category_id
 * @property integer $section_id
 * @property string $access_mode
 * @property string $added_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property TblAdminSection $section
 * @property TblAdminUser $user
 */
class SectionAccess extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_section_access';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('access_mode, added_at, updated_at', 'required'),
			array('category_id,section_id', 'numerical', 'integerOnly'=>true),
			array('access_mode', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,category_id,section_id,access_mode,added_at, updated_at', 'safe', 'on'=>'search'),
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
			'section' => array(self::BELONGS_TO, 'AdminSection', 'section_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'category_id' => 'Category',
			'section_id' => 'Section',
			'access_mode' => 'Access Mode',
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

		$criteria->compare('id',$this->id);
                $criteria->compare('category_id',$this->section_id);
		$criteria->compare('section_id',$this->section_id);
                $criteria->compare('access_mode',$this->access_mode,true);
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
	 * @return SectionAccess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
