<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Helpers\Component;
use App\Http\Controllers\Admin\AdminBlocks\MenuBlock;
use App\Models\Blog;
use App\Models\Category;
use App\Models\News;
use App\Models\Tours;
use App\Models\UsersLogger;
use App\User;
use Bican\Roles\Models\Role;
use Breadcrumbs;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JsValidator;
use Route;
use Validator;
use Input;
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

		if($user = User::whereEmail($request->input('email'))->first()){
			$user->attachRole((int) $request->get('role'));
			Alert::add('success', 'Пользователь '. $request->input('email') .' успешно добавлен')->flash();
		}else{
			Alert::add('danger', 'Пользователь '. $request->input('email') .' не был добавлен')->flash();
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
			Alert::add('danger', 'Не удалось изменить пользователя');
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
			Alert::add('danger', 'Не удалось удалить пользователя');
        }
        return Redirect::to('/admin/users');
    }

	/**
	 * Получение всех материалов автора
	 * @param Request $request
	 */
	public function getAuthor(Request $request, $userId)
	{
		Breadcrumbs::register('admin.author', function($breadcrumbs, $data)
		{
			$breadcrumbs->push('Лента активности');
			$breadcrumbs->push($data->first_name .' '. $data->last_name);
		});

		$page = $request->get('page');
		//Cache::forget('userActive'. $userId .'_'. $page);
		$data = Cache::remember('userActive'. $userId .'_'. $page, 60, function() use ($userId) {
			$data['users'] = User::all();
			$data['user'] = User::whereId($userId)->first();
			$data['categories'] = Category::whereUserId($userId)->whereType('tours')->paginate(20);
			$data['tours'] = Tours::whereUserId($userId)->with(['getFirstImage', 'get_category', 'getCountForms'])->paginate(20);
			$data['news'] = News::whereUserId($userId)->with(['getFirstImage'])->paginate(20);
			$data['blog'] = Blog::whereUserId($userId)->with(['getFirstImage', 'get_category'])->paginate(20);
			$data['app'] = $this->config;

			$data['counter']['categories']['share']['all'] = Category::all()->sum('sharing');
			$data['counter']['categories']['share']['user'] = Category::whereUserId($userId)->sum('sharing');

			$data['counter']['categories']['loads']['all'] = Category::all()->sum('loads');
			$data['counter']['categories']['loads']['user'] = Category::whereUserId($userId)->sum('loads');

			$data['counter']['tours']['share']['all'] = Tours::all()->sum('sharing');
			$data['counter']['tours']['share']['user'] = Tours::whereUserId($userId)->sum('sharing');

			$data['counter']['tours']['loads']['all'] = Tours::all()->sum('loads');
			$data['counter']['tours']['loads']['user'] = Tours::whereUserId($userId)->sum('loads');

			$data['counter']['blog']['share']['all'] = Blog::all()->sum('sharing');
			$data['counter']['blog']['share']['user'] = Blog::whereUserId($userId)->sum('sharing');

			$data['counter']['blog']['loads']['all'] = Blog::all()->sum('loads');
			$data['counter']['blog']['loads']['user'] = Blog::whereUserId($userId)->sum('loads');

			$data['counter']['news']['share']['all'] = News::all()->sum('sharing');
			$data['counter']['news']['share']['user'] = News::whereUserId($userId)->sum('sharing');

			$data['counter']['news']['loads']['all'] = News::all()->sum('loads');
			$data['counter']['news']['loads']['user'] = News::whereUserId($userId)->sum('loads');

			$stat_type = ['blog', 'news', 'tours', 'categories'];
			$stat_metrics = ['share', 'loads'];
			foreach($stat_type as $type){
				foreach($stat_metrics as $metric){
					if($data['counter'][$type][$metric]['all'] > 0){
						$data['counter'][$type][$metric]['perst'] = ceil(($data['counter'][$type][$metric]['user']*100)/$data['counter'][$type][$metric]['all']);
					}else{
						$data['counter'][$type][$metric]['perst'] = 100;
					}
				}
			}

			$data['logger'] = UsersLogger::whereUserId($userId)->orderBy('updated_at', 'desc')->take(6)->get();
			return $data;
		});

		return view('admin.users.activity', $data);
	}
}
