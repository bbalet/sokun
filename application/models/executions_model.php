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
        $this->db->join('stepsexecution', 'stepsexecution.testexecution = testexecution.id');
        $this->db->join('status test_status', 'testexecution.status = test_status.id', 'left');
        $this->db->join('status step_status', 'stepsexecution.status = step_status.id', 'left');
        $query = $this->db->get('testexecution', array('id' => $id));
        $result = $query->result_array();
        $status = 'N/A';
        if (count($result) > 0) {
            foreach ($result as $row) {
                if (is_null($row['test_status'])) {
                    if (!is_null($row['step_status'])) {
                        if ($row['step_status'] == 3) {//Failed
                            return 'Failed';
                        } else {
                            $status = $row['step_status'];
                        }
                    }
                } else {
                    return $row['test_status'];
                }
            }
        } else {
            return 'Not Run';
        }
        return $status;
    }
    
    
}