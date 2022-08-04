<?php

namespace App\Helpers\Admin;
use Illuminate\Support\Facades\DB;
 class CategoryHelper{
    public static function category($categoryList){
        // $html="";
        // foreach($categoryList as $key=>$category){
        //     $html.='
        //         <tr>
        //             <td>'.$category->id.'</td>
        //             <td>'.$category->name.'</td>
        //             <td>'.$category->content.'</td>
        //             <td style=" width:200px;">
        //                 <a href="/admin/menus/edid/.$menu->id." style="padding-right:10px;">Chỉnh sửa </a>
        //                 <a href="#" onclick="removeRow('.$menu->id.',\'/admin/menus/destroy\')">Xóa</a>

        //             </td>
        //         <tr>
        //     ';
        $html="";
            foreach ($categoryList as $item){
         $html.='   <tr>
                <td>
                    <input type="checkbox" value="'.$item->id.'" class="check2"
                        name="ids.'[$item->id].'" onclick="check(this)">
                </td>
                <td>'.$item->id.'</td>
                <td>'.$item->category_name.'</td>
                <td></td>
                <td>'.$item->created_at.'</td>
                <td>'.$item->updated_at.'</td>
               </tr>';
        }
        return $html;
    }


    
 }