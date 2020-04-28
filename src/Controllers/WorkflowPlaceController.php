<?php

namespace Wanna\LaravelWorkflowDatabase\Controllers;

use Illuminate\Routing\Controller;
use Osi\LaravelControllerTrait\Traits\ControllerBaseTrait;
use Wanna\LaravelWorkflowDatabase\Models\WorkflowPlace;

class WorkflowPlaceController extends Controller
{
    use ControllerBaseTrait;
    public function __construct(WorkflowPlace $model)
    {
        $this->model      = $model;
        $this->resource   = '\Osi\LaravelControllerTrait\Resources\Resource';
        $this->collection = '\Osi\LaravelControllerTrait\Resources\Collection';
        $this->functions  = get_class_methods(self::class);
    }

    public function storeRule($data)
    {
        return \Validator::make($data,
            [
                'title'       => ['required', 'string'],
                'workflow_id' => ['required', 'integer'],
            ], [], [
                'workflow_id' => '所属工作流',
                'title'       => '标题',
            ]
        )->validate();
    }

}
