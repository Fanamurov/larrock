<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Component;
use App\Http\Controllers\Admin\Blocks\MenuBlock;
use App\Models\Roles;
use App\Models\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JsValidator;
use Lang;
use Route;
use Validator;
use Sentinel;
use Input;
use Session;
use Redirect;
use View;

class UsersController extends Controller
{
	protected $config;

	public function __construct(MenuBlock $menu)
	{
		$this->config = \Config::get('components.users');
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = Users::paginate(15);
		return view('admin.users.index', array('data' => $users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
        View::share('validator', $validator);
		return view('admin.users.create', array('roles' => Roles::all()));
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
				'email' => 'email|min:4|required|unique:users.email',
				'password' => 'min:5|required',
				'first_name' => 'max:40',
				'last_name' => 'max:40',
			]
		);

		if($validator->fails()){
			return back()->withInput(Input::except('password'))->withErrors($validator);
		}

        dd($request);

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
			Session::flash('error', Lang::get('apps.change.success'));
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
        return $id;
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
		$data['user'] = Users::find($id)->with('role')->first();
        $validator = JsValidator::make(Component::_valid_construct($this->config['rows']));
        View::share('validator', $validator);
		return view('admin.users.edit', $data);
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
			return back()->withInput()->with('success', Lang::get('apps.change.success'));
		}else{
            Session::flash('error', Lang::get('users.change_failed'));
			return back()->withInput();
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
        if(Sentinel::findById($id)->delete()){
            Session::flash('success', Lang::get('apps.delete.success'));
        }else{
            Session::flash('error', Lang::get('apps.delete.success'));
        }
        return Redirect::to('/admin/users');
    }
}
