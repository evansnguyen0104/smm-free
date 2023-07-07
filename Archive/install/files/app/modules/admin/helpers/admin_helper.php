<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * From V3.6
 * Sort Services by ID
 * @param string $order status
 * @return array
 */
if (!function_exists('order_status_update_form')) {
    function order_status_update_form($controller_name, $status)
    {
        $tmpl_status = app_config('template')['order_status'];
        $order_status_array = [];

        if ($controller_name == 'subscriptions') {
            $order_status_array = ['canceled', 'completed', 'expired'];
        }

        if ($controller_name == 'dripfeed') {
            switch ($status) {
                case 'active':
                    $order_status_array = ['completed', 'canceled'];
                    break;

                case 'canceled':
                    $order_status_array = ['canceled'];
                    break;

                default:
                    $order_status_array = ['canceled', 'completed'];
                    break;
            }
        }

        if ($controller_name == 'order') {
            switch ($status) {
                case 'canceled':
                    $order_status_array = ['canceled'];
                    break;
                case 'completed':
                    $order_status_array = ['completed', 'canceled', 'partial'];
                    break;

                case 'partial':
                    $order_status_array = ['canceled'];
                    break;

                case 'error':
                    $order_status_array = ['canceled', 'error', 'partial', 'pending', 'inprogress', 'completed'];
                    break;

                default:
                    $order_status_array = ['pending', 'processing', 'inprogress', 'completed', 'partial', 'canceled'];
                    break;
            }
        }
        $form_status = array_intersect_key($tmpl_status, array_flip($order_status_array));
        $result = array_combine(array_keys($form_status), array_column($form_status, 'name'));
        return $result;
    }
}

/**
 * return user logged data
 */
if (!function_exists("current_logged_staff")) {
    function current_logged_staff()
    {
        return $GLOBALS['current_staff'];
    }
}

/**
 * Is staff loggined
 * @return boolean
 */
if (!function_exists('is_current_logged_staff')) {
	function is_current_logged_staff()
    {
        if (session('sid') && $GLOBALS['current_staff'] != null &&  $GLOBALS['current_staff']->id == session('sid')) {
            return true;
        }
		return false;
	}
}
