<?php

namespace App\Helpers;
use App\Models\Category;

class Tree{
	/**
	 * Построение дерева объектов по определенному полю(по-умолчанию parent)
	 *
	 * @link http://stackoverflow.com/a/10332361/2748662
	 * @param $data
	 * @param string $row_level     по какому полю ищем детей
	 * @return array
	 */
	public function build_tree($data, $row_level = 'parent')
	{
		$new = array();
		foreach ($data as $a){
			$new[$a->$row_level][] = $a;
		}
		return $this->createTree($new, $new[0]);
	}

	/**
	 * Вспомогательный метод для построения дерева
	 * Прикрпепляем информацию о вложенности элемента ->level
	 *
	 * @link http://stackoverflow.com/a/10332361/2748662
	 * @param $list
	 * @param array $parent
	 * @param int $level
	 * @return array
	 */
	public function createTree(&$list, $parent, $level = 1){
		$tree = array();
		foreach ($parent as $k=>$l){
			$l->level = $level;
			if(isset($list[$l->id])){
				$l->children = $this->createTree($list, $list[$l->id], ++$level);
				--$level;
			}
			$tree[] = $l;
		}
		return $tree;
	}
}