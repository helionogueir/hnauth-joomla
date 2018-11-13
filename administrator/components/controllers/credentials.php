<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthControllerCredentials extends JControllerAdmin
{

    public function getModel($name = 'Credential', $prefix = 'HnAuthModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

}
