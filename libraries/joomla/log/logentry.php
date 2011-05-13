<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Log
 *
 * @copyright   Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

jimport('joomla.log.log');
jimport('joomla.utilities.date');

/**
 * Joomla! Log Entry class
 *
 * This class is designed to hold log entries for either writing to an engine, or for
 * supported engines, retrieving lists and building in memory (PHP based) search operations.
 *
 * @package     Joomla.Platform
 * @subpackage  Log
 * @since       11.1
 */
class JLogEntry
{
	/**
	 * @var    string  Application responsible for log entry.
	 * @since  11.1
	 */
	public $category;

	/**
	 * @var    JDate  The date the message was logged.
	 * @since  11.1
	 */
	public $date;

	/**
	 * @var    string  Message to be logged.
	 * @since  11.1
	 */
	public $message;

	/**
	 * @var    string  The priority of the message to be logged.
	 * @since  11.1
	 * @see    $_priorities
	 */
	public $priority = JLog::INFO;

	/**
	 * @var    array  List of available log priority levels [Based on the SysLog default levels].
	 * @since  11.1
	 */
	protected $_priorities = array(
		JLog::EMERGENCY,
		JLog::ALERT,
		JLog::CRITICAL,
		JLog::ERROR,
		JLog::WARNING,
		JLog::NOTICE,
		JLog::INFO,
		JLog::DEBUG
	);

	/**
	 * Constructor
	 *
	 * @param   string  $message   The message to log.
	 * @param   string  $priority  Message priority based on {$this->_priorities}.
	 * @param   string  $category  Type of entry
	 * @param   string  $date      Date of entry (defaults to now if not specified or blank)
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	public function __construct($message, $priority = JLog::INFO, $category = '', $date = null)
	{
		$this->message = (string) $message;

		// Sanitize the priority.
		if (!in_array($priority, $this->_priorities, true)) {
			$priority = JLog::INFO;
		}
		$this->priority = $priority;

		// Sanitize category if it exists.
		if (!empty($category)) {
			$this->category = (string) strtolower(preg_replace('/[^A-Z0-9_\.-]/i', '', $category));
		}

		// Get the date as a JDate object.
		$this->date = new JDate($date ? $date : 'now');
	}
}