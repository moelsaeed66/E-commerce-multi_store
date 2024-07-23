<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\ImportProduct;
use Illuminate\Http\Request;

class ImportProductController extends Controller
{
    public function create()
    {
        return view('dashboard.products.import');

    }

    public function store(Request $request)
    {
//        $job=new ImportProduct($request->post('count'));
//        $this->dispatch($job)->onQueue('import');
        ImportProduct::dispatch($request->post('count'))->onQueue('import');

        return redirect()->route('products.index')->with('success','Import is Running.....');
    }
}
