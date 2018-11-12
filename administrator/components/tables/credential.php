<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthTableCredential extends JTable
{

    public function __construct(&$db)
    {
        parent::__construct('#__hnauth_credential', 'id', $db);
    }

}
