<?php

defined('_JEXEC') or die('Restricted access');

class HnAuthUri
{
    private $credential = null;

    public function __construct(\HnAuthCredential $credential)
    {
        $this->credential = $credential;
    }

    public function generate(array $data)
    {
        try {
            $uri = null;
            JLoader::register('JWT', JPATH_COMPONENT . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "jwt.php");
            if (!empty($this->credential->get('uri'))
                && !empty($this->credential->get('publickey'))
                && !empty($this->credential->get('secretkey'))) {
                $payload = array(
                    "exp" => time() + intval($this->credential->get('ttl')),
                    "publicOrAccessKey" => $this->credential->get('publickey'),
                    "data" => $data
                );
                if ($token = JWT::encode($payload, $this->credential->get('secretkey'), 'HS256')) {
                    $pattern = "/(\:token)/";
                    if (preg_match($pattern, $this->credential->get('uri'))) {
                        $uri = preg_replace($pattern, $token, $this->credential->get('uri'));
                    }
                }
            }
            return $uri;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}

