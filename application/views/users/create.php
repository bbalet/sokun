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

<h1><?php echo lang('users_create_title');?></h1>

<?php echo validation_errors(); ?>

<?php
$attributes = array('id' => 'target', 'class' => 'form-horizontal');
echo form_open('users/create', $attributes); ?>
    
       <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label"><?php echo lang('users_create_field_firstname');?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="firstname" id="firstname" required />
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label"><?php echo lang('users_create_field_lastname');?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="lastname" id="lastname" required />
            </div>
        </div>

        <div class="form-group">
            <label for="login" class="col-sm-2 control-label"><?php echo lang('users_create_field_login');?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="login" id="login" required />
                <div class="alert alert-info" role="alert" id="lblLoginAlert">
                    <button type="button" class="close" onclick="$('#lblLoginAlert').hide();">&times;</button>
                    <?php echo lang('users_create_flash_msg_error');?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="role[]" class="col-sm-2 control-label"><?php echo lang('users_create_field_role');?></label>
            <div class="col-sm-10">
                <select class="form-control" name="role[]" multiple="multiple" size="2" required>
                <?php foreach ($roles as $roles_item): ?>
                    <option value="<?php echo $roles_item['id'] ?>" <?php if ($roles_item['id'] == 2) echo "selected" ?>><?php echo $roles_item['name'] ?></option>
                <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label"><?php echo lang('users_create_field_email');?></label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required />
            </div>
        </div>

        <div class="form-group">
            <label for="language" class="col-sm-2 control-label"><?php echo lang('users_create_field_language');?></label>
            <div class="col-sm-10">
                <select class="form-control" name="language">
                     <?php 
                     $languages = $CI->polyglot->nativelanguages($this->config->item('languages'));
                     $default_lang = $CI->polyglot->language2code($this->config->item('language'));
                     foreach ($languages as $code => $language): ?>
                    <option value="<?php echo $code; ?>" <?php if ($code == $default_lang) echo "selected" ?>><?php echo $language; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label"><?php echo lang('users_create_field_password');?></label>
            <div class="col-sm-8">
                    <input class="form-control" type="password" name="password" id="password" required />
            </div>
            <div class="col-sm-2">
                    <a class="btn btn-default" id="cmdGeneratePassword">
                        <span class="glyphicon glyphicon-refresh"></span>&nbsp;<?php echo lang('users_create_button_generate_password');?>
                    </a>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="send" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;<?php echo lang('users_create_button_create');?></button>
                &nbsp;
                <a href="<?php echo base_url(); ?>users" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;<?php echo lang('users_create_button_cancel');?></a>
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
    
/**
 * Generate a password of the specified length
 * @param int len   length of password to be generated
 * @returns string  generated password
 */
function password_generator(len) {
    var length = (len)?(len):(10);
    var string = "abcdefghijklnopqrstuvwxyz";
    var numeric = '0123456789';
    var punctuation = '!@#$%;:?,./-=';
    var password = "";
    var character = "";
    while(password.length < length) {
        entity1 = Math.ceil(string.length * Math.random() * Math.random());
        entity2 = Math.ceil(numeric.length * Math.random() * Math.random());
        entity3 = Math.ceil(punctuation.length * Math.random() * Math.random());
        hold = string.charAt(entity1);
        hold = (entity1 % 2 == 0)?(hold.toUpperCase()):(hold);
        character += hold;
        character += numeric.charAt( entity2 );
        character += punctuation.charAt( entity3 );
        password = character;
    }
    return password;
}
    
    $(function () {
        $("#lblLoginAlert").hide();
        
        $("#cmdGeneratePassword").click(function() {
            $("#password").val(password_generator(<?php echo $this->config->item('password_length');?>));
        });
        
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
        });
        
        $('#send').click(function() {
            if (validate_form() == false) {
                //Error of validation
            } else {
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
        });
    });
</script>
