<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded=[];
    public static function rules($id=0)
    {
        return [
            'name'=>['required',
                'string',
                'min:2',
                'max:255',
                Rule::unique('categories','name')->ignore($id),
//                function($attribute,$value,$message)
//                {
//                    if(strtolower($value)=='laravel')
//                    {
//                        return $message('this name not found');
//                    }
//
//                },
//            new Filter('laravel'),
            'filter:php,laravel'

            ],
            'parent_id'=>['nullable','int','exists:categories,id'],
            'image'=>['max:1048576','dimensions:min_width=100,min_height=100'],
            'status'=>['required','in:active,archived']
        ];
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','id')
            ->withDefault([
                'name'=> '.']);
    }

    public function child()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function scopeActive(\Illuminate\Database\Eloquent\Builder $builder)
    {
        $builder->where('status','=','active');
    }
    public function scopeStatus(\Illuminate\Database\Eloquent\Builder $builder,$status)
    {
        $builder->where('status','=',$status);
    }
    public function scopeFilter(\Illuminate\Database\Eloquent\Builder $builder,$filter)
    {
        $builder->when($filter['name']??false,function ($builder,$value){
            $builder->where('categories.name','LIKE',"%{$value}%");
        });

        $builder->when($filter['status']??false,function ($builder,$value){
            $builder->where('categories.status','=',$value);
        });
//        if($filter['name']??false)
//        {
//            $builder->where('name','LIKE',"%{$filter['name']}%");
//        }
//        if($filter['status']??false)
//        {
//            $builder->where('status','=',$filter['status']);
//        }
    }
}
