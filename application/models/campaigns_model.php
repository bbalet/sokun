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
            'startdate' => $this->input->post('startdate'),
            'enddate' => $this->input->post('enddate'),
            'description' => $this->input->post('description')
        );
        return $this->db->insert('campaigns', $data);
    }
    
    /**
     * Delete a campaign from the database
     * @param int $id campaign identifier
     * @author Benjamin BALET <benjamin.balet@gmail.com>
     */
    public function delete_campaign($id) {
        $query = $this->db->delete('tests', array('id' => $id));
        //Cascade delete steps
        $this->delete_steps($id);
    }
    
}