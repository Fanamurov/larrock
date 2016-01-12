<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Admin\Blocks\MenuBlock;
use Breadcrumbs;
use Excel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route;
use View;

class WizardController extends Controller
{
	public function __construct(MenuBlock $menu)
	{
		//$this->config = \Config::get('components.page');
		if(Route::current()){
			View::share('menu', $menu->index(Route::current()->getUri())->render());
		}

		Breadcrumbs::register('admin.wizard.step1', function($breadcrumbs)
		{
			$breadcrumbs->push('Wizard', route('admin.wizard'));
		});
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function step1()
    {
		Excel::filter('chunk')->load('resources/wizard/test.xls')->chunk(25, function($results)
		{
			// Loop through all sheets
			$results->each(function($sheet) {
				// Loop through all rows
				$sheet->each(function($row) {
					dd(preg_match('/{=R\d=}/', $row->naimenovanie, $match)); //Определение раздела {=Rчисло=}

					dd($row->naimenovanie);
				});

			});
		});

		$app['name'] = 'Wizard. Export .xls to catalog';
		return view('admin.wizard.step1', ['app' => $app]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
