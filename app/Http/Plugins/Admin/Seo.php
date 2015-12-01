<?php

namespace App\Http\Plugins\Seo;

use App\Http\Controllers\Admin\PageController as Page;

class Plugins_Admin_Seo
{
	public function load($plugins_backend, $rows)
	{
		if(in_array('seo', $plugins_backend, TRUE)){
			$rows['seo_title'] = [
				'title' => 'Title материала',
				'type' => 'input',
				'in_admin_tab' => ['seo' => 'Seo'],
				'valid' => 'max:255',
				'help' => 'По-умолчанию равно заголовку материала',
			];
			$data['data']['0']->seo_title = '';

			$rows['seo_description'] = [
				'title' => 'Description материала',
				'type' => 'input',
				'in_admin_tab' => ['seo' => 'Seo'],
				'valid' => 'max:255',
				'help' => 'По-умолчанию равно заголовку материала',
			];
			$data['data']['0']->seo_description = '';

			$rows['seo_keywords'] = [
				'title' => 'Keywords материала',
				'type' => 'input',
				'in_admin_tab' => ['seo' => 'Seo'],
				'valid' => 'max:255'
			];
			$data['data']['0']->seo_keywords = '';
		}
		$data['apps']->rows = $this->rows;
	}
}