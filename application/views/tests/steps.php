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
$this->lang->load('datatable', $language);?>


<div class="row-fluid">
    <div class="col-md-12">
            <h1><?php echo lang('tests_steps_title');?>&nbsp;<span class="text-muted"><?php echo $test['name'];?></span></h1>
            <?php echo $flash_partial_view;?>
     </div>
</div>

<div class="row-fluid">
    <div class="col-md-12">
        <a href="<?php echo base_url();?>tests" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left glyphicon-white"></span>&nbsp;<?php echo lang('tests_steps_button_back');?></a>
        &nbsp;
        <button id="cmdAddStep" class="btn btn-primary"><span class="glyphicon glyphicon-plus glyphicon-white"></span>&nbsp;<?php echo lang('tests_steps_button_new');?></button>
        &nbsp;
        <a href="<?php echo base_url();?>tests/<?php echo $test['id'] ?>/steps/export" class="btn btn-primary"><span class="glyphicon glyphicon-save-file glyphicon-white"></span>&nbsp;<?php echo lang('tests_steps_button_export');?></a>
        &nbsp;
        <button id="cmdShowDescription" class="btn btn-primary"><span class="glyphicon glyphicon-info-sign glyphicon-white"></span>&nbsp;<?php echo lang('tests_steps_button_description');?></button>
     </div>
</div>

<div class="row-fluid"><div class="col-md-12">&nbsp;</div></div>

<div class="row-fluid">
    <div class="col-md-12">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="steps" width="100%">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th><?php echo lang('tests_steps_field_name');?></th>
                    <th><?php echo lang('tests_steps_thead_action');?></th>
                    <th><?php echo lang('tests_steps_thead_expected');?></th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($steps as $step): ?>
            <tr data-id="<?php echo $step['id'] ?>">
                <td data-order="<?php echo $step['ord']; ?>">&nbsp;
                    <div class="pull-right">
                        <?php if ($step['ord'] != 1) { ?>
                        <a href="<?php echo base_url();?>tests/<?php echo $test['id'] ?>/steps/<?php echo $step['id'] ?>/up" title="<?php echo lang('tests_steps_thead_tip_up');?>"><span class="glyphicon glyphicon-arrow-up"></span></a>
                        <?php } ?>
                        &nbsp;
                        <?php if ($step['ord'] != $max) { ?>
                        <a href="<?php echo base_url();?>tests/<?php echo $test['id'] ?>/steps/<?php echo $step['id'] ?>/down" title="<?php echo lang('tests_steps_thead_tip_down');?>"><span class="glyphicon glyphicon-arrow-down"></span></a>
                        <?php } ?>
                        &nbsp;
                        <a href="#" class="step-edit" data-id="<?php echo $step['id'];?>" title="<?php echo lang('tests_steps_thead_tip_edit');?>"><span class="glyphicon glyphicon-pencil"></span></a>
                        &nbsp;
                        <a href="#" class="step-duplicate" data-id="<?php echo $step['id'];?>" title="<?php echo lang('tests_steps_thead_tip_duplicate');?>"><span class="glyphicon glyphicon-duplicate"></span></a>
                        &nbsp;
                        <a href="#" class="confirm-delete" data-id="<?php echo $step['id'];?>" title="<?php echo lang('tests_steps_thead_tip_delete');?>"><span class="glyphicon glyphicon-trash"></span></a>
                        &nbsp;
                        <?php echo $step['ord']; ?>
                    </div>
                </td>
                <td><?php echo $step['name'] ?></td>
                <td><?php echo $step['action'] ?></td>
                <td><?php echo $step['expected'] ?></td>
            </tr>
        <?php endforeach ?>
                </tbody>
        </table>

<div id="frmEditStep" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h3><?php echo lang('tests_steps_popup_edit_title');?></h3>
            </div>
            <div id="" class="modal-body">
                <form id="frmCreateStep"  class='form-horizontal' method="POST" accept-charset="UTF-8">
                    <div class="form-group">
                       <label for="name" class="col-sm-2 control-label"><?php echo lang('tests_steps_field_name');?></label>
                       <div class="col-sm-10">
                           <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo lang('tests_create_field_name');?>" autofocus required />
                       </div>
                   </div>
                    <div class="form-group">
                       <label for="action" class="col-sm-2 control-label"><?php echo lang('tests_steps_field_action');?></label>
                       <div class="col-sm-10">
                           <textarea name="action" id="action"></textarea>
                       </div>
                   </div>
                     <div class="form-group">
                       <label for="expected" class="col-sm-2 control-label"><?php echo lang('tests_steps_field_expected');?></label>
                       <div class="col-sm-10">
                           <textarea name="expected" id="expected"></textarea>
                       </div>
                   </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="cmdSubmitForm" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;<?php echo lang('tests_steps_button_add');?></button>
                &nbsp;
                <button  data-dismiss="modal" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;<?php echo lang('tests_steps_button_cancel');?></button>
            </div>
        </div>
    </div>
</div>
        
