<?php

class dhChangePasswordForm extends dhChangeFieldForm
{
    
    protected function getFieldName()
    {
        return dhChangeRequest::FIELD_NAME_PASSWORD;
    }
    
    public function configure()
    {
        parent::configure();
        
        $this->widgetSchema[dhChangeRequest::FIELD_NAME_PASSWORD] = new sfWidgetFormInputPassword();
        $this->validatorSchema[dhChangeRequest::FIELD_NAME_PASSWORD] = new sfValidatorString(array('max_length' => 128, 'required' => true));
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password_again'] = clone $this->validatorSchema[dhChangeRequest::FIELD_NAME_PASSWORD];
        $this->validatorSchema['password_again']->setOption('required', true);

        $this->getWidgetSchema()->setLabel(dhChangeRequest::FIELD_NAME_PASSWORD, 'Password');
        
        $this->mergePostValidator(new sfValidatorSchemaCompare(dhChangeRequest::FIELD_NAME_PASSWORD, sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));
        
        $this->useFields(array(dhChangeRequest::FIELD_NAME_PASSWORD, 'password_again'));
    }
    
}
