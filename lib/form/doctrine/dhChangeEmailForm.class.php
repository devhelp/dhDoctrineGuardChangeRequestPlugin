<?php

class dhChangeEmailForm extends dhChangeFieldForm
{

    protected function getFieldName()
    {
        return dhChangeRequest::FIELD_NAME_EMAIL;
    }

    public function configure()
    {
        parent::configure();
        
        $this->widgetSchema[dhChangeRequest::FIELD_NAME_EMAIL] = new sfWidgetFormInputText();
        $this->validatorSchema[dhChangeRequest::FIELD_NAME_EMAIL] = new sfValidatorString(array('max_length' => 255));

        $this->useFields(array(dhChangeRequest::FIELD_NAME_EMAIL));
        
        $this->mergePostValidator(new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => 'email_address')));
    }

}
