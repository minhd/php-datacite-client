<?php
namespace MinhD;


/**
 * A Client that interfaces with datacite.org
 * Class DataCite_Client
 * @author Minh Duc Nguyen <dekarvn@gmail.com>
 * @package MinhD
 */
class DataCite_Client
{

    private $username;
    private $password;
    private $dataciteUrl = 'https://mds.datacite.org/';

    private $errors = array();
    private $messages = array();

    /**
     * DataCite_Client constructor.
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * get the URL content of a DOI by ID
     * @param $doiId
     * @return mixed
     */
    public function get($doiId)
    {
        return $this->request($this->dataciteUrl . 'doi/' . $doiId);
    }

    /**
     * get the Metadata of a DOI by ID
     * @param $doiId
     * @return mixed
     */
    public function getMetadata($doiId)
    {
        return $this->request($this->dataciteUrl . 'metadata/' . $doiId);
    }


    public function mint($doiId, $doiUrl, $xmlBody = false)
    {
        //update xml first
        $response = $this->update($xmlBody);
        echo $response;
        return $this->request($this->dataciteUrl. 'doi/', "doi=".$doiId."\nurl=".$doiUrl);
    }

    /**
     * Update XML
     * @param bool|false $xmlBody
     * @return mixed
     */
    public function update($xmlBody = false)
    {
        return $this->request($this->dataciteUrl . 'metadata/', $xmlBody);
    }

    public function activate()
    {

    }

    public function deActivate($doiId)
    {
        return $this->request($this->dataciteUrl . 'metadata/'.$doiId, false, "DELETE");
    }

    /**
     * @return string
     */
    public function getDataciteUrl()
    {
        return $this->dataciteUrl;
    }

    /**
     * @param string $dataciteUrl
     */
    public function setDataciteUrl($dataciteUrl)
    {
        $this->dataciteUrl = $dataciteUrl;
    }

    private function request($url, $content = false, $customRequest = false)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/xml;charset=UTF-8"));

        if ($content) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        }

        if ($customRequest) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        $output = curl_exec($ch);
        curl_close($ch);

        $this->log('info', 'request url=' . $url . ' response=' . $output);

        return $output;
    }

    private function log($context, $content)
    {
        if ($context == 'error') {
            $this->errors[] = $content;
        } else if ($context == 'info') {
            $this->messages[] = $content;
        }
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasError()
    {
        if (sizeof($this->errors) > 0) {
            return true;
        } else return false;
    }
}
