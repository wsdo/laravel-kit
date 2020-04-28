<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class BaseModel extends Model
{
    //
    static $PrimaryKey = 'id';
    static function DataInsert($tableName,$inserts)
    {
        if (!DB::table($tableName)->insert($inserts)) {
            return '插入失败!';
        }

        return '插入成功!';
    }

    static function DataUpdate($tableName,$id, $update)
    {
        $res = DB::table($tableName)->where('id', $id)->update($update);
        if (!$res) {
            return '修改'.$res.'条数据';
        }
        return '修改成功!';
    }

    static function DataDetail($TableName, $Columns, $id)
    {
        $res = [];
        $row = DB::table($TableName)
            ->select($Columns)
            ->where(self::$PrimaryKey, $id)
            ->first();
        // foreach ($Columns as $column) {
        //     $res[$column] = $row->{$column};
        // }
        return $row;
    }

    static function DataList($TableName,$Columns)
    {
        $res = ['items' => [], 'total' => 0];

        # 1.接收参数
        // filters
        $id = request('id', '');
        $title = request('title', '');
        $category_id = request('category_id', 0);
        // pagination
        $pageSize = request('pageSize', 10);
        $current = request('current', 1);
        // sorter
        $field = request('field', self::$PrimaryKey);
        $order = request('order', 'desc');

        # 2.拼接SQL条件
        $where = [];
        if (isset($category_id) && $category_id) {
            array_push($where, ['parent_id', '=', $category_id]);
        }

        if ($title) {
            array_push($where, ['title', 'ilike', '%' . $title . '%']);
        }
        # 3.执行查询
        $res['total'] = DB::table($TableName)->where($where)->count(self::$PrimaryKey);
        if ($res['total'] === 0) {
            return $res;
        }
        # items
        $items = DB::table($TableName)
            ->select(self::$PrimaryKey)
            ->where($where)
            ->skip(($current - 1) * $pageSize)
            ->take($pageSize)
            ->orderBy($field ? $field : self::$PrimaryKey, $order === 'ascend' ? 'asc' : 'desc')
            ->get();
        foreach ($items as $item) {
            $res['items'][] = self::DataDetail($TableName, $Columns, $item->{self::$PrimaryKey});
        }

        return $res;
    }

    /**
     * @param $table
     * @return mixed
     * 获取所有的字段
     */
    public function getAllCloumns($table){
        $fields = Schema::getColumnListing($table);
        return $fields;
    }
    public function checkCloumn($table,$data){
        $keys = array_keys($data);
        foreach ($keys as $row=>$val){
            if(!Schema::hasColumn($table,$val)){
                unset($data[$val]);
            }
        }
        return $data;
    }
}
