<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Init extends Resto_Controller {
    public function index($q = '', $param_q = '')
    {
        if(!$this->_is_sso_signed()) redirect('auth/log/in');
        $this->load->model('auth_model');

        $profile = $this->session->userdata('profile');

        $role = [];
        $role_active = [];
        $failed_to_login = FALSE;

        $role = $this->auth_model->get_role_by_userid($profile['user_id'])->result_array();

        if(empty($role))
        {
            $failed_to_login = TRUE;
        }

        if($q == 'switch_role')
        {
            foreach ($role as $key => $value) {
                if(md5($value['user_role_id']) == $param_q)
                {
                    $role_active = $value;
                }
            }
        }

        if(empty($role_active)) $role_active = isset($role[0])?$role[0]:[];


        $is_tim_leader = FALSE;
        foreach ($role as $key => $value) {
            if($value['role_id'] == 6)
            {
                $is_tim_leader = TRUE;
            }
        }

        if($failed_to_login)
        {
            $this->session->sess_destroy();
            $this->session->set_userdata('error_message', 'Anda tidak memiliki hak akses apapun');
            redirect('auth/log/in');
        }

        $this->session->set_userdata([
            'role' => $role,
            'role_active' => $role_active
        ]);

        redirect('/');
    }
}
