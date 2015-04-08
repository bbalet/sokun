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
$this->lang->load('calendar', $language);
$this->lang->load('campaigns', $language);
$this->lang->load('global', $language);?>

<div class="row-fluid">
    <div class="col-md-12">
        <h1><?php echo lang('campaigns_calendar_title');?></h1>
        
        <p><?php echo lang('campaigns_calendar_description');?></p>

        <div id='calendar'></div>

        <div class="modal hide" id="frmModalAjaxWait" data-backdrop="static" data-keyboard="false">
                <div class="modal-header">
                    <h1><?php echo lang('global_msg_wait');?></h1>
                </div>
                <div class="modal-body">
                    <img src="<?php echo base_url();?>assets/images/loading.gif"  align="middle">
                </div>
         </div>

        <div class="row-fluid"><div class="col-md-12">&nbsp;</div></div>

    </div>
</div>

<div class="row-fluid">
    <div class="col-md-12">
      <a href="<?php echo base_url();?>campaigns" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left glyphicon-white"></i>&nbsp;<?php echo lang('campaigns_calendar_button_back');?></a>
    </div>
</div>

<div class="row"><div class="col-md-12">&nbsp;</div></div>

<link href="<?php echo base_url();?>assets/fullcalendar/fullcalendar.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/fullcalendar/lib/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/fullcalendar/lang/<?php echo $language_code;?>.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //Create a calendar and fill it with AJAX events
    $('#calendar').fullCalendar({
        height: 500,
        timeFormat: ' ', /*Trick to remove the start time of the event*/
        header: {
            left: "prev,next today",
            center: "title",
            right: ""
        },
        events: '<?php echo base_url();?>campaigns/calfeed',
        loading: function(isLoading) {
            if (isLoading) { //Display/Hide a pop-up showing an animated icon during the Ajax query.
                $('#frmModalAjaxWait').modal('show');
            } else {
                $('#frmModalAjaxWait').modal('hide');
            }    
        },
        eventClick: function(calEvent, jsEvent, view) {
            document.location = '<?php echo base_url();?>campaigns/' + calEvent.id + '/tests';
        }
    });
});
</script>

