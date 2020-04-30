<?php
use Illuminate\Support\Facades\Route;

Route::namespace('\Wanna\LaravelWorkflowDatabase\Controllers')
    ->prefix('api')
    ->middleware(['api','auth:admin'])
    ->group(function ($router) {
        $router->get('workflow/workflow', 'WorkflowController@workflow');
        $router->post('workflow_action/syncRole', 'WorkflowActionController@syncRole');
        $router->get('workflow_action/iCanDo', 'WorkflowActionController@iCanDo');
        $router->get('workflow_action/roleCanDo/{id}', 'WorkflowActionController@roleCanDo');
        $router->resources([
            'workflow'        => 'WorkflowController',
            'workflow_action' => 'WorkflowActionController',
            'workflow_place'  => 'WorkflowPlaceController',
        ]);
    });
