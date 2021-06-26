<?php defined('BASEPATH') or exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2020, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.4.0
 * ---------------------------------------------------------------------------- */

/**
 * Timezones
 */
class Timezones {
    /**
     * @var EA_Controller
     */
    protected $CI;

    /**
     * @var string
     */
    protected $default = 'Brazil/East';

    /**
     * @var array
     */
    protected $timezones = [
        'Brasil' => [
            'Brazil/Acre' => 'Acre (-5:00)',
            'Brazil/West' => 'Amazonas (-4:00)',
            'Brazil/East' => 'Brasília (-3:00)',
            'Brazil/DeNoronha' => 'Fernando de Noronha (-2:00)',
        ]
    ];

    /**
     * Timezones constructor.
     */
    public function __construct()
    {
        $this->CI = & get_instance();

        $this->CI->load->model('user_model');
    }

    /**
     * Get all timezones to a grouped array (by continent).
     *
     * @return array
     */
    public function to_grouped_array()
    {
        return $this->timezones;
    }

    /**
     * Returns the session timezone or the default timezone as a fallback.
     *
     * @return string
     */
    public function get_session_timezone()
    {
        $default_timezone = $this->get_default_timezone();

        return $this->CI->session->has_userdata('timezone')
            ? $this->CI->session->userdata('timezone')
            : $default_timezone;
    }

    /**
     * Get the default timezone value of the current system.
     *
     * @return string
     */
    public function get_default_timezone()
    {
        return 'Brazil/East';
    }

    /**
     * Convert a date time value to a new timezone.
     *
     * @param string $value Provide a date time value as a string (format Y-m-d H:i:s).
     * @param string $from_timezone From timezone value.
     * @param string $to_timezone To timezone value.
     *
     * @return string
     *
     * @throws Exception
     */
    public function convert($value, $from_timezone, $to_timezone)
    {
        if ( ! $to_timezone || $from_timezone === $to_timezone)
        {
            return $value;
        }

        $from = new DateTimeZone($from_timezone);

        $to = new DateTimeZone($to_timezone);

        $result = new DateTime($value, $from);

        $result->setTimezone($to);

        return $result->format('Y-m-d H:i:s');
    }

    /**
     * Get the timezone name for the provided value.
     *
     * @param string $value
     *
     * @return string|null
     */
    public function get_timezone_name($value)
    {
        $timezones = $this->to_array();

        return isset($timezones[$value]) ? $timezones[$value] : NULL;
    }

    /**
     * Get all timezones to a flat array.
     *
     * @return array
     */
    public function to_array()
    {
        return array_merge(...array_values($this->timezones));
    }
}
