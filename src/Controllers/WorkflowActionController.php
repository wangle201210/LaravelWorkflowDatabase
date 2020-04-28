<?php

namespace Wanna\LaravelWorkflowDatabase\Controllers;

use Illuminate\Routing\Controller;
use Osi\LaravelControllerTrait\Traits\ControllerBaseTrait;
use Wanna\LaravelWorkflowDatabase\Models\WorkflowAction;

class WorkflowActionController extends Controller
{
    use ControllerBaseTrait;
    public function __construct(WorkflowAction $model)
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
                'from_id'     => ['required', 'integer'],
                'to_id'       => ['required', 'integer'],
                'workflow_id' => ['required', 'integer'],
            ], [], [
                'title'       => '标题',
                'from_id'     => '起始状态',
                'to_id'       => '改后状态',
                'workflow_id' => '所属工作流',
            ]
        )->validate();
    }
}
