<?php


class dhBaseChangeRequestActions extends dhBaseActions
{
    const RESULT_SUCCESS = 'success';
    const RESULT_ERROR = 'error';
    
    public function executeChangeEmail(sfWebRequest $request)
    {
        $this->processEditAction('dhChangeEmailForm', dhChangeRequest::FIELD_NAME_EMAIL);
    }
    
    public function executeUpdateEmail(sfWebRequest $request)
    {
        return $this->processUpdateAction('dhChangeEmailForm', dhChangeRequest::FIELD_NAME_EMAIL, 'changeEmail');
    }
        
    public function executeChangePassword(sfWebRequest $request)
    {
        $this->processEditAction('dhChangePasswordForm', dhChangeRequest::FIELD_NAME_PASSWORD);
    }
    
    public function executeUpdatePassword(sfWebRequest $request)
    {
        return $this->processUpdateAction('dhChangePasswordForm', dhChangeRequest::FIELD_NAME_PASSWORD, 'changePassword');
    }
    
    protected function processEditAction($form_class, $field_name)
    {
        $form = new $form_class($this->getChangeRequest($field_name));
        
        $this->resolveIsAjax($form);
        
        $this->form = $form;
    }
    
    protected function resolveIsAjax($form)
    {
        if($form instanceof dhChangeEmailForm && dhChangeRequestConfig::isFormAjax('dhChangeEmailForm'))
        {
            $this->getResponse()->addJavascript('/dhDoctrineGuardChangeRequestPlugin/js/dh.change.email.form.js', 'last');
        }
        else if($form instanceof dhChangePasswordForm && dhChangeRequestConfig::isFormAjax('dhChangePasswordForm'))
        {
            $this->getResponse()->addJavascript('/dhDoctrineGuardChangeRequestPlugin/js/dh.change.password.form.js', 'last');
        }
    }
    
    protected function processUpdateAction($form_class, $field_name, $template)
    {
        $form = new $form_class($this->getChangeRequest($field_name));
        
        $result = $this->processForm($form);
        $this->setFlash($result);
        
        if($this->getRequest()->isXmlHttpRequest())
        {
            return $this->renderPartial($this->getModuleName().'/formFields', array('form' => $form));
        }
        else
        {
            $this->resolveRedirect($result);
            $this->form = $form;
            $this->setTemplate($template);
        }
        
        return null;
    }
    
    protected function processForm($form)
    {
        if($form->bindAndValidate($this->getRequest()))
        {
            $change_request = $form->save();
            
            $this->sendVerificationMail($change_request);
            
            return self::RESULT_SUCCESS;
        }
        
        return self::RESULT_ERROR;
    }
    
    protected function sendVerificationMail(dhChangeRequest $change_request)
    {
        if($change_request->getFieldName() === dhChangeRequest::FIELD_NAME_EMAIL)
        {
            $this->sendMail($change_request, $change_request->getNewValue(), 'changeEmail');
        }
        else if($change_request->getFieldName() === dhChangeRequest::FIELD_NAME_PASSWORD)
        {
            $this->sendMail($change_request, $change_request->getUser()->getEmailAddress(), 'changePassword');
        }
    }

    protected function sendMail(dhChangeRequest $change_request, $to, $config)
    {
        $config = dhChangeRequestConfig::getMailConfig($config);
        
        $message = $this->getMailer()->compose()
                ->setFrom($config['from'])
                ->setTo($to)
                ->setSubject($config['subject'])
                ->setBody($this->getPartial($config['partial'], array('change_request' => $change_request)), $config['content_type']);
        
        return $this->getMailer()->send($message);
    }

    /**
     *
     * @param type $field_name
     * @return dhChangeRequest
     */
    protected function getChangeRequest($field_name)
    {
        return dhChangeRequest::getChangeRequest($this->getUser()->getGuardUser(), $field_name);
    }
}
