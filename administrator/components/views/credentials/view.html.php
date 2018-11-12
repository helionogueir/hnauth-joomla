<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthViewCredentials extends JViewLegacy
{

    public function display($tpl = null)
    {
        $app = JFactory::getApplication();
        $context = "hnauth.list.admin.credentials";
        $this->items = $this->get('Items');
        $this->state = $this->get('State');
        $this->filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'name', 'cmd');
        $this->filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->pagination = $this->get('Pagination');
        if ($errors = $this->get('Errors')) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        JToolBarHelper::title(JText::_('COM_HNAUTH_CREDENTIALS'));
        JToolbarHelper::addNew('credential.add');
        JFactory::getDocument()->setTitle(JText::_('COM_HNAUTH_CREDENTIALS'));
        parent::display($tpl);
    }

}
