<?php

/**
 * PlugindhChangeRequest form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PlugindhChangeRequestForm extends BasedhChangeRequestForm
{

    public function bindAndValidate(sfWebRequest $request)
    {
        $this->bind($request->getParameter($this->getName()), $request->getFiles($this->getName()));

        return $this->isValid();
    }

}
