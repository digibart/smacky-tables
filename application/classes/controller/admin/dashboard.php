<?php
/**
 * Dashboard Controller
 * 
 * @author		Pixel Bakkerij
 * @package		Smacky Tables
 * @category	KillerAdmin Controller
 * @extends		Controller_Admin_Core_Dashboard
 * @since		30-01-2012
 */
class Controller_Admin_Dashboard extends Controller_Admin_Core_Dashboard {

	/**
	 * center column, the reservations
	 * 
	 * @throws Exception
	 * @return void
	 */
	public function action_center()
	{
		$this->auto_render = false;

		$persons = array();
		for ($i = 0; $i < 7; $i++)
		{
			$date = date("Y-m-d", (time() + (86400 * $i)));
			$persons[$date] = 0;

			$tables = ORM::factory('table')->with('reservation')->where('reservation.start', 'like', $date . ' %')->find_all();

			foreach ($tables as $table)
			{
				$persons[$date] += $table->size;
			}
		}

		echo View::factory('admin/dashboard_reservations')
		->set('persons', $persons);
	}
}



?>
