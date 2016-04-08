<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Helpers\Component;
use App\Http\Controllers\Admin\AdminBlocks\MenuBlock;
use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JsValidator;
use Lang;
use Route;
use Validator;
use Input;
use Session;
use Redirect;
use View;

/* https://github.com/romanbican/roles */

class AdminUsersController extends Controller
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
		$users = User::with('role')->paginate(15);
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
		return view('admin.users.create', array('roles' => Role::all()));
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
			Component::_valid_construct($this->config['rows'])
		);

		if($validator->fails()){
			return back()->withInput(Input::except('password'))->withErrors($validator);
		}

		User::create([
			'email' => $request->get('email'),
			'first_name' => $request->get('first_name'),
			'last_name' => $request->get('last_name'),
			'password' => bcrypt($request->get('password')),
		]);

		$user = User::whereEmail($request->input('email'))->first();
		if($user->attachRole((int) $request->get('role'))){
			Alert::add('success', 'Пользователь '. $request->input('email') .' успешно добавлен')->flash();
		}else{
			Alert::add('error', 'Пользователь '. $request->input('email') .' не был добавлен')->flash();
		}
		return Redirect::to('/admin/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$data['roles'] = Role::all();
		$data['user'] = User::whereId($id)->with('role')->first();
        $validator = JsValidator::make(Component::_valid_construct($this->config['rows'], 'update', $id));
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
			Input::all(),
			Component::_valid_construct($this->config['rows'], 'update', $id));

		if($validator->fails()){
			return back()->withInput()->withErrors($validator);
		}

		$user = User::whereId($id)->first();
		$user->detachAllRoles();
		$user->attachRole($request->get('role'));

		$submit = Input::all();
		if($submit['password'] !== $user->password){
			$submit['password'] = bcrypt($submit['password']);
		}else{
			unset($submit['password']);
		}

		if($user->update($submit)){
			Alert::add('success', 'Пользователь изменен');
		}else{
			Alert::add('error', 'Не удалось изменить пользователя');
		}

		return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$user = User::whereId($id)->first();
		$user->detachAllRoles();

        if($user->delete()){
            Alert::add('success', 'Пользователь удален');
        }else{
			Alert::add('error', 'Не удалось удалить пользователя');
        }
        return Redirect::to('/admin/users');
    }
}
