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

class Tests extends CI_Controller {

    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct() {
        parent::__construct();
        setUserContext($this);
        $this->lang->load('tests', $this->language);
        $this->lang->load('global', $this->language);
        $this->load->model('tests_model');
    }

    /**
     * Display the list of all tests
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */

    public function index() {
        $this->auth->check_is_granted('tests_list');
        $data = getUserContext($this);
        $data['title'] = lang('tests_index_title');
        $data['tests'] = $this->tests_model->get_tests();
        $data['flash_partial_view'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('tests/index', $data);
        $this->load->view('templates/footer');   
    }
    
    /**
     * Display a pop-up allowing to select a test case
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function select() {
        $this->auth->check_is_granted('tests_select');
        $data = getUserContext($this);
        $data['tests'] = $this->tests_model->get_tests();
        $data['title'] = lang('tests_select_title');
        $this->load->view('tests/select', $data);
    }
    
    /**
     * Create a test. Rules are checked on client side
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function create() {
        $this->auth->check_is_granted('tests_create');
        expires_now();
        $data = getUserContext($this);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('tests_create_field_name'), 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['title'] = lang('tests_create_title');
            $this->load->view('templates/header', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('tests/create');
            $this->load->view('templates/footer');
        } else {
            $this->tests_model->set_tests($this->user_id);
            $this->session->set_flashdata('msg', lang('tests_create_flash_msg_success'));
            redirect('tests');
        }
    }
    
    /**
     * Update a test. Rules are checked on client side
     * @param int $id Identifier of the test
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function edit($id) {
        $this->auth->check_is_granted('tests_edit');
        expires_now();
        $data = getUserContext($this);
        $data['test'] = $this->tests_model->get_tests($id);
        if (empty($data['test'])) {
            show_404();
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('tests_edit_field_name'), 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['title'] = lang('tests_edit_title');
            $this->load->view('templates/header', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('tests/edit');
            $this->load->view('templates/footer');
        } else {
            $this->tests_model->update_tests($id);
            $this->session->set_flashdata('msg', lang('tests_edit_flash_msg_success'));
            redirect('tests');
        }
    }
    
    /**
     * Delete a test (if it exists)
     * @param int $id Identifier of the test
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete($id) {
        $this->auth->check_is_granted('tests_delete');
        //Test if the test exists
        $test = $this->tests_model->get_tests($id);
        if (empty($test)) {
            show_404();
        } else {
            $this->tests_model->delete_test($id);
        }
        $this->session->set_flashdata('msg', lang('tests_delete_flash_msg_success'));
        redirect('tests');
    }
    
    /**
     * Export the list of all tests into an Excel file
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function export() {
        expires_now();
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle(lang('tests_export_title'));
        $this->excel->getActiveSheet()->setCellValue('A1', lang('tests_export_thead_id'));
        $this->excel->getActiveSheet()->setCellValue('B1', lang('tests_export_thead_name'));
        $this->excel->getActiveSheet()->setCellValue('C1', lang('tests_export_thead_creator'));
        $this->excel->getActiveSheet()->setCellValue('D1', lang('tests_export_thead_description'));
        $this->excel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $tests = $this->tests_model->get_tests();
        $line = 2;
        foreach ($tests as $test) {
            $this->excel->getActiveSheet()->setCellValue('A' . $line, $test['id']);
            $this->excel->getActiveSheet()->setCellValue('B' . $line, $test['name']);
            $this->excel->getActiveSheet()->setCellValue('C' . $line, $test['creator_name']);
            $this->excel->getActiveSheet()->setCellValue('D' . $line, $test['description']);
            $line++;
        }
        
        //Autofit
        foreach(range('A', 'D') as $colD) {
            $this->excel->getActiveSheet()->getColumnDimension($colD)->setAutoSize(TRUE);
        }

        $filename = 'tests.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

}
