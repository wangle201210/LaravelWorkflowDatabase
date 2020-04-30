<?php
if (!function_exists('wanna')) {
    function wanna()
    {
        return true;
    }
}
if (!function_exists('configSave')) {
    function configSave($file)
	{
	    $path = config_path($file.'.php');
	    $content = config($file);
	    $content = var_export($content, true);
	    $code = '<?php '.PHP_EOL.' return ' . $content . ';';
	    $path = normalize_path($path, false);
	    File::put($path, $code,true);
	}
}
if (!function_exists('configSave')) {
    function configSave($file)
	{
	    $path = config_path($file.'.php');
	    $content = config($file);
	    $content = var_export($content, true);
	    $code = '<?php '.PHP_EOL.' return ' . $content . ';';
	    $path = normalize_path($path, false);
	    File::put($path, $code,true);
	}
}
if (!function_exists('wfContr')) {
    function wfContr()
	{
		return new Wanna\LaravelWorkflowDatabase\Controllers\WorkflowActionController(new Wanna\LaravelWorkflowDatabase\Models\WorkflowAction);
	}
}
if (!function_exists('wfRoleCanDo')) {
    function wfRoleCanDo($role_id)
	{
	    return wfContr()->roleCanDo($role_id);
	}
}
if (!function_exists('wfICanDo')) {
    function wfICanDo()
	{
	    return wfContr()->iCanDo();
	}
}
