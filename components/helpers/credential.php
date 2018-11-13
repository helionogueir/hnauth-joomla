<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthCredential
{

    private $id = 0;
    private $template = '';
    private $usergroupid = 0;
    private $authname = '';
    private $title = '';
    private $uri = '';
    private $publickey = '';
    private $secretkey = '';
    private $ttl = 0;
    private $behaviors = '{}';
    private $obs = '';
    private $created = '';
    private $modified = '';
    private $published = 0;

    public static function getInstance($authname)
    {
        JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_hnauth/models', 'HnAuthModel');
        $model = JModelLegacy::getInstance('Credential', 'HnAuthModel', array('ignore_request' => true));
        if ($credential = $model->findRowByAuthname($authname)) {
            return (new HnAuthCredential($credential));
        }
    }

    public function __construct(\stdClass $credential)
    {
        foreach ($credential as $name => $value) {
            if (isset($this->{$name})) {
                $this->{$name} = $value;
            }
        }
    }

    public function get($key)
    {
        $value = null;
        if (!empty($key) && !empty($this->{$key})) {
            $value = $this->{$key};
            if ('behaviors' == $key) {
                $data = json_decode($this->{$key});
                if (JSON_ERROR_NONE == json_last_error_msg()) {
                    $value = $data;
                }
            }
        }
        return $value;
    }

    public function matchBehaviorsFields(array &$values)
    {
        $data = array();
        $behaviors = $this->get('behaviors');
        if (!empty($behaviors->fields) && ($behaviors->fields instanceof \stdClass)) {
            foreach ($behaviors->fields as $name => $value) {
                $data[$name] = '';
                if (!empty($values[$value])) {
                    $data[$name] = $values[$value];
                }
            }
        }
        return $data;
    }

    public function matchBehaviorsTemplate($key)
    {
        $data = null;
        $behaviors = $this->get('behaviors');
        if (!empty($behaviors->template) && ($behaviors->template instanceof \stdClass)) {
            if (!empty($behaviors->template->{$key})) {
                $data = $behaviors->template->{$key};
            }
        }
        return $data;
    }

}

