<?php defined('BASEPATH') OR exit('No direct script access allowed');
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

class Executions extends CI_Controller {

    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct() {
        parent::__construct();
        setUserContext($this);
        $this->lang->load('executions', $this->language);
        $this->lang->load('global', $this->language);
        $this->load->model('executions_model');
    }

    /**
     * Execute a test case from a campaign
     * @param int $campaign Identifier of a campaign
     * @param int $test Test in a campaign (and not test.id)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function execute($campaign, $test) {
        $this->auth->check_is_granted('executions_execute');
        $data = getUserContext($this);
        //Execute the test
        $testexecution = $this->executions_model->execute($test);
        redirect('campaigns/' . $campaign . '/executions/' . $testexecution . '/edit');
    }
    
    /**
     * Edit a test execution
     * @param int $campaign Identifier of a campaign
     * @param int $testexecution Test in a campaign (and not test.id)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function executions($campaign, $test) {
        $this->auth->check_is_granted('executions_executions');
        $data = getUserContext($this);
        $data['test'] = $this->executions_model->get_test_from_instance($test);
        $data['campaign'] = $campaign;
        $data['executions'] = $this->executions_model->get_executions($test);
        $data['title'] = lang('executions_index_title');
        $data['flash_partial_view'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('executions/executions', $data);
        $this->load->view('templates/footer');   
    }
    
    /**
     * Edit a test execution
     * @param int $campaign Identifier of a campaign
     * @param int $testexecution Test in a campaign (and not test.id)
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function edit($campaign, $testexecution) {
        $this->auth->check_is_granted('executions_edit');
        $data = getUserContext($this);
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('teststatus', lang('executions_edit_field_test_status'), 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $data['campaign'] = $campaign;
            $data['testexecution'] = $testexecution;
            $data['test'] = $this->executions_model->get_tests($testexecution);
            $data['steps'] = $this->executions_model->get_steps($testexecution);
            $data['title'] = lang('executions_edit_title');
            $data['flash_partial_view'] = $this->load->view('templates/flash', $data, true);
            $this->load->view('templates/header', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('executions/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->tests_model->update_tests($id);
            $this->session->set_flashdata('msg', lang('executions_edit_flash_msg_update_execute'));
            redirect('campaigns/' . $campaign . '/tests');
        }
    }

}
