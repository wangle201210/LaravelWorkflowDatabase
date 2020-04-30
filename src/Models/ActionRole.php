<?php

namespace Wanna\LaravelWorkflowDatabase\Models;

use Illuminate\Database\Eloquent\Model;
use Osi\LaravelControllerTrait\Models\FilterAndSorting;

class ActionRole extends Model
{
    use FilterAndSorting;
    protected $guarded = [];

    public function action()
    {
        return $this->belongsTo("Wanna\LaravelWorkflowDatabase\Models\WorkflowAction");
    }

    public function role()
    {
        return $this->belongsTo("Wanna\LaravelWorkflowDatabase\Models\Role");
    }
}
