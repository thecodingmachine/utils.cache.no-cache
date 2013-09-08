<?php
namespace Mouf\Utils\Cache;

use Mouf\Utils\Log\LogInterface;
use Psr\Log\LoggerInterface;

/**
 * This package contains a cache mechanism that... does not cache anything.
 * This is useful if another component requires a cache mechanism and if you don't want to provide any (for development purpose...).
 * 
 * @Component
 */
class NoCache implements CacheInterface {
	
	/**
	 * The logger used to trace the cache activity.
	 * Supports both PSR3 compatible logger and old Mouf logger for compatibility reasons.
	 *
	 * @var LoggerInterface|LogInterface
	 */
	public $log;
	
	/**
	 * Returns the cached value for the key passed in parameter.
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get($key) {
		if ($this->log != null) {
			if ($this->log instanceof LoggerInterface) {
				$this->log->info("Retrieving key '{key}' from no-cache: no value returned", array('key'=>$key));
			} else {
				$this->log->trace("Retrieving key '$key' from no-cache: no value returned");
			}
		}
		return null;
	}
	
	/**
	 * Sets the value in the cache.
	 *
	 * @param string $key The key of the value to store
	 * @param mixed $value The value to store
	 * @param float $timeToLive The time to live of the cache, in seconds.
	 */
	public function set($key, $value, $timeToLive = null) {
		if ($this->log != null) {
			if ($this->log instanceof LoggerInterface) {
				$this->log->info("Storing value in no-cache: key '{key}', value '{$value}'. Nothing will be stored.",
				array(
					'key'=>$key,
					'value'=>var_export($value, true)
				)
			);
			} else {
				$this->log->trace("Storing value in no-cache: key '$key', value '".var_export($value, true)."'. Nothing will be stored.");
			}
		}		
	}
	
	/**
	 * Removes the object whose key is $key from the cache.
	 *
	 * @param string $key The key of the object
	 */
	public function purge($key) {
		if ($this->log != null) {
			if ($this->log instanceof LoggerInterface) {
				$this->log->info("Purging key '{key}' from no-cache. Nothing to purge.", array('key'=>$key));
			} else {
				$this->log->trace("Purging key '$key' from no-cache. Nothing to purge.");
			}
		}
	}
	
	/**
	 * Removes all the objects from the cache.
	 *
	 */
	public function purgeAll() {
		if ($this->log != null) {
			if ($this->log instanceof LoggerInterface) {
				$this->log->info("Purging all data from no-cache. Nothing to purge.");
			} else {
				$this->log->trace("Purging all data from no-cache. Nothing to purge.");
			}
		}
	}
	
}
?>