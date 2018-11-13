<?php

defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
$controller = JControllerLegacy::getInstance('HnAuth');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
