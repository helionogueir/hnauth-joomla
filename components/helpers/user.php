<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthUser
{

    private $user = null;
    private $credential = null;
    private $fields = null;

    public function __construct(\HnAuthCredential $credential, \Joomla\CMS\User\User $user)
    {
        JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
        $this->user = $user;
        $this->credential = $credential;
        $this->fields = FieldsHelper::getFields('com_users.user', $this->user, true);
    }

    public function prepare(array &$data)
    {
        try {
            if ($name = $this->credential->matchBehaviorsTemplate('user')) {
                $data[$name] = array(
                    "idnumber" => $this->user->get("id"),
                    "firstname" => $this->setFirstname(),
                    "lastname" => $this->setLastname(),
                    "username" => $this->user->get("username"),
                    "email" => $this->user->get("email"),
                    "deleted" => $this->user->get("block"),
                    "lang" => $this->user->getParam("language"),
                    "timezone" => $this->user->getParam("timezone")
                );
                $this->setFields($data[$name]);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    private function setFirstname()
    {
        if ($data = explode(' ', $this->user->get("name"))) {
            return reset($data);
        }
        return '';
    }

    private function setLastname()
    {
        $arrayName = explode(' ', $this->user->get("name"));
        unset($arrayName[0]);
        return implode(' ', $arrayName);
    }

    private function setFields(array &$data)
    {
        JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
        $_fields = FieldsHelper::getFields('com_users.user', $this->user, true);
        $fields = array();
        foreach ($_fields as $field) {
            $fields[$field->name] = $field->value;
        }
        $data = array_merge($data, $this->credential->matchBehaviorsFields($fields));
    }
}

