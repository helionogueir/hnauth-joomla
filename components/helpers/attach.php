<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthAttach
{

    private $user = null;
    private $credential = null;

    public function __construct(\HnAuthCredential $credential, \Joomla\CMS\User\User $user)
    {
        $this->user = $user;
        $this->credential = $credential;
    }

    public function prepare(array &$data)
    {
        if ($attach = $this->credential->matchBehaviorsTemplate('attach')) {
            $data = array_merge($data, (array)$attach);
        }
    }
}

