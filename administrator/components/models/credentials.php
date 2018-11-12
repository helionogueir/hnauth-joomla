<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthModelCredentials extends JModelList
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

    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = $this->_fields;
        }
        parent::__construct($config);
    }

    protected function getListQuery()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(implode(",", $this->_fields))
            ->from($db->quoteName('#__hnauth_credential'));
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('code LIKE ' . $like);
            $query->where('title LIKE ' . $like);
        }
        $published = $this->getState('filter.published');
        if (is_numeric($published)) {
            $query->where('published = ' . (int)$published);
        } elseif ($published === '') {
            $query->where('(published IN (0, 1))');
        }
        $orderCol = $this->state->get('list.ordering', 'id');
        $orderDirn = $this->state->get('list.direction', 'asc');
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
        return $query;
    }

}
