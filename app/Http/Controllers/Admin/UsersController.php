<?php

namespace App\Http\Controllers\Admin;

use App\Models\Roles;
use App\Models\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang;
use Validator;
use Sentinel;
use Input;
use Session;
use Redirect;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('admin.users.usersIndex', array('data' => Users::all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.users.usersCreate', array('roles' => Roles::all()));
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
			Input::all(),
			[
				'email' => 'email|min:4|required',
				'password' => 'min:5|required',
				'first_name' => 'max:40',
				'last_name' => 'max:40',
			]
		);

		if($validator->fails()){
			return back()->withInput(Input::except('password'))->withErrors($validator);
		}


		// Register a new user
		Sentinel::register([
			'email'    => $request->input('email'),
			'password' => $request->input('password'),
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
		]);

		$user = Users::whereEmail($request->input('email'))->first();

		$role = Sentinel::findRoleByName($request->input('role'));

		if($role->users()->attach($user)){
			Session::flash('message', Lang::get('apps.change.success'));
		}

		return Redirect::to('/admin/users');
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
		$data['roles'] = Roles::all();
		$data['users'] = Users::find($id)->get();
		return view('admin.users.usersEdit', $data);
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
			['email' => $request->get('email')],
			['email' => 'email|min:4|required']
		);

		if($validator->fails()){
			return back()->withInput()->withErrors($validator);
		}

		$user = Sentinel::findById($id);

		if(Sentinel::update($user, $request->all())){
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
        $user = Sentinel::findById($id);
		if( !$user->delete()){
			return back()->withInput()->withErrors(array('messages' => Lang::get('users.change_failed')));
		}

        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to('/admin/users');
    }
}
