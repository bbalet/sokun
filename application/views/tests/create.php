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
$this->lang->load('users', $language);
$this->lang->load('datatable', $language);
?>
<div class="row-fluid">
    <div class="col-md-12">

        <h2><?php echo lang('tests_index_title');?></h2>


        <div class="row-fluid"> <div class="col-md-12">&nbsp;</div></div>

        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo base_url();?>tests/create" class="btn btn-primary"><span class="glyphicon glyphicon-plus glyphicon-white"></span>&nbsp;<?php echo lang('tests_index_button_create');?></a>
                &nbsp;
                <a href="<?php echo base_url();?>tests/export" class="btn btn-primary"><span class="glyphicon glyphicon-save-file glyphicon-white"></span>&nbsp;<?php echo lang('tests_index_button_export');?></a>
             </div>
        </div>

    
    </div>
</div>

