<?php

namespace Modules\Apps\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Services\MagentoBridge;
use Modules\Apps\Transformers\Api\CategoryResource;

class CategoryController extends ApiController
{

    public function __construct()
    {
        $this->magento = new MagentoBridge();
    }

    public function index(Request $request)
    {
        $data = $this->magento->fireRequest('categories/list',[
            'searchCriteria' => [
                'pageSize' => $request['pageSize'] ,
                'currentPage' => $request['page'] ,
            ],
        ],'get');
        $data = CategoryResource::collection($data['items'] ?? []);

        return $this->response($data);
    }

    public function getChildren($parent_id,Request $request)
    {
        $data = $this->magento->fireRequest('categories',[
            'rootCategoryId' => $parent_id,
        ],'get');
        $data = new CategoryResource($data);

        return $this->response($data);
    }
}
