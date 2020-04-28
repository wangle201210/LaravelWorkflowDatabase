<?php

namespace Wanna\LaravelWorkflowDatabase\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Osi\LaravelControllerTrait\Traits\ControllerBaseTrait;
use Wanna\LaravelWorkflowDatabase\Models\Workflow;
use Workflow as WF;

class WorkflowController extends Controller
{
    use ControllerBaseTrait;
    public function __construct(Workflow $model)
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
                'title'           => ['required', 'string'],
                'type'            => ['required', 'string'],
                'supports'        => ['required', 'string'],
                'store_type'      => ['required', 'string'],
                'store_arguments' => ['required', 'string'],
                'para'            => ['nullable', 'array'],
                'remark'          => ['nullable', 'string'],
            ], [], [
                'type'            => '类型',
                'title'           => '标题',
                'supports'        => '模型',
                'store_type'      => '类型',
                'store_arguments' => '存储字段',
                'remark'          => '备注',
                'para'            => '其他参数',
            ]
        )->validate();
    }

    public function workflow(Request $request)
    {
        $res = $this->assemble($request['id']);
    }

    public function assemble($id)
    {
        $data = $this->model::with(['place', 'action' => function ($q) {
            return $q->with(['from', 'to']);
        }])->find($id);
        $workflow = [
            'supports'      => [$data['supports']],
            'type'          => $data['type'],
            'marking_store' => [
                'type'      => $data['store_type'],
                'arguments' => [$data['store_arguments']],
            ],
        ];
        $workflow['places'] = $data->place->pluck('title')->toArray();
        foreach ($data['action'] as $action) {
            $workflow['transitions'][$action['title']] = [
                'from' => $action['from']['title'],
                'to'   => $action['to']['title'],
            ];
        }
        config(['workflow' => [$data['title'] => $workflow]]);
        // $this->test();
        return $this->accepted();
    }

    public function test()
    {
        $post     = Company::find(1);
        $workflow = WF::get($post);
        $workflow->apply($post, '单位第一次上报'); //流程切换
        $post->save();
    }
}
