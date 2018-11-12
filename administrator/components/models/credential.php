<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthModelCredential extends JModelAdmin
{

    private $_fields = array(
        'id',
        'code',
        'title',
        'uri',
        'publickey',
        'secretkey',
        'obs',
        'created',
        'modified',
        'published'
    );

    public function getTable($type = 'Credential', $prefix = 'HnAuthTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_hnauth.credential',
            'credential',
            array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState(
            'com_hnauth.edit.credential.data',
            array()
        );
        if (empty($data)) {
            $data = $this->getItem();
        }
        return $data;
    }

    public function findAllByCode($code)
    {
        $data = null;
        if (!empty($code)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                ->from($db->quoteName('#__hnauth_credential'))
                ->where('published = 1')
                ->where("code = '{$code}'");
            if ($row = $db->setQuery($query)->loadObject()) {
                $data = $row;
            }
        }
        return $data;
    }

}
