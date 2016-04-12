<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "todolist".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $title
 * @property integer $status
 * @property string $params
 * @property string $updateDate
 */
class Todolist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'todolist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'status'], 'integer'],
            [['action'], 'string'],
            [['updateDate'], 'safe'],
            [['title'], 'string', 'max' => 255],
			[['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'title' => 'Title',
            'status' => 'Status',
            'action' => 'Action',
            'updateDate' => 'Update Date',
        ];
    }
	
	/**
     * @inheritdoc
     */
	public function getUserview()
    {
        return $this->hasOne(UserView::className(), ['id' => 'userId']);
    }
}
