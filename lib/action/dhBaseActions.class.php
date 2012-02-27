<?php

class dhBaseActions extends sfActions
{
    
    protected function resolveRedirect($result)
    {
        $redirect = dhChangeRequestConfig::getActionRedirect($this->getActionName(), $result);
        
        if ($redirect == 'referer')
            $this->redirect($this->getRequest()->getReferer());

        if ($redirect)
            $this->redirect($redirect);
    }
    
    protected function setFlash($result)
    {
        $this->getUser()->setFlash(
                dhChangeRequestConfig::getActionFlashName($this->getActionName(), $result),
                $this->getContext()->getI18N()->__(dhChangeRequestConfig::getActionMessage($this->getActionName(), $result))
        );
    }

}