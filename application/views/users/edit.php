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

$CI =& get_instance();
$CI->load->library('polyglot');?>

<div class="row-fluid">
    <div class="col-md-12">
        
        <h1><?php echo lang('users_edit_title');?><?php echo $users_item['id']; ?></h1>

        <?php echo validation_errors(); ?>

        <?php 
        $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
        if (isset($_GET['source'])) {
            echo form_open('users/edit/' . $users_item['id'] .'?source=' . $_GET['source'], $attributes);
        } else {
            echo form_open('users/edit/' . $users_item['id'], $attributes);
        } ?>
            <input type="hidden" name="id" value="<?php echo $users_item['id']; ?>" required /><br />

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label"><?php echo lang('users_edit_field_firstname');?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $users_item['firstname']; ?>" required />
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label"><?php echo lang('users_edit_field_lastname');?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="lastname" value="<?php echo $users_item['lastname']; ?>" required />
                </div>
            </div>

            <div class="form-group">
                <label for="login" class="col-sm-2 control-label"><?php echo lang('users_edit_field_login');?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="login" name="login" value="<?php echo $users_item['login']; ?>" required />
                    <div class="alert alert-info" role="alert" id="lblLoginAlert">
                        <button type="button" class="close" onclick="$('#lblLoginAlert').hide();"><span aria-hidden="true">&times;</span></button>
                        <?php echo lang('users_create_flash_msg_error');?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label"><?php echo lang('users_edit_field_email');?></label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $users_item['email']; ?>" required />
                 </div>
            </div>

            <div class="form-group">
                <label for="role[]" class="col-sm-2 control-label"><?php echo lang('users_edit_field_role');?></label>
                <div class="col-sm-10">
                    <select class="form-control" name="role[]" multiple="multiple" size="2">
                    <?php foreach ($roles as $roles_item): ?>
                        <option value="<?php echo $roles_item['id'] ?>" <?php if ((((int)$roles_item['id']) & ((int) $users_item['role']))) echo "selected" ?>><?php echo $roles_item['name'] ?></option>
                    <?php endforeach ?>
                    </select>
                 </div>
            </div>

            <div class="form-group">
                <label for="language" class="col-sm-2 control-label"><?php echo lang('users_edit_field_language');?></label>
                <div class="col-sm-10">
                    <select class="form-control" name="language">
                         <?php 
                         $languages = $CI->polyglot->nativelanguages($this->config->item('languages'));
                         foreach ($languages as $code => $language): ?>
                        <option value="<?php echo $code; ?>" <?php if ($code == $users_item['language']) echo "selected" ?>><?php echo $language; ?></option>
                        <?php endforeach ?>
                    </select>
                 </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button id="send" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;<?php echo lang('users_edit_button_update');?></button>
                    &nbsp;
                    <?php if (isset($_GET['source'])) {?>
                        <a href="<?php echo base_url() . $_GET['source']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;<?php echo lang('users_edit_button_cancel');?></a>
                    <?php } else {?>
                        <a href="<?php echo base_url();?>users" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;<?php echo lang('users_edit_button_cancel');?></a>
                    <?php } ?>
                 </div>
            </div>
        </form>

    </div>
</div>

<div class="row"><div class="col-md-12">&nbsp;</div></div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>

<script type="text/javascript">

    function validate_form() {
        result = false;
        var fieldname = "";
        if ($('#firstname').val() == "") fieldname = "firstname";
        if ($('#lastname').val() == "") fieldname = "lastname";
        if ($('#login').val() == "") fieldname = "login";
        if ($('#email').val() == "") fieldname = "email";
        if ($('#password').val() == "") fieldname = "password";
        if (fieldname == "") {
            return true;
        } else {
            bootbox.alert(<?php echo lang('users_create_mandatory_js_msg');?>);
            return false;
        }
    }
    
    $(function () {
        $("#lblLoginAlert").hide();
        
        //On any change on firstname or lastname fields, automatically build the
        //login identifier with first character of firstname and lastname
        $("#firstname").change(function() {
            $("#login").val($("#firstname").val().charAt(0).toLowerCase() +
                $("#lastname").val().toLowerCase());            
        });
        $("#lastname").change(function() {
            $("#lastname").val($("#lastname").val().toUpperCase());
            $("#login").val($("#firstname").val().charAt(0).toLowerCase() +
                $("#lastname").val().toLowerCase());            
        });
        
        //Check if the username already exists
        $("#login").change(function() {
            if ($("#login").val() != '<?php echo $users_item['login']; ?>') {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>users/check/login",
                    data: { login: $("#login").val() }
                    })
                    .done(function( msg ) {
                        if (msg == "true") {
                            $("#lblLoginAlert").hide();
                        } else {
                            $("#lblLoginAlert").show();
                        }
                    });
                } else {
                    $("#lblLoginAlert").hide();
                }
        });
        
        $('#send').click(function() {
            if ($("#login").val() != '<?php echo $users_item['login']; ?>') {
                if (validate_form()) {
                    $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>users/check/login",
                    data: { login: $("#login").val() }
                    })
                    .done(function( msg ) {
                        if (msg == "true") {
                            $("#target").submit();
                        } else {
                            bootbox.alert("<?php echo lang('users_create_login_check');?>");
                        }
                    });
                }
             } else {
                $("#target").submit();
             }
        });
    });
</script>
