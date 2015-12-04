<?php
namespace MinhD;

class DOI {
    private $doi;
    private $url;
    private $xml;

    /**
     * DOI constructor.
     * @param $doi
     * @param $url
     */
    public function __construct($doi, $url)
    {
        $this->doi = $doi;
        $this->url = $url;
    }


    /**
     * @return mixed
     */
    public function getDoi()
    {
        return $this->doi;
    }

    /**
     * @param mixed $doi
     */
    public function setDoi($doi)
    {
        $this->doi = $doi;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getXml()
    {
        return $this->xml;
    }

    /**
     * @param mixed $xml
     */
    public function setXml($xml)
    {
        $this->xml = $xml;
    }

}