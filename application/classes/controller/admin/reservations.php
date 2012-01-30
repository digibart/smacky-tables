<?php

/**
 * Controller_Admin_Reservations description
 * 
 * @author		Pixel Bakkerij
 * @copyright	(c) 2012
 * @package		Smacky Tables
 * @category	KillerAdmin Controller
 * @extends		Controller_Admin_Base
 * @since		30-01-2012
 */
class Controller_Admin_Reservations extends Controller_Admin_Base {

	public $orm_name = "reservation"; //the name of the model we'll be editing

	public function before()
	{
		parent::before();

		$this->template->title = ucfirst(__('reservation'));

		// the base object is used for loading, editing, viewing a object
		// not neccesary when objects don't need to be filtered
		// but in this example, the manager can see everything, but waitresses can only see tables where they serve
		if (Auth::instance()->logged_in('admin'))
		{
			//i'm a manager can see every table
			$this->base_object = ORM::factory('reservation');
		}
		else
		{
			//i'm just a waitress, i can only see my reservations of my tables...
			$this->base_object = ORM::factory('reservation')->with('table')->where('table.user_id', '=', $this->user->id);
		}
	}
	
	public function action_index()
	{
		if (Arr::get($_GET, 'hide-past'))
		{						
			$this->base_object->where('start', '>', date('Y-m-d'));		
		}

		parent::action_index();
	
	}

	public function after()
	{
		parent::after();

/* 		echo Debugtoolbar::render(); */
	}
}


?>