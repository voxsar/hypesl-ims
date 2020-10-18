<?php

namespace App\Http\Middleware;

use Log;
use Closure;

class DynamicInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->has("_dynamic")){
            foreach ($request->_dynamic as $dynamic_name) {
                # code...
                $value = array();
                $value[$dynamic_name] = $this->dynamicInputAttributePrepare($request->{$dynamic_name});
                $request->merge($value);
            }
        }
        $request->merge($this->customeDynamicAttributePrepare($request));
        return $next($request);
    }

    public function customeDynamicAttributePrepare($customfields)
    {
        # code...
        $requestCollection = collect($customfields);
        $requestCollection = $requestCollection->filter(function ($value, $key) {
            if($this->endsWith($key, '_dynamic')){
                return true;
            }else{
                return false;
            }
        });

        $array = array();
        //$requestCollection->each(function ($customDynamic, $item1) use($array){

        foreach ($requestCollection as $key0 => $customDynamic) {
            # code...
            foreach ($customDynamic as $key1 => $value1) {
                # code...
                foreach ($value1 as $key2 => $value2) {
                    # code...
                    $array[$key0][$key2][$key1] = $value2;
                }
            }
        };

        return $array;
    }

    //checks if string ends with
    function endsWith($haystack, $needle) {
        if(strlen($haystack) == strlen($needle)){
            return !substr_compare($haystack, $needle, -strlen($needle)) === 0;
        }
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }

    public function dynamicInputAttributePrepare($customfields)
    {
        $customfield = array();
        if(!is_array($customfields)){
            return array();
        }
        foreach ($customfields["label"] as $key => $value) {
            if(array_key_exists("type", $customfields)){
                $customfield[] = ["label" => $value, "type" => $customfields["type"][$key], "value" => $customfields["data"][$key]];
            }
        }
        return $customfield;
    }
}
