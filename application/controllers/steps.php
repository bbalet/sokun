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

class Steps extends CI_Controller {

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
     * Action move a test step up
     * @param int $test Identifier of a test
     * @param int $step Identifier of a step
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function up($test, $step) {
        $this->auth->check_is_granted('steps_up');
        $this->tests_model->up_step($step);
        $this->session->set_flashdata('msg', lang('tests_steps_flash_msg_update_success'));
        redirect('tests/' . $test . '/steps');
    }
    
    /**
     * Action move a test step down
     * @param int $test Identifier of a test
     * @param int $step Identifier of a step
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function down($test, $step) {
        $this->auth->check_is_granted('steps_down');
        $this->tests_model->down_step($step);
        $this->session->set_flashdata('msg', lang('tests_steps_flash_msg_update_success'));
        redirect('tests/' . $test . '/steps');
    }
    
    /**
     * Action delete a test step
     * @param int $test Identifier of a test
     * @param int $step Identifier of a step
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete($test, $step) {
        $this->auth->check_is_granted('steps_delete');
        $this->tests_model->delete_step($step);
        $this->session->set_flashdata('msg', lang('tests_steps_flash_msg_delete_success'));
        redirect('tests/' . $test . '/steps');
    }
    
    /**
     * Add a step to a test. Rules are checked on client side
     * @param int $test Identifier of a test
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function add($test) {
        $this->auth->check_is_granted('steps_add');
        expires_now();
        $data = getUserContext($this);
        $this->load->helper('form');
        $this->tests_model->add_step($test);
        $this->session->set_flashdata('msg', lang('tests_steps_flash_msg_add_success'));
        redirect('tests/' . $test . '/steps');
    }

    /**
     * Update a step to a test. Rules are checked on client side
     * @param int $test Identifier of a test
     * @param int $step Identifier of a step
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function edit($test, $step) {
        $this->auth->check_is_granted('steps_edit');
        expires_now();
        $data = getUserContext($this);
        $this->load->helper('form');
        $this->tests_model->update_step($step);
        $this->session->set_flashdata('msg', lang('tests_steps_flash_msg_update_success'));
        redirect('tests/' . $test . '/steps');
    }
    
    /**
     * Copy a step at the end of the list
     * @param int $test Identifier of a test
     * @param int $step Identifier of a step
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function duplicate($test, $step) {
        $this->auth->check_is_granted('steps_copy');
        expires_now();
        $data = getUserContext($this);
        $this->load->helper('form');
        $this->tests_model->duplicate_step($step);
        $this->session->set_flashdata('msg', lang('tests_steps_flash_msg_duplicate_success'));
        redirect('tests/' . $test . '/steps');
    }
    
    /**
     * Export the list of all steps into an Excel file
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function export($id) {
        //TODO tokenize the HTML message and convert it using Rich Text runner
//        $this->load->helper('html');
//        $test = $this->tests_model->get_tests($id);
//        $domArray = getHtmlDomArray($test['description']);
//        echo var_dump($domArray);
        expires_now();
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle(lang('tests_steps_export_worsheet_test'));
        $this->excel->getActiveSheet()->setCellValue('A1', lang('tests_steps_export_test_name'));
        $this->excel->getActiveSheet()->setCellValue('A2', lang('tests_steps_export_test_description'));
        $test = $this->tests_model->get_tests($id);
        $this->excel->getActiveSheet()->setCellValue('B1', $test['name']);
        $this->excel->getActiveSheet()->setCellValue('B2', $test['description']);       
        $this->excel->createSheet(1);
        $this->excel->setActiveSheetIndex(1);
        $this->excel->getActiveSheet()->setTitle(lang('tests_steps_export_worsheet_steps'));
        $this->excel->getActiveSheet()->setCellValue('A1', lang('tests_steps_export_thead_order'));
        $this->excel->getActiveSheet()->setCellValue('B1', lang('tests_steps_export_thead_name'));
        $this->excel->getActiveSheet()->setCellValue('C1', lang('tests_steps_export_thead_action'));
        $this->excel->getActiveSheet()->setCellValue('D1', lang('tests_steps_export_thead_expected'));
        $this->excel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $steps = $this->tests_model->get_steps($id);
        $line = 2;
        foreach ($steps as $step) {
            $this->excel->getActiveSheet()->setCellValue('A' . $line, $step['ord']);
            $this->excel->getActiveSheet()->setCellValue('B' . $line, $step['name']);
            $this->excel->getActiveSheet()->setCellValue('C' . $line, $step['action']);
            $this->excel->getActiveSheet()->setCellValue('D' . $line, $step['expected']);
            $line++;
        }
        
        //Autofit
        foreach(range('A', 'D') as $colD) {
            $this->excel->getActiveSheet()->getColumnDimension($colD)->setAutoSize(TRUE);
        }

        $filename = 'steps.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }
}
