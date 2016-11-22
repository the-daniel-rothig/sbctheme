<?php
/**
 * The template part for displaying the SBC complaints scheme form
 *
 * @package SBC
 * @subpackage SBCTheme
 * @since SBCTheme 1.0
 */
?>
<form action="" method="post">
	<label class="form-label" for="name">Name</label>
	<input class="form-control" id="name" type="text" name="sbcform_name" value="<?php echo esc_attr(isset($_POST['sbcform_name']) ? $_POST['sbcform_name'] : '');?>">
	<label class="form-label" for="Email">Email</label>
	<input class="form-control" id="email" type="text" name="sbcform_email" value="<?php echo esc_attr(isset($_POST['sbcform_email']) ? $_POST['sbcform_email'] : '');?>">
	<label class="form-label" for="subject">Subject</label>
	<input class="form-control" id="subject" type="text" name="sbcform_subject" value="<?php echo esc_attr(isset($_POST['sbcform_subject']) ? $_POST['sbcform_subject'] : '');?>">
	<label class="form-label" for="message">Message</label>
	<textarea class="form-control" id="message" type="text" name="sbcform_message"><?php echo esc_html(isset($_POST['sbcform_message']) ? $_POST['sbcform_message'] : '');?></textarea>	

	<input type="submit" class="button" value="Submit">
</form>