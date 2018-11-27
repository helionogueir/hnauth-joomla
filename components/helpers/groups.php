<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthGroups
{

    private $user = null;
    private $credential = null;

    public function __construct(\HnAuthCredential $credential, \Joomla\CMS\User\User $user)
    {
        JLoader::register('HnAuthGroups', JPATH_COMPONENT . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "tooltip.php");
        JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_users/models', 'UsersModel');
        $this->model = JModelLegacy::getInstance('Group', 'UsersModel', array('ignore_request' => true));
        $this->user = $user;
        $this->credential = $credential;
    }

    public function prepare(array &$data)
    {
        try {
            if ($name = $this->credential->matchBehaviorsTemplate('groups')) {
                $groups = array();
                foreach (JAccess::getGroupsByUser($this->user->get('id'), false) as $id) {
                    if ($row = $this->findRowById($id)) {
                        $groups[$row->id] = array(
                            "idnumber" => $row->id,
                            "name" => $row->title
                        );
                    }
                }
                $data[$name] = array_values($groups);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    private function findRowById($id)
    {
        try {
            $data = null;
            if (!empty($id)) {
                $db = $this->model->getDbo();
                $query = $db->getQuery(true)
                    ->select('id, title')
                    ->from($db->quoteName($this->model->getTable()->getTableName()))
                    ->where("id = {$db->quote($id)}");
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

