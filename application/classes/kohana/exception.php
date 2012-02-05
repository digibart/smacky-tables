<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Friendly error pages
 * 
 * @author		Pixel Bakkerij
 * @copyright	(c) 2012
 * @package		Kohana
 * @category	Exceptions
 * @extends		Kohana_Kohana_Exception
 * @since		30-01-2012
 */
class Kohana_Exception extends Kohana_Kohana_Exception
{
	public static function handler(Exception $e)
	{
		// Throw errors when in development mode
		if (Kohana::$environment === Kohana::DEVELOPMENT)
		{
			parent::handler($e);
		}
		else
		{
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e));

			$attributes = array(
				'action' => 500,
				'origuri' => rawurlencode(Arr::get($_SERVER, 'REQUEST_URI')),
				'message' => rawurlencode($e->getMessage())
			);
			
			if ($e instanceof Http_Exception)
			{
				$attributes['action'] = $e->getCode();
			}			
						
			// Error sub request
			try {
				echo Request::factory(Route::get('error')->uri($attributes))
                ->execute()
                ->send_headers()
                ->body();	

			}
			catch (Exception $e3)
			{
				echo Debug::vars(Kohana_Exception::text($e3));
			}
		}
	}
}
?>
