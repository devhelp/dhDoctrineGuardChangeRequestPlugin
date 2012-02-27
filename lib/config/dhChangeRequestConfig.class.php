<?php


class dhChangeRequestConfig
{
    static public function getActionConfig($action_name)
    {
        return sfConfig::get('app_dh_change_request_'.$action_name);
    }
    
    static public function getMailConfig($config_key)
    {
         $config = sfConfig::get('app_dh_change_request_mail', array());
         
         return $config[$config_key];
    }
    
    static public function getFormConfig($form_class)
    {
        return sfConfig::get('app_dh_change_request_'.$form_class);
    }
    
    static public function getActionMessage($action_name, $result)
    {
        $config = self::getActionConfig($action_name);
        
        return $config['message'][$result];
    }
    
    static public function getActionFlashName($action_name, $result)
    {
        $config = self::getActionConfig($action_name);
        
        return $config['flash_name'][$result];
    }
    
    static public function getActionRedirect($action_name, $result)
    {
        $config = self::getActionConfig($action_name);
        
        return $config['redirect'][$result];
    }
    
    static public function isFormAjax($form_class)
    {
        $config = self::getFormConfig($form_class);
        
        return $config['ajax'];
    }
}