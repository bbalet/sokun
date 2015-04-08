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

<?php /*
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
                    <a href="<?php echo base_url();?>users/<?php echo $users_item['id'] ?>" title="<?php echo lang('users_index_thead_tip_view');?>"><?php echo $users_item['id'] ?></a>
                    &nbsp;
                    <div class="pull-right">
                        <a href="<?php echo base_url();?>users/<?php echo $users_item['id'] ?>" title="<?php echo lang('users_index_thead_tip_view');?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                        &nbsp;
                        <a href="<?php echo base_url();?>users/edit/<?php echo $users_item['id'] ?>" title="<?php echo lang('users_index_thead_tip_edit');?>"><span class="glyphicon glyphicon-pencil"></span></a>
                        &nbsp;
                        <a href="#" class="confirm-delete" data-id="<?php echo $users_item['id'];?>" title="<?php echo lang('users_index_thead_tip_delete');?>"><span class="glyphicon glyphicon-trash"></span></a>
                        &nbsp;
                        <a href="<?php echo base_url();?>users/reset/<?php echo $users_item['id'] ?>" title="<?php echo lang('users_index_thead_tip_reset');?>" data-target="#frmResetPwd" data-toggle="modal"><span class="glyphicon glyphicon-lock"></span></a>
                    </div>
                </td>
                <td><?php echo $users_item['firstname'] ?></td>
                <td><?php echo $users_item['lastname'] ?></td>
                <td><?php echo $users_item['login'] ?></td>
                <td><a href="mailto:<?php echo $users_item['email']; ?>"><?php echo $users_item['email']; ?></a></td>
                <td><?php echo $users_item['role'] ?></td>
            </tr>
        <?php endforeach ?>
                </tbody>
        </table>
*/?>
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

<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table
    $('#tests').dataTable({
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
});
</script>
