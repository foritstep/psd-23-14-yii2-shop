<?php

namespace app\models;

class Category extends \app\base\ActiveRecord {
    public static function tableName() {
        return 'category';
    }

    public function rules() {
        return [
            ['name', 'required'],
            ['name', 'string', 'min' => 4, 'max' => 100],
            ['parentId', 'exist', 'targetAttribute' => 'id'],
            ['name', 'unique', 'targetAttribute' => ['name', 'parentId']],
            [['createdAt', 'updatedAt'], 'safe']
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Name',
            'parentId' => 'Parent category',
            'createdAt' => 'Created at',
            'updatedAt' => 'Updated at'
        ];
    }

    public function getParent() {
        return $this->hasOne(self::className(), ['id' => 'parentId']);
    }

    public function getChilds() {
        return $this->hasMany(self::className(), ['parentId' => 'id']);
    }

    public function getProducts() {
        return $this->hasMany('app\models\Product', ['categoryId' => 'id']);
    }

    private static function buildTree($categories, $parentId = 0) {
        $result = [];

        foreach ($categories as $category) {
            if ($category->parentId == $parentId) {
                $childs = self::buildTree($categories, $category->id);
                if ($childs) {
                    $category->populateRelation('childs', $childs);
                }
                $result[] = $category;
            }
        }

        return $result;
    }

    private static function buildTreeList($tree, &$result, $level = 0) {
        foreach ($tree as $category) {
            $category->name = str_repeat('&nbsp;', 4 * $level) . $category->name;
            $result[] = $category;
            self::buildTreeList($category->childs, $result, $level + 1);
        }
    }

    public static function getCategoriesTree($query = null) {
        $query = $query ?: Category::find();

        return self::buildTree($query->all());
    }

    public static function getCategoriesTreeList($query = null) {
        $tree = self::getCategoriesTree($query);

        self::buildTreeList($tree, $list);

        return $list;
    }
}

/*
$category = Category::findOne(1);
var_dump($category->parent);
var_dump($category->childs);
var_dump($category->products);
*/

