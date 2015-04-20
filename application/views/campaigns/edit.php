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

        <h1><?php echo lang('campaigns_edit_title');?></h1>
        
        <?php echo validation_errors(); ?>

        <?php $attributes = array('id' => 'frmCampaignForm', 'class' => 'form-horizontal');
        echo form_open('campaigns/' . $campaign['id'] . '/edit', $attributes) ?>
        <input type="hidden" name="startdate" id="startdate" />
        <input type="hidden" name="enddate" id="enddate" />
        
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label"><?php echo lang('campaigns_edit_field_name');?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo lang('campaigns_edit_field_name');?>" value="<?php echo $campaign['name'] ?>" autofocus required />
            </div>
        </div>

        <div class="form-group">
            <label for="startdate" class="col-sm-2 control-label"><?php echo lang('campaigns_edit_field_start_date');?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="viz_startdate" id="viz_startdate" placeholder="<?php echo lang('campaigns_edit_field_start_date');?>" value="<?php $date = new DateTime($campaign['startdate']); echo $date->format(lang('global_date_format'));?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="viz_enddate" class="col-sm-2 control-label"><?php echo lang('campaigns_edit_field_end_date');?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="viz_enddate" id="viz_enddate" placeholder="<?php echo lang('campaigns_edit_field_end_date');?>" value="<?php $date = new DateTime($campaign['startdate']); echo $date->format(lang('global_date_format'));?>" />
            </div>
        </div>
        
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label"><?php echo lang('campaigns_edit_field_description');?></label>
            <div class="col-sm-10">
                <textarea type="text" name="description" id="description"><?php echo $campaign['description'] ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;<?php echo lang('campaigns_edit_button_update');?></button>
                &nbsp;
                <a href="<?php echo base_url();?>campaigns" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;<?php echo lang('campaigns_edit_button_cancel');?></a>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="row"><div class="col-md-12">&nbsp;</div></div>

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.min.css">
<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
<?php //Prevent HTTP-404 when localization isn't needed
if ($language_code != 'en') { ?>
<script src="<?php echo base_url();?>assets/js/i18n/jquery.ui.datepicker-<?php echo $language_code;?>.js"></script>
<?php } ?>
<script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url();?>assets/ckeditor/skins/moono/editor.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/ckeditor/skins/moono/dialog.css">
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">    
function validate_form() {
    result = false;
    var fieldname = "";
    if ($('#name').val() == "") fieldname = "<?php echo lang('campaigns_edit_field_name');?>";
    if (fieldname == "") {
        return true;
    } else {
        bootbox.alert(<?php echo lang('global_validate_mandatory_js_msg');?>);
        return false;
    }
}

$(function () {
    $("#viz_startdate").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: "yy-mm-dd",
        altField: "#startdate",
        numberOfMonths: 1,
              onClose: function( selectedDate ) {
                $( "#viz_enddate" ).datepicker( "option", "minDate", selectedDate );
              }
    }, $.datepicker.regional['<?php echo $language_code;?>']);
    
    $("#viz_enddate").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: "yy-mm-dd",
        altField: "#enddate",
        numberOfMonths: 1,
              onClose: function( selectedDate ) {
                $( "#viz_startdate" ).datepicker( "option", "maxDate", selectedDate );
              }
    }, $.datepicker.regional['<?php echo $language_code;?>']);
    
    editor = CKEDITOR.replace( 'description', {
        language: '<?php echo $language_code;?>',
        toolbarGroups : [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
	{ name: 'forms' },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	{ name: 'links' },
	{ name: 'insert' },
	'/',
	{ name: 'styles' },
	{ name: 'colors' },
	{ name: 'tools' },
	{ name: 'others' }
            ]
    });
    
    $("#frmCampaignForm").submit(function(e) {
        if (validate_form()) {
            return true; 
        } else {
            e.preventDefault();
            return false; 
        }
    });
});
</script>
