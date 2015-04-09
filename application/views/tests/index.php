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

        <h1><?php echo lang('tests_index_title');?></h1>
        
        <?php echo $flash_partial_view;?>

        <table cellpadding="0" cellspacing="0" border="0" class="display" id="tests" width="100%">
            <thead>
                <tr>
                    <th><?php echo lang('tests_index_thead_id');?></th>
                    <th><?php echo lang('tests_index_thead_name');?></th>
                    <th><?php echo lang('tests_index_thead_creator');?></th>
                    <th><?php echo lang('tests_index_thead_description');?></th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($tests as $test): ?>
            <tr>
                <td data-order="<?php echo $test['id']; ?>">
                    <?php echo $test['id'] ?>
                    <div class="pull-right">
                        <a href="<?php echo base_url();?>tests/edit/<?php echo $test['id'] ?>" title="<?php echo lang('tests_index_thead_tip_edit');?>"><span class="glyphicon glyphicon-pencil"></span></a>
                        &nbsp;
                        <a href="#" class="confirm-delete" data-id="<?php echo $test['id'];?>" title="<?php echo lang('tests_index_thead_tip_delete');?>"><span class="glyphicon glyphicon-trash"></span></a>
                        &nbsp;
                        <a href="<?php echo base_url();?>tests/<?php echo $test['id']; ?>/steps"><?php echo lang('tests_index_thead_link_steps');?></a>
                    </div>
                </td>
                <td><?php echo $test['name'] ?></td>
                <td><?php echo $test['creator_name'] ?></td>
                <td><?php echo $test['description'] ?></td>
            </tr>
        <?php endforeach ?>
                </tbody>
        </table>

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

<link href="<?php echo base_url();?>assets/datatable/css/jquery.dataTables.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
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
