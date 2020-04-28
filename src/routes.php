<?php

$router = app('router');
$router->namespace('\Wanna\LaravelWorkflowDatabase\Controllers')
    ->prefix('api')
    ->middleware(['api'])
    ->group(function ($router) {
        $router->get('workflow/workflow', 'WorkflowController@workflow');
        $router->resources([
            'workflow'        => 'WorkflowController',
            'workflow_action' => 'WorkflowActionController',
            'workflow_place'  => 'WorkflowPlaceController',
        ]);
    });
