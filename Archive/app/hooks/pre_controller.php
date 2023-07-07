<?php
class AppSettingClass
{

    public function GetAppSetting()
    {
        $CI = &get_instance();
        $CI->load->database();
        $CI->db->select('name, value');
        $CI->db->from('general_options');
        $query = $CI->db->get();
        $result = $query->result_array();
        if ($result) {
            $result = array_column($result, 'value', 'name');
            // store in $GLOBALS
            $GLOBALS['app_settings'] = $result;
        }

        $GLOBALS['current_user'] = null;
        // Get User Information
        if (session('uid')) {
            $user = null;
            $CI->db->select('*');
            $CI->db->from(USERS);
            $CI->db->where('id', session('uid'));
            $CI->db->where('status', 1);
            $query = $CI->db->get();
            $user = $query->row();
            if ($user) {
                $GLOBALS['current_user'] = $user;
            } else {
                $CI->session->sess_destroy();
                redirect(cn());
            }
        }

        $GLOBALS['current_staff'] = null;
        // Get User Information
        if (session('sid')) {
            $staff = null;
            $CI->db->select('*');
            $CI->db->from(STAFFS);
            $CI->db->where('id', session('sid'));
            $CI->db->where('status', 1);
            $query = $CI->db->get();
            $staff = $query->row();
            if ($staff) {
                $GLOBALS['current_staff'] = $staff;
            } else {
                $CI->session->sess_destroy();
                redirect(cn());
            }
        }
    }

}
