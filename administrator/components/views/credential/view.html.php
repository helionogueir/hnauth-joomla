<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthViewCredential extends JViewLegacy
{

    protected $form = null;

    public function display($tpl = null)
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->script = $this->get('Script');
        if ($errors = $this->get('Errors')) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        JFactory::getApplication()->input->set('hidemainmenu', true);
        JToolbarHelper::title(JText::_('COM_HNAUTH_CREDENTIAL'));
        JToolbarHelper::save('credential.save');
        JToolbarHelper::cancel('credential.cancel', ($this->item->id == 0) ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
        JFactory::getDocument()->setTitle(JText::_('COM_HNAUTH_CREDENTIAL'));
        parent::display($tpl);
    }

}
