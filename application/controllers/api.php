<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * This file is part of sokun.
 *
 * sokun is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * sokun is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with sokun. If not, see <http://www.gnu.org/licenses/>.
 */

class Api extends CI_Controller {
    
    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct() {
        parent::__construct();
        
        // http://localhost/sokun/api/tests?login=bbalet&password=bbalet
    }
    
    /**
     * REST End Point : Display the list of the tests (whatever the campaign)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getTests() {
        //Check if input parameters are set
        if ($this->input->get_post('login') != NULL  && $this->input->get_post('password') != NULL) {
            //Check user credentials
            $login = $this->input->get_post('login');
            $password = $this->input->get_post('password');
            $this->load->model('users_model');
            $user_id = $this->users_model->check_authentication($login, $password);
            if ($user_id != -1) {
                $this->load->model('tests_model');
                $this->expires_now();
                header("Content-Type: application/json");
                $tests = $this->tests_model->get_tests();
                echo json_encode($tests);
            } else {    //Wrong inputs
                $this->output->set_header("HTTP/1.1 422 Unprocessable entity");
            }
        } else {    //Unauthorized
            $this->output->set_header("HTTP/1.1 403 Forbidden");
        }
    }

    /**
     * REST End Point : Get the steps of a test
     * @param int $id identifier of a test
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getSteps($id) {
        //Check if input parameters are set
        if ($this->input->get_post('login') != NULL  && $this->input->get_post('password') != NULL) {
            //Check user credentials
            $login = $this->input->get_post('login');
            $password = $this->input->get_post('password');
            $this->load->model('users_model');
            $user_id = $this->users_model->check_authentication($login, $password);
            if ($user_id != -1) {
                $this->load->model('tests_model');
                $this->expires_now();
                header("Content-Type: application/json");
                $steps = $this->tests_model->get_steps($id);
                echo json_encode($steps);
            } else {    //Wrong inputs
                $this->output->set_header("HTTP/1.1 422 Unprocessable entity");
            }
        } else {    //Unauthorized
            $this->output->set_header("HTTP/1.1 403 Forbidden");
        }
    }
    
    /**
     * REST End Point : Get the latest execution status of a test
     * @param int $id identifier of a test
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function getLatestExecutionStatus($id) {
        //Check if input parameters are set
        if ($this->input->get_post('login') != NULL  && $this->input->get_post('password') != NULL) {
            //Check user credentials
            $login = $this->input->get_post('login');
            $password = $this->input->get_post('password');
            $this->load->model('users_model');
            $user_id = $this->users_model->check_authentication($login, $password);
            if ($user_id != -1) {
                $this->load->model('executions_model');
                $this->expires_now();
                header("Content-Type: application/json");
                $status = $this->executions_model->last_execution_status($id);
                echo json_encode($status);
            } else {    //Wrong inputs
                $this->output->set_header("HTTP/1.1 422 Unprocessable entity");
            }
        } else {    //Unauthorized
            $this->output->set_header("HTTP/1.1 403 Forbidden");
        }
    }
    
    /**
     * Internal utility function
     * make sure a resource is reloaded every time
     */
    private function expires_now() {
        // Date in the past
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        // always modified
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        // HTTP/1.1
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        // HTTP/1.0
        header("Pragma: no-cache");
    }
}