<!-- Test description -->
<div id="frmTestDescription" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo lang('tests_steps_popup_test_description_title');?></h4>
      </div>
      <div class="modal-body">
        <?php echo $test['description'];?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('tests_steps_popup_test_button_close');?></button>
      </div>
    </div>
  </div>
</div>
        
    </div>
</div>

<div class="row"> <div class="col-md-12">&nbsp;</div></div>

<link href="<?php echo base_url();?>assets/datatable/css/jquery.dataTables.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/ckeditor/skins/moono/editor.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/ckeditor/skins/moono/dialog.css">
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    var action;
    var expected;
$(document).ready(function() {
    //Transform the HTML table
    $('#steps').dataTable({
            "oLanguage": {
                "sEmptyTable":     "<?php echo lang('datatable_sEmptyTable');?>",
                "sInfo":           "<?php echo lang('datatable_sInfo');?>",
                "sInfoEmpty":      "<?php echo lang('datatable_sInfoEmpty');?>",
                "sInfoFiltered":   "<?php echo lang('datatable_sInfoFiltered');?>",
                "sInfoPostFix":    "<?php echo lang('datatable_sInfoPostFix');?>",
                "sInfoThousands":  "<?php echo lang('datatable_sInfoThousands');?>",
                "sLengthMenu":     "<?php echo lang('datatable_sLengthMenu');?>",
                "sLoadingRecords": "<?php echo lang('datatable_sLoadingRecords');?>",
                "sProcessing":     "<?php echo lang('datatable_sProcessing');?>",
                "sSearch":         "<?php echo lang('datatable_sSearch');?>",
                "sZeroRecords":    "<?php echo lang('datatable_sZeroRecords');?>",
                "oPaginate": {
                    "sFirst":    "<?php echo lang('datatable_sFirst');?>",
                    "sLast":     "<?php echo lang('datatable_sLast');?>",
                    "sNext":     "<?php echo lang('datatable_sNext');?>",
                    "sPrevious": "<?php echo lang('datatable_sPrevious');?>"
                },
                "oAria": {
                    "sSortAscending":  "<?php echo lang('datatable_sSortAscending');?>",
                    "sSortDescending": "<?php echo lang('datatable_sSortDescending');?>"
                }
            }
        });
        
     action = CKEDITOR.replace( 'action', {
        language: '<?php echo $language_code;?>',
        toolbarStartupExpanded : false,
        toolbarGroups : [
	{ name: 'clipboard', groups: [ 'clipboard', ] },
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks' ] },
	{ name: 'links' },
	{ name: 'insert' },
	{ name: 'others' }
            ]
    });
    
   expected = CKEDITOR.replace( 'expected', {
        language: '<?php echo $language_code;?>',
        toolbarStartupExpanded : false,
        toolbarGroups : [
	{ name: 'clipboard', groups: [ 'clipboard', ] },
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks' ] },
	{ name: 'links' },
	{ name: 'insert' },
	{ name: 'others' }
            ]
    });
    
    //Add a step
    $('#cmdAddStep').click(function() {
         $("#frmCreateStep").attr("action", "<?php echo base_url();?>tests/<?php echo $test['id'] ?>/steps/add");
         $("#cmdSubmitForm").html('<?php echo lang('tests_steps_button_add');?>');
         $("#name").val('');
         action.setData('');
         expected.setData('');
         $('#frmEditStep').modal('show');
    });
    
    //Edit a step
    $('.step-edit').click(function() {
        var id = $(this).data('id');
         $("#frmCreateStep").attr("action", '<?php echo base_url();?>tests/<?php echo $test['id'] ?>/steps/' + id + '/edit');
         $("#cmdSubmitForm").html('<?php echo lang('tests_steps_button_update');?>');
         var nameValue = $('#steps tr[data-id="' + id + '"] td:eq(1)').text();
         var actionValue = $('#steps tr[data-id="' + id + '"] td:eq(2)').html();
         var expectedValue = $('#steps tr[data-id="' + id + '"] td:eq(3)').html();
         $("#name").val(nameValue);
         action.setData(actionValue);
         expected.setData(expectedValue);
         $('#frmEditStep').modal('show');
    });
    
    //Submit the Edit/Add a step form
    $('#cmdSubmitForm').click(function() {
        if ($("#name").val() == "") {
            bootbox.alert('<?php echo lang('tests_steps_js_msg_field_mandatory');?>');
        } else {
            $('#frmCreateStep').submit();
        }
    });
    
    //Show Test description
    $('#cmdShowDescription').click(function() {
        $('#frmTestDescription').modal('show');
    });

    //Duplicate a step
    $('.step-duplicate').click(function() {
        var id = $(this).data('id');
        document.location = '<?php echo base_url();?>tests/<?php echo $test['id'] ?>/steps/' + id + '/duplicate';
    });

    //Delete a step
    $('.confirm-delete').click(function() {
        var id = $(this).data('id');
        bootbox.confirm("<?php echo lang('global_msg_delete_confirmation');?>", function(result) {
            if (result) {
                document.location = '<?php echo base_url();?>tests/<?php echo $test['id'] ?>/steps/' + id + '/delete';
            }
        });
    });
});
</script>
