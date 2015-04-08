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
        $this->load->view('templates/header', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('campaigns/index', $data);
        $this->load->view('templates/footer');   
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
}
