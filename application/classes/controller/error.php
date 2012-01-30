<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Friendly error pages
 * 
 * @author		Pixel Bakkerij
 * @copyright	(c) 2012
 * @package		Smacky Tables
 * @category	Controller
 * @extends		Controller_Template
 * @since		30-01-2012
 */
class Controller_Error extends Controller_Template
{
	protected $_requested_page;

	protected $_message;

	public function before()
	{
		parent::before();

		$this->template->page = URL::site(rawurldecode(Request::$initial->uri()));

		// Internal request only!
		if (Request::$initial !== Request::$current)
		{
			if ($message = rawurldecode($this->request->param('message')))
			{
				$this->_message = $message;
			}
			if ($requested_page = rawurldecode($this->request->param('origuri')))
			{
				$this->_requested_page = $requested_page;
			}
		}
		else
		{
			$this->request->action(404);
		}

		$this->response->status((int) $this->request->action());
	}
	public function action_404()
	{

		// Here we check to see if a 404 came from our website. This allows the
		// webmaster to find broken links and update them in a shorter amount of time.
		if (isset ($_SERVER['HTTP_REFERER']) and strstr($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']) !== FALSE)
		{
			// Set a local flag so we can display different messages in our template.
			$this->template->local = TRUE;

		}

		$this->template->title = __('Page not found');
		$this->template->content = View::factory('error/404')
			->set('requested_page', $this->_requested_page);
	}

	public function action_503()
	{
		$this->template->title = 'Maintenance Mode';
	}

	public function action_500()
	{
		$this->template->title = __('Internal Server Error');
		$this->template->content = View::factory('error/500');
	}
}
