<?php

namespace App\Components;

use App\Menu;

class MenuRecursive
{
    private $html;

    public function __construct()
    {
        $this->html = '';
    }

    public function menuRecursiveAdd($parentId = 0, $subMark = '')
    {
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $value) {
            $this->html .= '<option value="' . $value->id . '">' . $subMark . $value->name . '</option>';
            $this->menuRecursiveAdd($value->id, $subMark . '--');
        }
        return $this->html;
    }

    public function menuRecursiveEdit($id, $parentId = 0, $subMark = '')
    {
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $value) {
            if (!empty($id) && $value->id == $id){
                $this->html .= '<option selected value="' . $value->id . '">' . $subMark . $value->name . '</option>';
            } else {
                $this->html .= '<option value="' . $value->id . '">' . $subMark . $value->name . '</option>';
            }
            $this->menuRecursiveEdit($id, $value->id, $subMark . '--');
        }
        return $this->html;
    }
}
