<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Page where guest can make reservations
 * 
 * @author		Pixel Bakkerij
 * @copyright	(c) 2012
 * @package		Smacky Tables
 * @category	Controller
 * @extends		Controller_Template
 * @since		30-01-2012
 */
class Controller_Table extends Controller_Template
{
	public function action_index()
	{
		$this->template->title = "Welcome at Smacky Burgers";
		
		$tables = ORM::factory('table')->find_all();		

		if (!$_POST)
		{
			//display the form
			$this->template->content = View::factory('forms/reservation')
				->set('errors', array())
				->set('tables', $tables);
		}
		else
		{			
			try
			{
				$reservation = ORM::factory('reservation');
				$reservation->values($_POST);
				
				$reservation->start = $_POST['date'] . " " . $_POST['time'];
				$reservation->end = date("Y-m-d H:i", strtotime($reservation->start) + 3600);
				
				//add extra validation rules
				$extra_rules = Validation::factory($_POST)
					->rule('date', 'not_empty')
					->rule('date', array($reservation, 'validate_date'), array(':validation', ':field', ':value'))
					->rule('time', 'not_empty')
					->rule('time', array($reservation, 'validate_date'), array(':validation', ':field', ':value'));		
								
				$reservation->save($extra_rules);
				
				//everything went well, so display a success-page
				$this->template->content = View::factory('forms/reservation_success')
					->set('reservation', $reservation);
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('models');
				
				//flatten the error array	
				foreach ($errors as $field => $msg) 
				{
					if (is_array($msg))
					{
						$errors = array_merge($errors, $msg);
					}
				}
				unset($errors['_external']);
				
				//display the form and errors
				$this->template->content = View::factory('forms/reservation')
					->set('errors', $errors)				
					->set('tables', $tables);
			}

		}

	}

}
