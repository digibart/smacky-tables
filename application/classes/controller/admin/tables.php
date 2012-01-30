<?php

/**
 * Controller_Admin_Tables description
 * 
 * @author		Pixel Bakkerij
 * @copyright	(c) 2012
 * @package		Smacky Tables
 * @category	KillerAdmin Controller
 * @extends		Controller_Admin_Base
 * @since		30-01-2012
 */
class Controller_Admin_Tables extends Controller_Admin_Base {

	public $orm_name = "table"; //the name of the model we'll be editing

	public function before()
	{
		parent::before();

		$this->template->title = ucfirst(__('tables'));

		// the base object is used for loading, editing, viewing a object
		// not neccesary when objects don't need to be filtered
		// in this example, the manager can see everything, but waitresses can only see tables where they serve
		if (Auth::instance()->logged_in('admin'))
		{
			//i'm a manager can see every table
			$this->base_object = ORM::factory('table');
		}
		else
		{
			//i'm just a waitress, i can only see my tables...
			$this->base_object = ORM::factory('table')->where('user_id', '=', $this->user->id);
		}
	}

	public function action_index()
	{
		if (!Auth::instance()->logged_in('admin'))
		{
			$this->template->content = View::factory('admin/table_list_waitress');
		}
		parent::action_index();
	}
}


?>