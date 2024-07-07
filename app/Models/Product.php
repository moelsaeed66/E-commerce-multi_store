<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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


}
