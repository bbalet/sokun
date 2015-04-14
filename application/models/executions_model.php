<?php
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

class Executions_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        
    }
    
    /**
     * Get a test from its instance in campaign
     * @param int $id id of a test in a campaign
     * @return array one test record
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_test_from_instance($id= 0) {
        $this->db->select('test');
        $query = $this->db->get_where('campaigntests', array('id' => $id));
        $result = $query->row_array();
        $this->load->model('tests_model');
        return $this->tests_model->get_tests($result['test']);
    }
    
    /**
     * Get a test from its execution
     * @param int $id id of a test execution
     * @return array one test record
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_test_from_execution($id= 0) {
        $this->db->select('campaigntests.test as test_id');
        $this->db->join('campaigntests', 'campaigntests.id = testexecution.campaigntest');
        $query = $this->db->get_where('testexecution', array('id' => $id));
        $result = $query->row_array();
        $this->load->model('tests_model');
        return $this->tests_model->get_tests($result['campaigntests']);
    }
    
    /**
     * Get the list of executed tests or one test
     * @param int $id optional id of a test execution
     * @return array record of tests
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_tests($id= 0) {
        $this->db->select('testexecution.*');
        $this->db->select('status.name as status_name');
        $this->db->select('CONCAT_WS(\' \', users.firstname, users.lastname) as executed_by', FALSE);
        $this->db->join('users', 'users.id = testexecution.executed_by');
        $this->db->join('status', 'testexecution.status = status.id');
        if ($id === 0) {
            $query = $this->db->get('testexecution');
            return $query->result_array();
        }
        $query = $this->db->get_where('testexecution', array('testexecution.id' => $id));
        return $query->row_array();
    }
    
    /**
     * Get the list of test steps of an executed test
     * @param int $test test execution identifier
     * @return array record of test steps
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_steps($testexecution) {
        $this->db->select('stepsexecution.*');
        $this->db->select('status.name as status_name');
        $this->db->join('status', 'stepsexecution.status = status.id');
        $query = $this->db->get_where('stepsexecution', array('testexecution' => $testexecution));
        $this->db->order_by('ord', 'asc');
        return $query->result_array();
    }
    
    /**
     * Get the list of executions of a test in a campaing
     * @param int $id id of a test in a campaign
     * @return array record of tests
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_executions($testinstance) {
        $this->db->select('testexecution.*');
        $this->db->select('status.name as status_name');
        $this->db->select('CONCAT_WS(\' \', users.firstname, users.lastname) as executed_by', FALSE);
        $this->db->order_by('executiondate', 'desc');
        $this->db->join('campaigntests', 'testexecution.campaigntest = campaigntests.id');
        $this->db->join('status', 'testexecution.status = status.id');
        $this->db->join('users', 'users.id = testexecution.executed_by');
        $this->db->where('campaigntests.id', $testinstance);
        $query = $this->db->get('testexecution');
        return $query->result_array();
    }
    
    /**
     * Delete a test execution and associated steps
     * @param int $test test execution identifier
     * @return array record of test steps
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete_execution($testexecution) {
        $this->db->delete('testexecution', array('id' => $testexecution));
        $this->db->delete('stepsexecution', array('testexecution' => $testexecution));
    }
    
    /**
     * Update the global status of the test (and executed_by, datetime)
     * Inserted data are coming from an HTML form
     * @param int $test test execution identifier
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function update_status($testexecution) {
        $data = array(
            'status' => $this->input->post('teststatus'),
            'executed_by' => $this->session->userdata('id')
        );
        $this->db->set('executiondate', 'NOW()', FALSE);
        $this->db->where('id', $testexecution);
        return $this->db->update('testexecution', $data);
    }
    
    /**
     * Update the steps of a test execution
     * Inserted data are coming from an HTML form
     * @param int $test test execution identifier
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function update_steps() {
        $nbSteps = intval($this->input->post('steps')); //Nb of steps to be updated
        for ($ii = 1; $ii <= $nbSteps; $ii++) {
            $data = array(
                'status' => $this->input->post('status_' . $ii),
                'actual' => $this->input->post('actual_' . $ii)
            );
            $this->db->where('id', $this->input->post('id_' . $ii));
            $this->db->update('stepsexecution', $data);   
        }
    }
    
    /**
     * Execute a test :
     *  - Create a test execution record
     *  - Copy the steps of the test
     * @param int $id Identifer of the test in a campaign
     * @return int Test execution Identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function execute($id) {
        //Get the ID of the test
        $query = $this->db->get_where('campaigntests', array('id' => $id));
        $test = $query->row_array();
        
        //Create a test execution record
        $sql = 'INSERT INTO testexecution
                    (campaigntest, executed_by, name, description)
                    SELECT ' . $id . ' , ' . $this->session->userdata('id') . ', name, description
                    FROM tests 
                    WHERE tests.id = ' . $test['test'];
        $this->db->simple_query($sql);
        $testexecution = $this->db->insert_id();
        
        //Copy the steps of the test
        $sql = 'INSERT INTO stepsexecution
                    (testexecution, ord, name, action, expected)
                    SELECT ' . $testexecution . ' , ord, name, action, expected
                    FROM steps 
                    WHERE steps.test = ' . $test['test'];
        $this->db->simple_query($sql);
        
        return $testexecution;
    }
    
    /**
     * Get the latest execution status of a test
     * @param int $id test identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function last_execution_status($id) {
        //IF the test was never run => 'Not run'
        //ELSE
        //    Two possibilities :
        //     - an execution status was set on the test instance -> it has priority (testexecution)
        //     - Look the different statuses set on each steps (stepsexecution),
        //           if one has failed all test failed
        //     default status is 'N/A' for not available
        //FI
        
        $this->db->select('test_status.name as test_status_name');
        $this->db->select('step_status.name as step_status_name');
        $this->db->join('stepsexecution', 'stepsexecution.testexecution = testexecution.id', 'left');
        $this->db->join('status test_status', 'testexecution.status = test_status.id', 'left');
        $this->db->join('status step_status', 'stepsexecution.status = step_status.id', 'left');
        $query = $this->db->get('testexecution', array('id' => $id));
        $result = $query->result_array();
        $status = 'N/A';
        if (count($result) > 0) {
            foreach ($result as $row) {
                if (is_null($row['test_status_name'])) {
                    if (!is_null($row['step_status_name'])) {
                        if ($row['step_status'] == 3) {//Failed
                            return 'Failed';
                        } else {
                            $status = $row['step_status_name'];
                        }
                    }
                } else {
                    return $row['test_status_name'];
                }
            }
        } else {
            return 'Not Run';
        }
        return $status;
    }
    
    
}