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
$this->lang->load('global', $language);?>

<div class="row-fluid">
    <div class="col-md-12">

        <h1><?php echo lang('campaigns_tests_title');?>&nbsp;<span class="text-muted">(<?php echo $campaign_name;?>)</span></h1>

        <?php echo $flash_partial_view;?>
        
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="campaigntests" width="100%">
            <thead>
                <tr>
                    <th><?php echo lang('campaigns_tests_thead_id');?></th>
                    <th><?php echo lang('campaigns_tests_thead_name');?></th>
                    <th><?php echo lang('campaigns_tests_thead_status');?></th>
                    <th><?php echo lang('campaigns_tests_thead_description');?></th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($tests as $test): ?>
            <tr>
                <td data-order="<?php echo $test['assoc_id']; ?>">
                    <?php echo $test['assoc_id'] ?>
                    &nbsp;
                    <div class="pull-right">
                        <a href="<?php echo base_url();?>tests/<?php echo $test['id'] ?>/edit" title="<?php echo lang('campaigns_tests_thead_tip_edit');?>"><span class="glyphicon glyphicon-pencil"></span></a>
                        &nbsp;
                        <a href="<?php echo base_url();?>campaigns/<?php echo $campaign_id; ?>/tests/remove/<?php echo $test['assoc_id'] ?>" title="<?php echo lang('campaigns_tests_thead_tip_remove');?>"><span class="glyphicon glyphicon-trash"></span></a>
                        &nbsp;
                        <a href="<?php echo base_url();?>campaigns/<?php echo $campaign_id; ?>/tests/<?php echo $test['assoc_id'] ?>/execute" title="<?php echo lang('campaigns_tests_thead_tip_execute');?>"><span class="glyphicon glyphicon-play"></span></a>
                        &nbsp;
                        <a href="<?php echo base_url();?>campaigns/<?php echo $campaign_id; ?>/tests/<?php echo $test['assoc_id'] ?>/executions" title="<?php echo lang('campaigns_tests_thead_tip_executions');?>"><span class="glyphicon glyphicon-list-alt"></span></a>
                    </div>
                </td>
                <td>(<?php echo $test['id'] ?>) <?php echo $test['name'] ?></td>
                <td><?php echo lang($test['status']); ?></td>
                <td><?php echo $test['description']; ?></td>
            </tr>
        <?php endforeach ?>
                </tbody>
        </table>
        <div class="row-fluid"> <div class="col-md-12">&nbsp;</div></div>
    </div>
</div>

<div class="row-fluid">
    <div class="col-md-12">
        <a href="<?php echo base_url();?>campaigns" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left glyphicon-white"></span>&nbsp;<?php echo lang('campaigns_tests_button_back');?></a>
        &nbsp;
        <button id="cmdSelectTest" class="btn btn-primary"><span class="glyphicon glyphicon-plus glyphicon-white"></span>&nbsp;<?php echo lang('campaigns_tests_button_add_test');?></button>
        &nbsp;
        <a href="<?php echo base_url();?>campaigns/<?php echo $campaign_id; ?>/tests/export" class="btn btn-primary"><span class="glyphicon glyphicon-save-file glyphicon-white"></span>&nbsp;<?php echo lang('campaigns_tests_button_export');?></a>
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

<!-- Select test case -->
<div class="modal fade" id="frmTestSelect" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('campaigns_tests_popup_add_test_title');?></h4>
      </div>
      <div id="frmTestSelectBody" class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('campaigns_tests_popup_add_test_button_cancel');?></button>
        <button type="button" id="cmdAddTest" class="btn btn-primary"><?php echo lang('campaigns_tests_popup_add_test_button_ok');?></button>
      </div>
    </div>
  </div>
</div>

<div class="row"><div class="col-md-12">&nbsp;</div></div>

<link href="<?php echo base_url();?>assets/datatable/css/jquery.dataTables.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(function () {
    //Transform the HTML table
    $('#campaigntests').dataTable({
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
        
        $('#cmdSelectTest').click(function() {
            $('#frmModalAjaxWait').modal('show');
            $("#frmTestSelectBody").load('<?php echo base_url(); ?>tests/select', function(){
                $('#frmModalAjaxWait').modal('hide');
                $('#frmTestSelect').modal('show'); 
            });
        });
        $('#frmTestSelect').on('hidden', function() {
            $(this).removeData('modal');
        });
        
        $('#cmdAddTest').click(function() {
            var test_id = $('#tests .row_selected td:eq(0)').text();
            document.location = '<?php echo base_url();?>campaigns/<?php echo $campaign_id; ?>/tests/add/' + test_id;
        });
});
</script>
