<form id="dh-change-password-form" action="<?php echo url_for('@dh_change_password_update'); ?>" method="post">

    <div class="dh-form-fields-container">
        
        <?php include_partial('dhChangeRequest/formFields', array('form' => $form)); ?>
        
    </div>

    <input type="submit" value="Change" />
    
</form>