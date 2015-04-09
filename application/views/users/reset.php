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

CI_Controller::get_instance()->load->helper('language');
$this->lang->load('users', $language);?>
<?php
$attributes = array('id' => 'target', 'class' => 'form-inline');
echo form_open('users/reset/' . $target_user_id, $attributes); ?>

    <div class="form-group">
        <label for="password"><?php echo lang('users_reset_field_password');?></label>
        <input type="password" class="form-control" name="password" id="password" required /><br />
    </div>
    <button id="send" class="btn btn-warning"><?php echo lang('users_reset_button_reset');?></button>
</form>
<script type="text/javascript">
    $(function () {
        //Validate the form if the user press enter key in password field
        $('#password').keypress(function(e){
            if(e.keyCode==13)
            $('#send').click();
        });
    });
</script>
