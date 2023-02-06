<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "social".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $link
 * @property string|null $icon
 */
class Social extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'link', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'link' => 'Link',
            'icon' => 'Icon',
        ];
    }

    public static function getAll()
    {
        return Social::find()->all();
    }

    public function getImage() {
        return $this->icon;
    }
}
