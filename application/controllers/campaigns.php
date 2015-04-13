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

class Campaigns extends CI_Controller {

    /**
     * Default constructor
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function __construct() {
        parent::__construct();
        setUserContext($this);
        $this->lang->load('campaigns', $this->language);
        $this->lang->load('global', $this->language);
        $this->load->model('campaigns_model');
    }
    
    /**
     * List of campaigns
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function index() {
        $this->auth->check_is_granted('campaigns_list');
        $data = getUserContext($this);
        $data['title'] = lang('campaigns_index_title');
        $data['campaigns'] = $this->campaigns_model->get_campaigns();
        $data['flash_partial_view'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('campaigns/index', $data);
        $this->load->view('templates/footer');   
    }

    /**
     * Create a campaign. Rules are checked on client side
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function create() {
        $this->auth->check_is_granted('campaigns_create');
        expires_now();
        $data = getUserContext($this);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('campaigns_create_field_name'), 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['title'] = lang('campaigns_create_title');
            $this->load->view('templates/header', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('campaigns/create');
            $this->load->view('templates/footer');
        } else {
            $this->campaigns_model->set_campaigns();
            $this->session->set_flashdata('msg', lang('campaigns_create_flash_msg_success'));
            redirect('campaigns');
        }
    }
    
    /**
     * Update a campaign. Rules are checked on client side
     * @param int $id Identifier of the campaign
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function edit($id) {
        $this->auth->check_is_granted('campaigns_edit');
        expires_now();
        $data = getUserContext($this);
        $data['campaign'] = $this->campaigns_model->get_campaigns($id);
        if (empty($data['campaign'])) {
            show_404();
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('campaigns_edit_field_name'), 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['title'] = lang('campaigns_edit_title');
            $this->load->view('templates/header', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('campaigns/edit');
            $this->load->view('templates/footer');
        } else {
            $this->campaigns_model->update_campaigns($id);
            $this->session->set_flashdata('msg', lang('campaigns_edit_flash_msg_success'));
            redirect('campaigns');
        }
    }
    
    /**
     * Delete a campaign (if it exists)
     * @param int $id Identifier of the campaign
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete($id) {
        $this->auth->check_is_granted('campaigns_delete');
        //Test if the campaign exists
        $campaign = $this->campaigns_model->get_campaigns($id);
        if (empty($campaign)) {
            show_404();
        } else {
            $this->campaigns_model->delete_campaign($id);
        }
        $this->session->set_flashdata('msg', lang('campaigns_delete_flash_msg_success'));
        redirect('campaigns');
    }
    
    /**
     * List of tests in a campaign
     * @param int $id Identifier of the campaign
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function tests($id) {
        $this->auth->check_is_granted('campaigns_tests');
        $data = getUserContext($this);
        $data['title'] = lang('campaigns_index_title');
        $campaign = $this->campaigns_model->get_campaigns($id);
        $data['campaign_id'] = $id;
        $data['campaign_name'] = $campaign['name'];
        $data['tests'] = $this->campaigns_model->get_tests($id);
        $data['flash_partial_view'] = $this->load->view('templates/flash', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('campaigns/tests', $data);
        $this->load->view('templates/footer');   
    }
    
    /**
     * Remove a test from a campaign
     * @param int $campaign campaign identifier
     * @param int $assoc_id identifier of the campaign/test association
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function remove_test($campaign, $assoc_id) {
        $this->auth->check_is_granted('campaigns_remove');
        $this->campaigns_model->remove_test($assoc_id);
        $this->session->set_flashdata('msg', lang('campaigns_remove_test_flash_msg_success'));
        redirect('campaigns/' . $campaign . '/tests');
    }
    
    /**
     * Add a test into a campaign
     * @param int $campaign campaign identifier
     * @param int $test test identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function add_test($campaign, $test) {
        $this->auth->check_is_granted('campaigns_remove');
        $this->campaigns_model->add_test($campaign, $test);
        $this->session->set_flashdata('msg', lang('campaigns_add_test_flash_msg_success'));
        redirect('campaigns/' . $campaign . '/tests');
    }
    
    /**
     * Calendar of campaigns
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function calendar() {
        $this->auth->check_is_granted('campaigns_calendar');
        $data = getUserContext($this);
        $data['title'] = lang('campaigns_calendar_title');
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('campaigns/calendar', $data);
        $this->load->view('templates/footer');   
    }
    
    /**
     * Ajax endpoint : Send a list of fullcalendar events
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function calfeed() {
        expires_now();
        header("Content-Type: application/json");
        $start = $this->input->get('start', TRUE);
        $end = $this->input->get('end', TRUE);
        echo $this->campaigns_model->events($start, $end);
    }
    
    /**
     * Export the list of all campaigns into an Excel file
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function export() {
        expires_now();
        $this->load->library('excel');
        $this->load->helper('html');
        $this->load->helper('richtext');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle(lang('campaigns_export_title'));
        $this->excel->getActiveSheet()->setCellValue('A1', lang('campaigns_export_thead_id'));
        $this->excel->getActiveSheet()->setCellValue('B1', lang('campaigns_export_thead_name'));
        $this->excel->getActiveSheet()->setCellValue('C1', lang('campaigns_export_thead_start_date'));
        $this->excel->getActiveSheet()->setCellValue('D1', lang('campaigns_export_thead_end_date'));
        $this->excel->getActiveSheet()->setCellValue('E1', lang('campaigns_export_thead_description'));
        $this->excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $campaigns = $this->campaigns_model->get_campaigns();
        $line = 2;
        foreach ($campaigns as $campaign) {
            $date = new DateTime($campaign['startdate']);
            $startdate = $date->format(lang('global_date_format'));
            $date = new DateTime($campaign['enddate']);
            $enddate = $date->format(lang('global_date_format'));
            $this->excel->getActiveSheet()->setCellValue('A' . $line, $campaign['id']);
            $this->excel->getActiveSheet()->setCellValue('B' . $line, $campaign['name']);
            $this->excel->getActiveSheet()->setCellValue('C' . $line, $startdate);
            $this->excel->getActiveSheet()->setCellValue('D' . $line, $enddate);
            $this->excel->getActiveSheet()->setCellValue('E' . $line, createRichText($campaign['description']));
            $this->excel->getActiveSheet()->getStyle('E' . $line)->getAlignment()->setWrapText(true);
            $line++;
        }
        
        //Autofit
        foreach(range('A', 'E') as $colD) {
            $this->excel->getActiveSheet()->getColumnDimension($colD)->setAutoSize(TRUE);
        }

        $filename = 'campaigns.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }
    
    /**
     * Export the list of all tests of a campaign into an Excel file
     * @param int $id Identifier of the campaign
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function export_tests($id) {
        expires_now();
        $this->load->library('excel');
        $this->load->helper('html');
        $this->load->helper('richtext');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle(lang('campaigns_tests_export_title'));
        
        $campaign = $this->campaigns_model->get_campaigns($id);
        $this->excel->getActiveSheet()->setCellValue('A1', lang('campaigns_tests_export_title'));
        $this->excel->getActiveSheet()->setCellValue('A2', $campaign['name']);
        
        $this->excel->getActiveSheet()->setCellValue('A3', lang('campaigns_tests_export_thead_id'));
        $this->excel->getActiveSheet()->setCellValue('B3', lang('campaigns_tests_export_thead_name'));
        $this->excel->getActiveSheet()->setCellValue('C3', lang('campaigns_tests_export_thead_description'));
        $this->excel->getActiveSheet()->getStyle('A3:C3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A3:C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $tests = $this->campaigns_model->get_tests($id);
        $line = 4;
        foreach ($tests as $test) {
            $this->excel->getActiveSheet()->setCellValue('A' . $line, $test['id']);
            $this->excel->getActiveSheet()->setCellValue('B' . $line, $test['name']);
            $this->excel->getActiveSheet()->setCellValue('C' . $line, createRichText($test['description']));
            $this->excel->getActiveSheet()->getStyle('C' . $line)->getAlignment()->setWrapText(true);
            $line++;
        }
        
        //Autofit
        foreach(range('A', 'C') as $colD) {
            $this->excel->getActiveSheet()->getColumnDimension($colD)->setAutoSize(TRUE);
        }

        $filename = 'campaign_tests.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

}
