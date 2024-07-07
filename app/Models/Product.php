<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];
//    protected static function booted(): void
//    {
//        static::addGlobalScope('store',function (Builder $builder){
//            $user=Auth::user();
//            if($user->store_id)
//            {
//                $builder->where('store_id','=',$user->store_id);
//            }
//
//        });
//    }
    protected static function booted()
    {
        static::addGlobalScopes([StoreScope::class]);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id',
        );
    }
//scope
    public function scopeActive(\Illuminate\Database\Eloquent\Builder $builder)
    {
        $builder->where('status','=','active');
    }

    //accessors

    protected function getImageUrlAttribute()
    {
        if(!$this->image)
        {
            return"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKnKnw0MtmVH5_-A-wrEh5OiTSL3lu_5MZZA&s";
        }
        if(Str::startsWith($this->image,['http://','https://']))
        {
            return $this->image;
        }
        return asset('storage/'.$this->image);

    }

    public function getSalePercentAttribute()
    {
        if(!$this->compare_price)
        {
            return 0;
        }
        return number_format(100-(100*$this->price / $this->compare_price),1) ;
    }


}
