<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
    public $Type;
    
    public function getEnumList($field)
    {
        $res = array();
        
        
        $sql = 'SHOW COLUMNS FROM ' . $this->tableName() . ' LIKE "' . $field . '"';
        $row = $this->findBySql($sql)->one();
        
        if (substr($row->Type, 0, 4) !== 'enum') {
            return false;
        }
        
        eval('$vlist = array' . substr($row->Type, 4) . ';');            
        
        foreach($vlist as $item) {
            $res[$item] = $item;
        }

        return $res;
    }
}