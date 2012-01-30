<?php

/**
 * Reservations model
 * 
 * @author		Pixel Bakkerij
 * @copyright	(c) 2012
 * @package		Smacky Tables
 * @category	Model
 * @extends		ORM
 * @since		30-01-2012
 */
class Model_Reservation extends ORM {

	protected $_belongs_to = array('table' => array());

	protected $_sorting = array('start' => 'asc');
	protected $_updated_column = array('column' => 'updated', 'format' => 'Y-m-d H:i:s');
	protected $_created_column = array('column' => 'created', 'format' => 'Y-m-d H:i:s');

	public function rules()
	{
		return array(
			'id' => array(
				array('digit'),
			),
			'table_id' => array(
				array('not_empty'),
				array('digit'),
			),
			'name' => array(
				array('not_empty'),
				array('max_length', array(':value', 20)),
				array('min_length', array(':value', 3)),
			),
			'phone' => array(
				array('not_empty'),
				array('max_length', array(':value', 20)),
				array('regex', array(':value', '/^(0[0-9]{1,3})-([0-9]{6,8})$/')),
			),
			'email' => array(
				array('email'),
				array('max_length', array(':value', 100)),
			),
			'start' => array(
				array(array($this, 'validate_date'), array(':validation', ':field', ':value')),
			),
			'end' => array(
				array(array($this, 'validate_date'), array(':validation', ':field', ':value')),
			),
		);
	}

	public function filters()
	{
		return array(
			true => array(
				array('strip_tags', array(':value')),
			),
			'start' => array(
				array(array($this, 'interpret_date'), array(':value')),
			),
			'end' => array(
				array(array($this, 'interpret_date'), array(':value')),
			),
		);
	}

	public function labels()
	{
		return array(
			'table_id' => 'table',
			'start' => 'date'
		);
	}

	/**
	 * date validator
	 * 
	 * @param Validation $validation
	 * @param string $field
	 * @param string $value
	 * @throws Validation_Exception
	 * @return void
	 */
	public function validate_date(Validation $validation, $field, $value)
	{
		$stamp = strtotime($value);

		if ($stamp < (time() - 31556926))
		{
			$validation->error($field, 'invalid_date', array($validation[$field]));
		}

		if ($field == "start")
		{
			// if it is a new reservation, check if time is in the future
			if ($this->id == null && $stamp < time())
			{
				$validation->error($field, 'past', array($validation[$field], $value));
			}
			
			// check if the resaurant is opened on that day
			if (in_array(date("N", $stamp), Kohana::$config->load('smacky.closed')))
			{
				$validation->error($field, 'closed', array($validation[$field]));
			}
		}

		if ($field == "end")
		{
			// check if the end-stamp is after the start-stamp
			if ($value <= $this->start)
			{
				$validation->error($field, 'invalid_timespan', array($validation[$field], $value));
			}
			
			// check if max reservation time is not exceeded
			if (($stamp - strtotime($this->start)) > (Kohana::$config->load('smacky.max-reservation') * 3600))
			{
				$validation->error($field, 'max_time', array($validation[$field], $value));
			}
		}
	}

	/**
	 * try to make a valid date of the date inputs
	 * 
	 * @param string $value
	 * @return string
	 */
	public function interpret_date($value)
	{

		// check if $value is a time, and if so, calculate the stamp based on start-stamp
		if (preg_match("/^(([0-9])|([0-1][0-9])|([2][0-3])):(([0-9])|([0-5][0-9]))$/", $value))
		{
			$stamp = strtotime(date("Y-m-d", strtotime($this->start)) . " " . $value);
		}
		else
		{
			$stamp = strtotime($value);
		}

		
		if ($stamp > 0)
		{

			return date('Y-m-d H:i:s', $stamp);
		}
		else
		{
			return false;
		}
	}

}


?>
