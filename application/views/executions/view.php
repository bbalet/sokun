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
?>

<div class="row-fluid">
    <div class="col-md-12">
            <h1><?php echo lang('executions_view_title');?>&nbsp;<span class="text-muted"><?php echo $test['name'];?></span></h1>
     </div>
</div>

<div class="row-fluid">
    <div class="col-md-12">
        <a href="<?php echo base_url();?>campaigns/<?php echo $campaign;?>/tests/<?php echo $testinstance;?>/executions" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left glyphicon-white"></span>&nbsp;<?php echo lang('executions_view_button_back');?></a>
        &nbsp;
        <button id="cmdShowDescription" class="btn btn-primary"><span class="glyphicon glyphicon-info-sign glyphicon-white"></span>&nbsp;<?php echo lang('executions_view_button_description');?></button>
     </div>
</div>

<div class="row-fluid"><div class="col-md-12">&nbsp;</div></div>

<div class="row-fluid">
    <div class="col-md-4">
        <div class="form-group">
            <label for="teststatus" class="col-sm-2 control-label"><?php echo lang('executions_view_field_test_status');?></label>
            <div class="col-sm-10">
                <select name="teststatus" class="form-control" readonly>
                    <option selected><?php echo lang($test['status_name']);?></option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        &nbsp;
    </div>
</div>
    
<div class="row-fluid"><div class="col-md-12">&nbsp;</div></div>

<div class="row-fluid">
    <div class="col-md-12">
        <table class="table table-bordered table-condensed" id="steps" width="100%">
            <thead>
                <tr>
                    <th><?php echo lang('executions_view_thead_order');?></th>
                    <th><?php echo lang('executions_view_thead_name');?></th>
                    <th><?php echo lang('executions_view_thead_action');?></th>
                    <th><?php echo lang('executions_view_thead_expected');?></th>
                    <th><?php echo lang('executions_view_thead_status');?></th>
                    <th><?php echo lang('executions_view_thead_actual');?></th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($steps as $step): ?>
            <tr>
                <td><?php echo $step['ord']; ?></td>
                <td><?php echo $step['name'] ?></td>
                <td><?php echo $step['action'] ?></td>
                <td><?php echo $step['expected'] ?></td>
                <td><strong><?php echo lang($step['status_name']);?></strong></td>
                <td><?php echo $step['actual'] ?></td>
            </tr>
        <?php endforeach ?>
                </tbody>
        </table>
        
<!-- Test description -->
<div id="frmTestDescription" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo lang('executions_view_popup_test_description_title');?></h4>
      </div>
      <div class="modal-body">
        <?php echo $test['description'];?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('executions_view_popup_test_button_close');?></button>
      </div>
    </div>
  </div>
</div>
        
    </div>
</div>

<div class="row"> <div class="col-md-12">&nbsp;</div></div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    var action;
    var expected;
$(document).ready(function() {
    //Show Test description
    $('#cmdShowDescription').click(function() {
        $('#frmTestDescription').modal('show');
    });
});
</script>