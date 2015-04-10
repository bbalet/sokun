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
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function up($test, $step) {
        $this->auth->check_is_granted('steps_up');
        $this->tests_model->up_step($step);
        redirect('tests/' . $test . '/steps');
    }
    
    /**
     * Action move a test step down
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function down($test, $step) {
        $this->auth->check_is_granted('steps_down');
        $this->tests_model->down_step($step);
        redirect('tests/' . $test . '/steps');
    }
}
