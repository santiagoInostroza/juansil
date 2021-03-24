<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $producto = $this->route()->parameter('producto');

        $rules = [
            'name' => 'required',
            'slug' => "required",
            'status' => 'required|in:1,2',
            'file' => 'image'
        ];

        if($producto){
          $rules['slug'] = "required|unique:products,slug,$producto->id";
        }
        

        if($this->status==1){
            $rules = array_merge($rules,[
                'category_id'=>'required',
                'brand_id'=>'required',
            ]);
        }
        return $rules;
    }
}
