<?php 
/*
 * This file is part of Sokun.
 *
 * Sokun is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Sokun is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Sokun.  If not, see <http://www.gnu.org/licenses/>.
 */
?>
<?php if($this->session->flashdata('msg')){ ?>
<div class="alert alert-info" role="alert" id="flashbox">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
  <?php echo $this->session->flashdata('msg'); ?>
</div>
 
<script type="text/javascript">
//Flash message
$(function () {
    $("#flashbox").alert();
});
</script>
<?php } ?>
