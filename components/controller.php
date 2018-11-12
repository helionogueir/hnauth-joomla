<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthController extends JControllerLegacy
{

    protected $default_view = 'logon';

    public function display($cachable = false, $urlparams = array())
    {
        JFactory::getDocument()->addScript(JURI::base(true) . "/assets/jquery/jquery.min.js");
        parent::display($cachable, $urlparams);
    }

}
