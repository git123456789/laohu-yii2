<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property string $id
 * @property string $key
 * @property string $value
 * @property string $description
 * @property string $tag
 * @property string $status
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class SettingBase extends \app\modules\core\extensions\HuActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['value', 'status'], 'string'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['key', 'tag'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 200],
            [['key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => '键',
            'value' => '值',
            'description' => '描述',
            'tag' => '标记',
            'status' => '状态',
            'created_by' => '创建者',
            'updated_by' => '最后操作者',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }
}
