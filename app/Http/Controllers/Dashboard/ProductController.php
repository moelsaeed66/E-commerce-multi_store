<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Product::class);//use policies

        $products=Product::with('category','store')->paginate(10);
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Product::class);
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',Product::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product=Product::findOrFail($id);
        $this->authorize('show',$product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Product::findOrFail($id);
        $this->authorize('update',$product);
             $tags=implode(',',$product->tags()->pluck('name')->toArray());
//             dd($product);
        return view('dashboard.products.edit',compact('product','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update',$product);

        $product->update($request->except('tag'));
        $saved_tags=Tag::all();
        $tags=json_decode($request->post('tag'));//if use package
        foreach ($tags as $item)
        {
            $slug=Str::slug($item->value);
            $tag=$saved_tags->where('slug',$slug)->first();
            if(!$tag){
                $tag= Tag::create([
                    'name'=>$item->value,
                    'slug'=>$slug
                ]);
            }
            $tag_ids[]=$tag->id;
        }


//
//        $tags=explode(',',$request->post('tag'));
//        $tag_ids=[];
//        $saved_tags=Tag::all();
//        foreach ($tags as $t_name)
//        {
//            $slug=Str::slug($t_name);
//           $tag=$saved_tags->where('slug',$slug)->first();
//           if(!$tag){
//               $tag= Tag::create([
//                   'name'=>$t_name,
//                   'slug'=>$slug
//               ]);
//           }
//           $tag_ids[]=$tag->id;
//        }

//        foreach ($tags as $t_name)
//        {
//            $slug=Str::slug($t_name);
//            $tag=Tag::where('slug',$slug)->first();
//            if(!$tag)
//            {
//                $tag= Tag::create([
//                    'name'=>$t_name,
//                    'slug'=>$slug
//                ]);
//            }
//            $tag_ids[]=$tag->id;
//        }
//        dd($tag_ids);
        $product->tags()->sync($tag_ids);
        return redirect()->route('products.index')
            ->with('success','product updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $this->authorize('delete',$product);

    }
}
