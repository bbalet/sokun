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

class Tests_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        
    }
    
    /**
     * Get the list of tests or one test
     * @param int $id optional id of a test
     * @return array record of tests
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_tests($id = 0) {
        $this->db->select('tests.*');
        $this->db->select('CONCAT_WS(\' \', users.firstname, users.lastname) as creator_name', FALSE);
        $this->db->join('users', 'users.id = tests.creator');
        if ($id === 0) {
            $query = $this->db->get('tests');
            return $query->result_array();
        }
        $query = $this->db->get_where('tests', array('tests.id' => $id));
        return $query->row_array();
    }

    /**
     * Insert a new test
     * Inserted data are coming from an HTML form
     * @param int $creator Identifier of the creator (connected user)
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function set_tests($creator) {
        $data = array(
            'name' => $this->input->post('name'),
            'creator' => $creator,
            'description' => $this->input->post('description')
        );
        return $this->db->insert('tests', $data);
    }
    
    /**
     * Update a test with data coming from an HTML form
     * @param int $id Identifer of the test
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function update_tests($id) {
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
        );
        $this->db->where('id', $id);
        return $this->db->update('tests', $data);
    }
    
    /**
     * Delete a test and its steps from the database
     * @param int $id test identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete_test($id) {
        $query = $this->db->delete('tests', array('id' => $id));
        //Cascade delete steps
        $this->delete_steps($id);
    }
    
    /**
     * Get the list of test steps of a given test
     * @param int $test test identifier
     * @return array record of test steps
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_steps($test) {
        $query = $this->db->get_where('steps', array('test' => $test));
        return $query->result_array();
    }
    
    
    /**
     * Get ta test step
     * @param int $step Identifier of step
     * @return array record containing one test step
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_step($step) {
        $query = $this->db->get_where('steps', array('id' => $id));
        return $query->row_array();
    }
    
    /**
     * Get the maximum value in a list of test steps and for a given test
     * @param int $test test identifier
     * @return array record of test steps
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_steps_max($test) {
        $this->db->select('max(steps.ord) as max_order');
        $query = $this->db->get_where('steps', array('test' => $test));
        $result = $query->row_array();
        return $result['max_order'];
    }

    /**
     * Move up a test step
     * @param int $id Identifer of the step
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function up_step($id) {
        $step = $this->get_step($id);
        //Update the switched step
        $sql = 'UPDATE steps
                    INNER JOIN steps s
                    SET steps.ord = steps.ord - 1
                    WHERE steps.test = 1
                    AND steps.id = s.id
                    AND s.test = ' . $step['test'] . ' AND s.ord = ' . ($step['ord'] - 1);
        $this->db->simple_query($sql);
        //Update current step
        $data = array(
            'ord' => ($step['ord'] + 1)
        );
        $this->db->where('id', $id);
        return $this->db->update('steps', $data);
    }
    
    /**
     * Move down a test step
     * @param int $id Identifer of the step
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function down_step($id) {
        $step = $this->get_step($id);
        //Update the switched step
        $sql = 'UPDATE steps
                    INNER JOIN steps s
                    SET steps.ord = steps.ord + 1
                    WHERE steps.test = 1
                    AND steps.id = s.id
                    AND s.test = ' . $step['test'] . ' AND s.ord = ' . ($step['ord'] - 1);
        $this->db->simple_query($sql);
        //Update current step
        $data = array(
            'ord' => ($step['ord'] - 1)
        );
        $this->db->where('id', $id);
        return $this->db->update('steps', $data);
    }
    
    /**
     * Insert a new test step
     * Inserted data are coming from an HTML form
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function set_steps() {
        $data = array(
            'test' => $this->input->post('test'),
            'name' => $this->input->post('name'),
            'action' => $this->input->post('action'),
            'expected' => $this->input->post('expected')
        );
        return $this->db->insert('steps', $data);
    }
    
    /**
     * Delete the steps of a test from the database
     * @param int $test test identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete_steps($test) {
        $query = $this->db->delete('steps', array('test' => $test));
    }
}