<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FormContactTest extends TestCase
{
	public function testFormContactSubmit()
	{
		$this->visit('/page/kontakty');
		$this->type('Имя', 'name');
		$this->type('555-555', 'contact');
		$this->type('Комментарий', 'comment');
		$this->press('submit_contact');
		$this->seePageIs('/page/kontakty');
		$this->see('Форма отправлена');
	}
}
