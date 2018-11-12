<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthViewLogon extends JViewLegacy
{

    public function display($tpl = null)
    {
        $user = JFactory::getUser();
        if (empty($user->id)) {
            JFactory::getApplication()->redirect('/');
        } else {
            JLoader::register('HnAuthUri', JPATH_COMPONENT . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "uri.php");
            JLoader::register('HnAuthGroups', JPATH_COMPONENT . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "groups.php");
            $data = array(
                "id" => $user->get("id"),
                "name" => $user->get("name"),
                "username" => $user->get("username"),
                "email" => $user->get("email"),
                "groups" => (new HnAuthGroups())->getList($user)
            );
            if ($uri = (new HnAuthUri())->generate($data)) {
                header("location:{$uri}");
            }
        }

    }

}
