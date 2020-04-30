<?php

namespace Wanna\LaravelWorkflowDatabase\Models;

class Role extends \Moell\Mojito\Models\Role
{
    public function action()
    {
    	return $this->belongsToMany('Wanna\LaravelWorkflowDatabase\Models\WorkflowAction','action_roles','role_id','action_id');
    }
}
