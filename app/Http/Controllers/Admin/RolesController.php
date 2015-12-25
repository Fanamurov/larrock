<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Blocks\MenuBlock;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use Route;
use Validator;
use Sentinel;
use Session;
use Lang;
use Redirect;
use App\Models\RoleUsers;
use View;

class RolesController extends Controller
{
    protected $config;

    public function __construct(MenuBlock $menu)
    {
        $this->config = \Config::get('components.users');
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getName())->render());
		}
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('admin.roles.index', array('data' => Roles::all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.roles.create');
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
			Session::flash('success', Lang::get('apps.change.success'));
		}else{
			Session::flash('error', Lang::get('apps.change.error'));
		}

		return Redirect::to('/admin/roles');
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
		return view('admin.roles.edit', $data);
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
			return back()->withInput()->with('success', Lang::get('apps.change.success'));
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

		Session::flash('success', Lang::get('apps.delete.success'));
		return Redirect::to('/admin/roles');
    }
}
