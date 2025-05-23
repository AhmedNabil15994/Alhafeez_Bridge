<?php

namespace Modules\Apps\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $childrens = [];
        $attrs = [];


        if(isset($this['children_data'])){
            $childrens = self::collection($this['children_data']);
        }else{
            $attrs = getCategoryAttr($this);
        }

        return [
            'id'            => $this['id'],
            'name'          => $this['name'],
            'parent_id'         => $this['parent_id'],
            'position'         => $this['position'],
            'level'         => $this['level'],
            'include_in_menu'   => $this['include_in_menu'] ?? 0,
            'status'         => $this['is_active'] ?? false ,
            'children'       => $childrens,
            'attributes' =>  $attrs,
        ];
    }
}
