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

class Campaigns_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        
    }
    
    /**
     * Get the list of campaigns or one campaign
     * @param int $id optional id of a campaign
     * @return array record of campaigns
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_campaigns($id = 0) {
        if ($id === 0) {
            $query = $this->db->get('campaigns');
            return $query->result_array();
        }
        $query = $this->db->get_where('campaigns', array('id' => $id));
        return $query->row_array();
    }

    /**
     * Insert a new campaign
     * Inserted data are coming from an HTML form
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function set_campaigns() {
        $data = array(
            'name' => $this->input->post('name'),
            'startdate' => $this->input->post('startdate')==""?NULL:$this->input->post('startdate'),
            'enddate' => $this->input->post('enddate')==""?NULL:$this->input->post('enddate'),
            'description' => $this->input->post('description')
        );
        return $this->db->insert('campaigns', $data);
    }
    
    /**
     * Update a campaign with data coming from an HTML form
     * @param int $id Identifer of the campaign
     * @return int number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function update_campaigns($id) {
        $data = array(
            'name' => $this->input->post('name'),
            'startdate' => $this->input->post('startdate')==""?NULL:$this->input->post('startdate'),
            'enddate' => $this->input->post('enddate')==""?NULL:$this->input->post('enddate'),
            'description' => $this->input->post('description')
        );
        $this->db->where('id', $id);
        return $this->db->update('campaigns', $data);
    }
    
    /**
     * Get the list of tests in a campaign
     * @param int $id campaign identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function get_tests($id) {
        $this->db->select('campaigntests.id as assoc_id, tests.*');
        $this->db->join('tests', 'tests.id = campaigntests.test');
        $this->db->join('users', 'users.id = tests.creator');
        $query = $this->db->get_where('campaigntests', array('campaign' => $id));
        return $query->result_array();
    }
    
    /**
     * delete a test/campaign association
     * @param int $assoc_id identifier of the campaign/test association
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function remove_test($assoc_id) {
        $this->db->delete('campaigntests', array('id' => $assoc_id));
    }
    
    /**
     * add a test/campaign association
     * @param int $campaign campaign identifier
     * @param int $test test identifier
     * @return int Number of affected rows
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function add_test($campaign, $test) {
        $data = array(
            'campaign' => $campaign,
            'test' => $test
        );
        return $this->db->insert('campaigntests', $data);
    }
    
    /**
     * Delete a campaign from the database
     * @param int $id campaign identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete_campaign($id) {
        $this->db->delete('campaigns', array('id' => $id));
        //delete tests/campaign associations
        $this->db->delete('campaigntests', array('campaign' => $id));
    }
    
    /**
     * Calendar feed for FullCalendar widget = List of campaigns
     * @param string $start Unix timestamp / Start date displayed on calendar
     * @param string $end Unix timestamp / End date displayed on calendar
     * @return string JSON encoded list of full calendar events
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function events($start = "", $end = "") {
        $this->db->where('( (startdate <= DATE(\'' . $start . '\') AND enddate >= DATE(\'' . $start . '\'))' .
                                   ' OR (startdate >= DATE(\'' . $start . '\') AND enddate <= DATE(\'' . $end . '\')))');
        $this->db->order_by('startdate', 'desc');
        $this->db->limit(1024);  //Security limit
        $events = $this->db->get('campaigns')->result();
        
        $jsonevents = array();
        foreach ($events as $entry) {
            $jsonevents[] = array(
                'id' => $entry->id,
                'title' => $entry->name,
                'start' => $entry->startdate,
                'allDay' => false,
                'end' => $entry->enddate
            );
        }
        return json_encode($jsonevents);
    }
}