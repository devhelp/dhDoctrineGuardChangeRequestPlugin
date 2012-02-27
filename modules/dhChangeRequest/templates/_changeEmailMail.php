Someone made a request to change your email address.

If it was you click the link below to confirm the change:

<?php echo url_for('dh_confirm_email_change', array('token' => $change_request->getToken()), true); ?>