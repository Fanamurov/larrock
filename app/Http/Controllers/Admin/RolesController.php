<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use Validator;
use Sentinel;
use Session;
use Lang;
use Redirect;
use App\Models\RoleUsers;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('admin.roles.rolesIndex', array('data' => Roles::all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.roles.rolesCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validator = Validator::make(
			$request->all(),
			[
				'slug' => 'min:4|required|unique:roles',
				'name' => 'min:4|required'
			]
		);

		if($validator->fails()){
			return back()->withInput()->withErrors($validator);
		}

		if(Sentinel::getRoleRepository()->createModel()->create($request->all())){
			Session::flash('message', Lang::get('apps.change.success'));
		}else{
			Session::flash('error', Lang::get('apps.change.error'));
		}

		return Redirect::to('/admin/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$data['roles'] = Sentinel::findRoleById($id);
		return view('admin.roles.rolesEdit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$validator = Validator::make(
			$request->all(),
			[
				'slug' => 'min:4|required',
				'name' => 'min:4|required'
			]
		);

		if($validator->fails()){
			return back()->withInput()->withErrors($validator);
		}

		$role = Sentinel::findRoleById($id);

		if($role->update($request->all())){
			return back()->withInput()->with('message', Lang::get('apps.change.success'));
		}else{
			return back()->withInput()->withErrors(array('messages' => Lang::get('users.change_failed')));
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		//Find users by destroy role
		if(RoleUsers::whereRoleId($id)){
			Session::flash('error', 'У роли есть назначенные пользователи');
			return back()->withInput();
		}

		$role = Sentinel::findRoleById($id);
		$role->delete();

		Session::flash('message', Lang::get('apps.delete.success'));
		return Redirect::to('/admin/roles');
    }
}
