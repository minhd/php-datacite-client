<?php

class DataCite_Client_test extends PHPUnit_Framework_TestCase
{
    private $client;

    protected function setUp()
    {
        $dotenv = new Dotenv\Dotenv(__DIR__);
        $dotenv->load();
        $username = getenv('username');
        $password = getenv('password');
        $this->client = new MinhD\DataCite_Client($username, $password);
        if (getenv('datacite_url')) {
            $this->client->setDataciteUrl(getenv('datacite_url'));
        }
    }

    protected function tearDown()
    {

    }

    public function testConstruct()
    {
        if (getenv('datacite_url')) {
//            assertEquals(true, $this->client->getDataciteUrl(), getenv('datacite_url'));
        }
    }

    public function testGet()
    {
        $get = $this->client->get(getenv("test_doi_1"));
        var_dump($get);

    }

    public function testGetMetadata()
    {
        $metadata = $this->client->getMetadata(getenv("test_doi_1"));
        var_dump($metadata);
    }

    public function testMint()
    {

    }

    function testUpdate()
    {

    }

    function testDeactivate()
    {

    }

    function testActivate()
    {

    }

    function testGetDataCiteUrl()
    {

    }

    function testSetDataCiteUrl()
    {

    }

}