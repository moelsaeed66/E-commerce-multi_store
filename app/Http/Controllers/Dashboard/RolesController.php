<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=Role::paginate();
        return view('dashboard.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.roles.create',[
            'role'=>new Role()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string','max:255'],
            'abilities'=>['required','array']
        ]);

        $role=Role::createWithAbilities($request);
//        $role=Role::create([
//            'name'=>$request->name
//        ]);
//
//        foreach ($request->post('abilities') as $ability)
//
//        {
//            RoleAbility::create([
//                'role_id'=>$role->id,
//                'type'=>'allow',
//                'ability'=>$ability
//
//            ]);
//        }
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $role_abilities=$role->abilities()->pluck('type','ability')->toArray();
        return view('dashboard.roles.edit',compact('role','role_abilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>['required','string','max:255'],
            'abilities'=>['required','array']
        ]);

        $role->updateWithAbilities($request);

        return redirect()->route('dashboard.roles.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
        return redirect()->route('roles.index');
    }
}
