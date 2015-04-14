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
$this->lang->load('global', $language);?>

<div class="row-fluid">
    <div class="col-md-12">
        
<h1><?php echo lang('users_index_title');?></h1>

<?php echo $flash_partial_view;?>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="users" width="100%">
    <thead>
        <tr>
            <th><?php echo lang('users_index_thead_id');?></th>
            <th><?php echo lang('users_index_thead_firstname');?></th>
            <th><?php echo lang('users_index_thead_lastname');?></th>
            <th><?php echo lang('users_index_thead_login');?></th>
            <th><?php echo lang('users_index_thead_email');?></th>
            <th><?php echo lang('users_index_thead_role');?></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($users as $users_item): ?>
    <tr>
        <td data-order="<?php echo $users_item['id']; ?>">
            <?php echo $users_item['id'] ?>
            <div class="pull-right">
                <a href="<?php echo base_url();?>users/edit/<?php echo $users_item['id'] ?>" title="<?php echo lang('users_index_thead_tip_edit');?>"><span class="glyphicon glyphicon-pencil"></span></a>
                &nbsp;
                <a href="#" class="confirm-delete" data-id="<?php echo $users_item['id'];?>" title="<?php echo lang('users_index_thead_tip_delete');?>"><span class="glyphicon glyphicon-trash"></span></a>
                &nbsp;
                <a href="#" class="reset-pwd" data-id="<?php echo $users_item['id'];?>" title="<?php echo lang('users_index_thead_tip_reset');?>"><span class="glyphicon glyphicon-lock"></span></a>
            </div>
        </td>
        <td><?php echo $users_item['firstname'] ?></td>
        <td><?php echo $users_item['lastname'] ?></td>
        <td><?php echo $users_item['login'] ?></td>
        <td><a href="mailto:<?php echo $users_item['email']; ?>"><?php echo $users_item['email']; ?></a></td>
        <td><?php echo $users_item['role_name'] ?></td>
    </tr>
<?php endforeach ?>
	</tbody>
</table>
	</div>
</div>

<div class="row-fluid">
    <div class="col-md-12">&nbsp;</div>
</div>

<div class="row-fluid">
    <div class="col-md-12">
      <a href="<?php echo base_url();?>users/export" class="btn btn-primary"><span class="glyphicon glyphicon-file glyphicon-white"></span>&nbsp;<?php echo lang('users_index_button_export');?></a>
        &nbsp;
      <a href="<?php echo base_url();?>users/create" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign glyphicon-white"></span>&nbsp;<?php echo lang('users_index_button_create_user');?></a>
    </div>
</div>

<div id="frmResetPwd" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h3><?php echo lang('users_index_popup_password_title');?></h3>
            </div>
            <div id="frmResetPwdBody" class="modal-body"></div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><?php echo lang('users_index_popup_password_button_cancel');?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal hide" id="frmModalAjaxWait" data-backdrop="static" data-keyboard="false">
        <div class="modal-header">
            <h1><?php echo lang('global_msg_wait');?></h1>
        </div>
        <div class="modal-body">
            <img src="<?php echo base_url();?>assets/images/loading.gif"  align="middle">
        </div>
 </div>

<link href="<?php echo base_url();?>assets/datatable/css/jquery.dataTables.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#users').dataTable({
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
    
    bootbox.setDefaults({locale: "<?php echo $language_code;?>"});
    
    $('.confirm-delete').click(function() {
        var id = $(this).data('id');
        bootbox.confirm("<?php echo lang('global_msg_delete_confirmation');?>", function(result) {
            if (result) {
                document.location = '<?php echo base_url();?>users/delete/' + id;
            }
        });
    });
    
    $('.reset-pwd').click(function() {
        var id = $(this).data('id');
        $('#frmModalAjaxWait').modal('show');
        $("#frmResetPwdBody").load('<?php echo base_url();?>users/reset/' + id, function(){
            $('#frmModalAjaxWait').modal('hide');
            $('#frmResetPwd').modal('show'); 
        });
    });
    $('#frmResetPwd').on('hidden', function() {
        $(this).removeData('modal');
    });
});
</script>
