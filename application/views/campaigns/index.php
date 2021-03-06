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

$this->lang->load('datatable', $language);
?>
<div class="row-fluid">
    <div class="col-md-12">

        <h1><?php echo lang('campaigns_index_title');?></h1>

        <?php echo $flash_partial_view;?>

        <table cellpadding="0" cellspacing="0" border="0" class="display" id="campaigns" width="100%">
            <thead>
                <tr>
                    <th><?php echo lang('campaigns_index_thead_id');?></th>
                    <th><?php echo lang('campaigns_index_thead_name');?></th>
                    <th><?php echo lang('campaigns_index_thead_start_date');?></th>
                    <th><?php echo lang('campaigns_index_thead_end_date');?></th>
                    <th><?php echo lang('campaigns_index_thead_description');?></th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($campaigns as $campaign):
            if ($campaign['startdate'] != NULL) {
                $date = new DateTime($campaign['startdate']);
                $tmpStartDate = $date->getTimestamp();
                $startdate = $date->format(lang('global_date_format'));
            } else {
                $startdate = "";
                $tmpStartDate="";
            }
            if ($campaign['enddate'] != NULL) {
                $date = new DateTime($campaign['enddate']);
                $tmpEndDate = $date->getTimestamp();
                $enddate = $date->format(lang('global_date_format'));
            } else {
                $enddate = "";
                $tmpEndDate="";
            }?>
            <tr>
                <td data-order="<?php echo $campaign['id']; ?>">
                    <?php echo $campaign['id'] ?>
                    &nbsp;
                    <div class="pull-right">
                        <a href="<?php echo base_url();?>campaigns/<?php echo $campaign['id']; ?>/edit" title="<?php echo lang('campaigns_index_thead_tip_edit');?>"><span class="glyphicon glyphicon-pencil"></span></a>
                        &nbsp;
                        <a href="#" class="confirm-delete" data-id="<?php echo $campaign['id'];?>" title="<?php echo lang('campaigns_index_thead_tip_delete');?>"><span class="glyphicon glyphicon-trash"></span></a>
                        &nbsp;
                        <a href="<?php echo base_url();?>campaigns/<?php echo $campaign['id']; ?>/tests"><?php echo lang('campaigns_index_thead_link_tests');?></a>
                    </div>
                </td>
                <td><?php echo $campaign['name'] ?></td>
                <td data-order="<?php echo $tmpStartDate; ?>"><?php echo $startdate; ?></td>
                <td data-order="<?php echo $tmpEndDate; ?>"><?php echo $enddate; ?></td>
                <td><?php echo $campaign['description']; ?></td>
            </tr>
        <?php endforeach ?>
                </tbody>
        </table>
        <div class="row-fluid"> <div class="col-md-12">&nbsp;</div></div>
    
    </div>
</div>

<div class="row-fluid">
    <div class="col-md-12">
        <a href="<?php echo base_url();?>campaigns/create" class="btn btn-primary"><span class="glyphicon glyphicon-plus glyphicon-white"></span>&nbsp;<?php echo lang('campaigns_index_button_create');?></a>
        &nbsp;
        <a href="<?php echo base_url();?>campaigns/export" class="btn btn-primary"><span class="glyphicon glyphicon-save-file glyphicon-white"></span>&nbsp;<?php echo lang('campaigns_index_button_export');?></a>
     </div>
</div>

<div class="row"><div class="col-md-12">&nbsp;</div></div>

<link href="<?php echo base_url();?>assets/datatable/css/jquery.dataTables.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript">
$(function () {
    //Transform the HTML table
    $('#campaigns').dataTable({
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
                document.location = '<?php echo base_url();?>campaigns/' + id + '/delete';
            }
        });
    });
});
</script>
