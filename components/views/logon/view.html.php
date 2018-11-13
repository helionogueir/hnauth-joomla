<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthViewLogon extends JViewLegacy
{

    public function display($tpl = null)
    {
        $authname = JFactory::getApplication()->input->get('authname');
        if (!empty($authname)) {
            $user = JFactory::getUser();
            if (empty($user->id)) {
                JFactory::getApplication()->redirect('/');
            } else {
                JLoader::register('HnAuthUri', JPATH_COMPONENT . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "uri.php");
                JLoader::register('HnAuthUser', JPATH_COMPONENT . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "user.php");
                JLoader::register('HnAuthGroups', JPATH_COMPONENT . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "groups.php");
                JLoader::register('HnAuthAttach', JPATH_COMPONENT . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "attach.php");
                JLoader::register('HnAuthCredential', JPATH_COMPONENT . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "credential.php");
                if ($credential = HnAuthCredential::getInstance($authname)) {
                    $data = array();
                    (new HnAuthUser($credential, $user))->prepare($data);
                    (new HnAuthGroups($credential, $user))->prepare($data);
                    (new HnAuthAttach($credential, $user))->prepare($data);
                    if ($uri = (new HnAuthUri($credential))->generate($data)) {
                        header("location:{$uri}");
                    }
                }
            }
        }
    }

}
