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

CI_Controller::get_instance()->load->helper('language');
$this->lang->load('menu', $language);?>

<div class="row-fluid">
    <div class="col-md-6">
        <h3><a href="<?php echo base_url();?>" style="text-decoration:none; color:black;"><img src="<?php echo base_url();?>assets/images/logo.png">&nbsp;<?php echo lang('menu_banner_slogan');?></a>
    </div>
    <div class="col-md-6 pull-right">
        <a href="<?php echo base_url();?>users/reset/<?php echo $user_id; ?>" title="<?php echo lang('menu_banner_tip_reset');?>" data-toggle="modal" data-target="#frmChangeMyPwd"><span class="glyphicon glyphicon-lock"></span></a>
        &nbsp;
        <?php echo lang('menu_banner_welcome');?> <?php echo $fullname;?>, <a href="<?php echo base_url();?>connection/logout"><?php echo lang('menu_banner_logout');?></a>     
    </div>
</div>

<div id="frmChangeMyPwd" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
             <h4 class="modal-title"><?php echo lang('menu_password_popup_title');?></h4>
        </div>
        <div class="modal-body">
            <img src="<?php echo base_url();?>assets/images/loading.gif">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('menu_password_popup_button_cancel');?></button>
        </div>
    </div>
  </div>
</div>

<div class="row-fluid">
    <div class="col-md-12">
        <div class="navbar navbar-inverse">
            <?php if ($is_admin == TRUE) { ?>
            <ul class="nav navbar-nav">			  
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('menu_admin_title');?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url();?>users"><?php echo lang('menu_admin_list_users');?></a></li>
                  <li><a href="<?php echo base_url();?>users/create"><?php echo lang('menu_admin_add_user');?></a></li>
                </ul>
              </li>
            </ul>
            <?php } ?>
            <!--<ul class="nav navbar-nav">			  
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('menu_assets_title');?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url();?>locations"><?php echo lang('menu_assets_locations');?></a></li>
                </ul>
              </li>
            </ul>//-->
           <ul class="nav navbar-nav">			  
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('menu_tests_title');?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url();?>tests"><?php echo lang('menu_tests_index');?></a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav">			  
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('menu_campaigns_title');?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url();?>campaigns"><?php echo lang('menu_campaigns_index');?></a></li>
                  <li><a href="<?php echo base_url();?>campaigns/calendar"><?php echo lang('menu_campaigns_calendar');?></a></li>
                </ul>
              </li>
            </ul>
        </div>
    </div>
</div>
