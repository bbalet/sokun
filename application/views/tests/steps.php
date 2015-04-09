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

        <h1><?php echo lang('tests_steps_title');?>&nbsp;<span class="text-muted"><?php echo $test['name'];?></span></h1>
        
        <?php echo $flash_partial_view;?>

  <div class="panel panel-default">
    <div class="panel-heading"><?php echo lang('tests_steps_panel_steps');?></div>
        <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="tests" width="100%">
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
            <tr>
                <td>&nbsp;
                    <div class="pull-right">
                        <?php if ($step['order'] != $max) { ?>
                        <a href="<?php echo base_url();?>tests/<?php echo $test['id'] ?>/step/<?php echo $step['id'] ?>/up" title="<?php echo lang('tests_index_thead_tip_up');?>"><span class="glyphicon glyphicon-arrow-up"></span></a>
                        <?php } ?>
                        &nbsp;
                        <?php if ($step['order'] != 0) { ?>
                        <a href="<?php echo base_url();?>tests/<?php echo $test['id'] ?>/step/<?php echo $step['id'] ?>/down" title="<?php echo lang('tests_index_thead_tip_down');?>"><span class="glyphicon glyphicon-arrow-down"></span></a>
                        <?php } ?>
                        &nbsp;
                        <a href="<?php echo base_url();?>tests/edit/<?php echo $test['id'] ?>" title="<?php echo lang('tests_index_thead_tip_edit');?>"><span class="glyphicon glyphicon-pencil"></span></a>
                        &nbsp;
                        <a href="#" class="confirm-delete" data-id="<?php echo $test['id'];?>" title="<?php echo lang('tests_index_thead_tip_delete');?>"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>
                </td>
                <td><?php echo $step['name'] ?></td>
                <td><?php echo $step['action'] ?></td>
                <td><?php echo $step['expected'] ?></td>
            </tr>
        <?php endforeach ?>
                </tbody>
        </table>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo lang('tests_steps_panel_edit');?></h3>
  </div>
  <div class="panel-body">
         <div class="form-group">
            <label for="name" class="col-sm-2 control-label"><?php echo lang('tests_create_field_name');?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo lang('tests_create_field_name');?>" autofocus required />
            </div>
        </div>
         <div class="form-group">
            <label for="action" class="col-sm-2 control-label"><?php echo lang('tests_create_field_description');?></label>
            <div class="col-sm-10">
                <textarea type="text" name="action" id="action"></textarea>
            </div>
        </div>
          <div class="form-group">
            <label for="expected" class="col-sm-2 control-label"><?php echo lang('tests_create_field_description');?></label>
            <div class="col-sm-10">
                <textarea type="text" name="expected" id="expected"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;<?php echo lang('tests_create_button_create');?></button>
                &nbsp;
                <a href="<?php echo base_url();?>tests" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;<?php echo lang('tests_create_button_cancel');?></a>
            </div>
        </div>

  </div>
</div>

        <div class="row-fluid">
            <div class="col-md-12">
                <a href="<?php echo base_url();?>tests/create" class="btn btn-primary"><span class="glyphicon glyphicon-plus glyphicon-white"></span>&nbsp;<?php echo lang('tests_index_button_create');?></a>
                &nbsp;
                <a href="<?php echo base_url();?>tests/export" class="btn btn-primary"><span class="glyphicon glyphicon-save-file glyphicon-white"></span>&nbsp;<?php echo lang('tests_index_button_export');?></a>
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
$(document).ready(function() {
    //Transform the HTML table
    $('#tests').dataTable({
            /*"aoColumnDefs": [
              { 'bSortable': false }, null, null, null
            ],*/
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
        
     editor = CKEDITOR.replace( 'action', {
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
    
   editor = CKEDITOR.replace( 'expected', {
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
        
        
    $('.confirm-delete').click(function() {
        var id = $(this).data('id');
        bootbox.confirm("<?php echo lang('global_msg_delete_confirmation');?>", function(result) {
            if (result) {
                document.location = '<?php echo base_url();?>tests/' + id + '/delete';
            }
        });
    });
});
</script>
