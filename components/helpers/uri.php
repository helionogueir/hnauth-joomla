<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthUri
{

    public function __construct()
    {
        JLoader::register('JWT', JPATH_COMPONENT . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "jwt.php");
        JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_hnauth/models', 'HnAuthModel');
    }

    public function generate(array $data)
    {
        try {
            $uri = null;
            $model = JModelLegacy::getInstance('Credential', 'HnAuthModel', array('ignore_request' => true));
            if ($credential = $model->findAllByCode('standard')) {
                $payload = array(
                    "exp" => time() + 30,
                    "publicOrAccessKey" => $credential->publickey,
                    "data" => $data
                );
                if ($token = JWT::encode($payload, $credential->secretkey, 'HS256')) {
                    $uri = preg_replace("/(\:token)/", $token, $credential->uri);
                }
            }
            return $uri;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}

