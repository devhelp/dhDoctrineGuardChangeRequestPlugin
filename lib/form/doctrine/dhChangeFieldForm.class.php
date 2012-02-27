<?php

abstract class dhChangeFieldForm extends PlugindhChangeRequestForm
{

    abstract protected function getFieldName();

    public function configure()
    {
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
    }

    protected function doUpdateObject($values)
    {
        parent::doUpdateObject($values);

        $this->getObject()->updateRequest(sfConfig::get('app_dh_change_request_expires_in'));
    }

}
