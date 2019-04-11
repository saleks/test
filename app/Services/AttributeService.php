<?php
/**
 * Created by PhpStorm.
 * User: salex
 * Date: 11.04.19
 * Time: 17:32
 */

namespace App\Services;


use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeService
{
    protected $attribute;

    public function __construct()
    {
        $this->attribute = new Attribute();
    }

    public function store(Request $request)
    {
        $this->attribute->fill($request->except('_token'));
        $this->attribute->save();
        return;
    }
}