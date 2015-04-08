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

    <div class="row vertical-center">
        <div class="col-md-4">&nbsp;</div>
        <div class="col-md-4 form-box">

<h2><?php echo lang('connection_login_title');?></h2>

<?php if($this->session->flashdata('msg')){ ?>
<div class="alert fade in" id="flashbox">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?php echo $this->session->flashdata('msg'); ?>
</div>
<script type="text/javascript">
//Flash message
$(document).ready(function() {
    $(".alert").alert();
});
</script>
<?php } ?>

<?php echo validation_errors(); ?>

<?php
$CI =& get_instance();
$attributes = array('id' => 'loginFrom', 'class' => 'form-horizontal');
echo form_open('connection/login', $attributes);
$languages = $CI->polyglot->nativelanguages($this->config->item('languages'));?>

    <input type="hidden" name="last_page" value="connection/login" />
    <?php if (count($languages) == 1) { ?>
    <input type="hidden" name="language" value="<?php echo $language_code; ?>" />
    <?php } else { ?>
    <label for="language"><?php echo lang('connection_login_field_language');?></label>
    <select class="form-control" name="language" id="language" onchange="Javascript:change_language();">
        <?php foreach ($languages as $lang_code => $lang_name) { ?>
        <option value="<?php echo $lang_code; ?>" <?php if ($language_code == $lang_code) echo 'selected'; ?>><?php echo $lang_name; ?></option>
        <?php }?>
    </select><br />
    <?php } ?>
    <label for="login"><?php echo lang('connection_login_field_login');?></label>
    <input type="text" class="form-control" name="login" id="login" value="<?php echo set_value('login'); ?>" autofocus required /><br />
    <label for="password"><?php echo lang('connection_login_field_password');?></label>
    <input type="password" class="form-control" name="password" id="password" /><br />
    <button id="send" class="btn btn-primary"><span class="glyphicon  glyphicon-user glyphicon-white"></span>&nbsp;<?php echo lang('connection_login_button_login');?></button><br />
    <br />
    <button id="cmdForgetPassword" class="btn btn-info"><span class="glyphicon glyphicon-envelope glyphicon-white"></span>&nbsp;<?php echo lang('connection_login_button_forget_password');?></button>
</form>
    
        </div>
        <div class="col-md-4">&nbsp;</div>
    </div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.pers-brow.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>

<script type="text/javascript">
    //Refresh page language
    function change_language() {
        $.cookie('language', $('#language option:selected').val(), { expires: 90, path: '/'});
        $('#loginFrom').prop('action', '<?php echo base_url();?>connection/language');
        $('#loginFrom').submit();
    }
    
    $(function () {
        //Memorize the last selected language with a cookie
        if($.cookie('language') != null) {
            var IsLangAvailable = 0 != $('#language option[value=' + $.cookie('language') + ']').length;
            if ($.cookie('language') != "<?php echo $language_code; ?>") {
                //Test if the former selected language is into the list of available languages
                if (IsLangAvailable) {
                    $('#language option[value="' + $.cookie('language') + '"]').attr('selected', 'selected');
                    $('#loginFrom').prop('action', '<?php echo base_url();?>connection/language');
                    $('#loginFrom').submit();
                }
            }
        }
        
        //If the user has forgotten his password, send an e-mail
        $('#cmdForgetPassword').click(function() {
            if ($('#login').val() == "") {
                bootbox.alert("<?php echo lang('connection_login_msg_empty_login');?>");
            } else {
                $.ajax({
                   type: "POST",
                   url: "<?php echo base_url(); ?>connection/forgetpassword",
                   data: { login: $('#login').val() }
                 })
                 .done(function(msg) {
                   switch(msg) {
                       case "OK":
                           bootbox.alert("<?php echo lang('connection_login_msg_password_sent');?>");
                           break;
                       case "UNKNOWN":
                           bootbox.alert("<?php echo lang('connection_login_flash_bad_credentials');?>");
                           break;
                   }
                 });
            }
        });
        
        //Validate the form if the user press enter key in password field
        $('#password').keypress(function(e){
            if(e.keyCode==13)
            $('#loginFrom').submit();
        });
    });
</script>
