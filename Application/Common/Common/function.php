<?php

    function getSm($str)
    {
        // echo '公共函数';
        // die;
        $arr = explode('/',$str);
        $arr[3] = 'sm_'.$arr[3];
        $Sm_name = implode('/',$arr);
        return $Sm_name;
    }

    // 获取id
    function getID($cates,$id)
    {
        $arr_id=[];

        foreach($cates as $cate){
            $arr_id[] = $cate[$id];
        }

        // 去除重复id
        $arr_id = array_unique($arr_id);
        
        // 得到准确的ID号
        $id = '';
        foreach($arr_id as $ids)
        {
            $id .= $ids.',';
        }

        return rtrim($id,',');
    }
