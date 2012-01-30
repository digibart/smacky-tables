<?php

/**
 * Tables, as in a board with table legs. Not a database table
 * 
 * @author		Pixel Bakkerij
 * @copyright	(c) 2012
 * @package		Smacky Tables
 * @category	Model
 * @extends		ORM
 * @since		30-01-2012
 */
class Model_Table extends ORM {

	protected $_belongs_to = array('user' => array());
	protected $_has_one = array('reservation' => array());

	public function rules()
	{
		return array(
			'id' => array(
				array('digit'),
			),
			'number' => array(
				array('max_length', array(':value', 6)),
			),
			'size' => array(
				array('not_empty'),
				array('digit'),
			),
			'nickname' => array(
				array('max_length', array(':value', 20)),
			),
			'user_id' => array(
				array('digit'),
			),

		);
	}

	public function filters()
	{
		return array(
			true => array(
				array('strip_tags', array(':value')),
			),
		);
	}

}


?>