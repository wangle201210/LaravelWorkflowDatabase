<?php

namespace Wanna\LaravelWorkflowDatabase\Controllers;

use Illuminate\Routing\Controller;
use Osi\LaravelControllerTrait\Traits\ControllerBaseTrait;
use Illuminate\Http\Request;
use Wanna\LaravelWorkflowDatabase\Models\WorkflowAction;
use Wanna\LaravelWorkflowDatabase\Models\Role;

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

    public function syncRole(Request $request)
    {
        $role_id = $request['role_id'];
        $action_id = $request['action_id'];
        $action = $this->model->findOrFail($action_id);
        $action->role()->sync($role_id);
        return $this->accepted();
    }

    public function roleCanDo($role_id)
    {
        $role = Role::with('action')->find($role_id);
        $res = collect();
        if (is_array($role_id)) {
            foreach ($role as $r) {
                $res = $res->merge($r->action->pluck('title'));
            }
            $res = $res->unique()->toArray();
        } else {
            $res = $role->action->pluck('title')->toArray();
        }
        return ['data' => $res];
    }

    public function iCanDo()
    {
        $roles = user()->roles->pluck('id');
        return $this->roleCanDo($roles->toArray());
    }
}
