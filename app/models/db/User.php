<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%t_mike_user}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $mobile
 * @property string $email
 * @property string $password
 * @property integer $ctime
 * @property integer $utime
 * @property integer $valid
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'mobile', 'email', 'password', 'ctime', 'utime'], 'required'],
            [['id', 'ctime', 'utime', 'valid'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['mobile'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'mobile' => Yii::t('app', 'Mobile'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'ctime' => Yii::t('app', 'Ctime'),
            'utime' => Yii::t('app', 'Utime'),
            'valid' => Yii::t('app', 'Valid'),
        ];
    }
}
