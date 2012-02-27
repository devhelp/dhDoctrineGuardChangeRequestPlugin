<?php


class dhBaseConfirmChangeActions extends dhBaseActions
{
    const RESULT_SUCCESS = 'success';
    const RESULT_ERROR = 'error';
    const RESULT_TOKEN_EXPIRED = 'token_expired';
    
    public function executeConfirmEmailChange(sfWebRequest $request)
    {
        return $this->changeField($request->getParameter('token'), dhChangeRequest::FIELD_NAME_EMAIL);
    }
    
    public function executeConfirmPasswordChange(sfWebRequest $request)
    {
        return $this->changeField($request->getParameter('token'), dhChangeRequest::FIELD_NAME_PASSWORD);
    }
    
    protected function changeField($token, $field_name)
    {
        $change_request = dhChangeRequestTable::getInstance()->findOneByTokenAndFieldName($token, $field_name);
        
        if(!$change_request)
        {
            $result = self::RESULT_ERROR;
        }
        else
        {
            if($change_request->isRequestValid()) $result = self::RESULT_TOKEN_EXPIRED;
            else
            {
                $change_request->confirm();
                $result = self::RESULT_SUCCESS;
            }            
        }
        
        return $this->processResult($result);
    }
    
    protected function processResult($result)
    {
        $this->resolveRedirect($result);
        
        //in case of no redirect
        $this->message = dhChangeRequestConfig::getActionMessage($this->getActionName(), $result);
        $this->setTemplate('confirmChange');
    }
}
