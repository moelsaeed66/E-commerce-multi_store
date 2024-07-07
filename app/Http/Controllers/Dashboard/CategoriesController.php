<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request=request(); //another sol
        $query=Category::all();
//        $categories=Category::leftJoin('categories as parents' ,'parents.id','=','categories.parent_id')
//            ->select([
//                'categories.*',
//                'parents.name as parent_name'
//            ])
//            ->filter($query)
//            ->paginate(2);
//
        $categories=Category::with('parent')
//            ->select('categories.*')
//            ->selectRaw('(SELECT count(*) FROM products where category_id = categories.id) as products_count')
//                ->withCount('products')
                ->withCount([
                    'products'=>function($query)
                    {
                        $query->with('status','=','active');
                    }
            ])
            ->filter($query)
            ->orderBy('categories.name')
            ->paginate(4);

//        if($name=$request->query('name'))
//        {
//            $query->where('name','LIKE',"%{$name}%");
//        }
//        if($status=$request->query('status'))
//        {
//            $query->where('status','=',$status);
//        }

//        $categories=$query->paginate(1);
//        $categories=Category::active()->paginate(2);
//        $categories=Category::status('active')->paginate(1);
//        dd($categories);
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents=Category::all();
        $categories=new Category();
        return view('dashboard.categories.create',compact('parents','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Category::rules(),[
            'unique'=>'this name already exist',
            'required'=>'this field(:attribute) is required'
        ]);
        $request->merge([
            'slug'=>Str::slug($request->name),
        ]);
        $data=$request->except('image');

        $data['image']=$this->uploadImage($request);

//        dd($data);
        Category::create($data);
        return redirect()->route('categories.index')->with('success','category created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category=Category::findOrFail($id);
        return view('dashboard.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=Category::findorFail($id);
//        if(!$categories)
//        {
//            abort(404);
//        }
        $parents=Category::where('id','!=',$id )->
        where(function ($query)use ($id){
            $query->whereNull('parent_id')
                ->orwhere('parent_id','!=',$id);
        })->get();
//        dd($categories);
        return view('dashboard.categories.edit',compact('categories','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
//        $request->validate($request->rules($id));

        $category=Category::findorFail($id);
        $old_image=$category->image;
        $data=$request->except('image');
        $new_image=$this->uploadImage($request);
        if($new_image)
        {
            $data['image']=$new_image;
        }


        $category->update($data);

//        if($old_image&&$new_image)
//        {
//            Storage::disk('public')->delete($old_image);
//        }
        return redirect()->route('categories.index')->with('success','category updated');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
//        $category=Category::findorFail($id);
        $category->delete();
//        if($category->image)
//        {
//            Storage::disk('public')->delete($category->image);
//        }
//        Category::destroy($id);

        return redirect()->route('categories.index')->with('success','category deleted');
    }
    protected function uploadImage(Request $request)
    {
        if(!$request->hasFile('image'))
        {
            return;
        }
            $file=$request->file('image');
            $path=$file->store('uploads','public');
            return $path;
    }
    public function trash()
    {
        $categories=Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    }
    public function restore(Request $request,string $id)
    {
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('categories.trash')->with('success','category restored');
    }
    public function forceDelete(string $id)
    {
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if($category->image)
        {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('categories.trash')->with('success','category deleted forever');
    }
}
