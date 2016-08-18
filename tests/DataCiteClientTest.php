<?php

class DataCiteClientTest extends PHPUnit_Framework_TestCase
{
    private $client;

    /** @test */
    public function test_construct_object()
    {
        $this->assertEquals(
            $this->client->getDataciteUrl(),getenv('DATACITE_URL')
        );
    }

    /** @test */
    public function it_should_return_a_doi()
    {
        $get = $this->client->get("10.5072/00/56610ec83d432");
        $this->assertEquals($get, "https://devl.ands.org.au/minh/");
        $this->assertFalse($this->client->hasError());
    }

    /** @test */
    public function it_should_return_good_xml_for_a_doi()
    {
        $actual = new DOMDocument;
        $metadata = $this->client->getMetadata("10.5072/00/56610ec83d432");
        $actual->loadXML($metadata);

        $this->assertFalse($this->client->hasError());
        $this->assertEquals("resource", $actual->firstChild->tagName);
    }

    /** @test */
    public function test_mint_a_new_doi()
    {
        $xml = file_get_contents("./tests/sample.xml");
        $response = $this->client->mint(
            "10.5072/00/56610ec83d432", "https://devl.ands.org.au/minh/", $xml
        );
        $this->assertTrue($response);
    }

    /** @test */
    public function it_should_set_datacite_url()
    {
        //setdatacite_url
        //make sure it's the new one
    }

    /** @test */
    public function it_should_update_a_doi_with_new_xml()
    {
        //run update with new xml
        //get the new xml and make sure it's the same
        //put old xml back?
    }

    /** @test */
    public function it_should_activate_a_doi_and_then_deactivate()
    {
        //make sure the DOI is activated
        //deactivate it
        //make sure it's deactivated
        //activate it
        //make sure it's activated in the status
    }

    /**
     * Run Once before all other tests
     * setup the client
     */
    protected function setUp()
    {
        require_once('vendor/autoload.php');

        $dotenv = new Dotenv\Dotenv(__DIR__);
        $dotenv->load();
        $username = getenv('DATACITE_USERNAME');
        $password = getenv('DATACITE_PASSWORD');

        $this->client = new MinhD\DataCiteClient($username, $password);
        $this->client->setDataciteUrl(getenv('DATACITE_URL'));
    }

}