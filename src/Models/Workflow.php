<?php

namespace Wanna\LaravelWorkflowDatabase\Models;

use Illuminate\Database\Eloquent\Model;
use Osi\LaravelControllerTrait\Models\FilterAndSorting;

class Workflow extends Model
{
    use FilterAndSorting;
    protected $guarded = [];
    protected $casts   = [
        "para" => "json",
    ];
    public function place()
    {
        return $this->hasMany("Wanna\LaravelWorkflowDatabase\Models\WorkflowPlace");
    }

    public function action()
    {
        return $this->hasMany("Wanna\LaravelWorkflowDatabase\Models\WorkflowAction");
    }
}
