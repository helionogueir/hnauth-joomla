<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthGroups
{

    public function __construct()
    {
        JLoader::register('HnAuthGroups', JPATH_COMPONENT . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "tooltip.php");
        JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_users/models', 'UsersModel');
        $this->model = JModelLegacy::getInstance('Group', 'UsersModel', array('ignore_request' => true));
    }

    public function getList(\Joomla\CMS\User\User $user)
    {
        try {
            $data = array();
            foreach (JAccess::getGroupsByUser($user->get('id'), false) as $id) {
                if ($row = $this->findRowById($id)) {
                    $data[] = $row;
                }
            }
            return $data;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function findRowById($id)
    {
        try {
            $data = null;
            if (!empty($id)) {
                $db = $this->model->getDbo();
                $query = $db->getQuery(true)
                    ->select('id, title')
                    ->from($db->quoteName($this->model->getTable()->getTableName()))
                    ->where("id = '{$id}'");
                if ($row = $db->setQuery($query)->loadObject()) {
                    $data = $row;
                }
            }
            return $data;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}

