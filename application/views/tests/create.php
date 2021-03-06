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

        <h1><?php echo lang('tests_create_title');?></h1>
        
        <?php echo validation_errors(); ?>

        <?php $attributes = array('id' => 'frmTestForm', 'class' => 'form-horizontal');
        echo form_open('tests/create', $attributes) ?>
        
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label"><?php echo lang('tests_create_field_name');?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo lang('tests_create_field_name');?>" autofocus required />
            </div>
        </div>
        
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label"><?php echo lang('tests_create_field_description');?></label>
            <div class="col-sm-10">
                <textarea type="text" name="description" id="description"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;<?php echo lang('tests_create_button_create');?></button>
                &nbsp;
                <a href="<?php echo base_url();?>tests" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;<?php echo lang('tests_create_button_cancel');?></a>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="row"><div class="col-md-12">&nbsp;</div></div>

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.min.css">
<script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url();?>assets/ckeditor/skins/moono/editor.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/ckeditor/skins/moono/dialog.css">
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">    
function validate_form() {
    result = false;
    var fieldname = "";
    if ($('#name').val() == "") fieldname = "<?php echo lang('tests_create_field_name');?>";
    if (fieldname == "") {
        return true;
    } else {
        bootbox.alert(<?php echo lang('global_validate_mandatory_js_msg');?>);
        return false;
    }
}

$(function () {

    
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
    
    $("#frmTestForm").submit(function(e) {
        if (validate_form()) {
            return true; 
        } else {
            e.preventDefault();
            return false; 
        }
    });
});
</script>

