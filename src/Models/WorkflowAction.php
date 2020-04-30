<?php

namespace Wanna\LaravelWorkflowDatabase\Models;

use Illuminate\Database\Eloquent\Model;
use Osi\LaravelControllerTrait\Models\FilterAndSorting;

class WorkflowAction extends Model
{
    use FilterAndSorting;
    protected $guarded = [];

    public function from()
    {
        return $this->belongsTo("Wanna\LaravelWorkflowDatabase\Models\WorkflowPlace");
    }

    public function to()
    {
        return $this->belongsTo("Wanna\LaravelWorkflowDatabase\Models\WorkflowPlace");
    }

    public function role()
    {
        return $this->belongsToMany('Wanna\LaravelWorkflowDatabase\Models\Role','action_roles','action_id','role_id');
    }
}
