<?php
namespace MyLegacyProject\Manager\Helper;

class HelperTest extends \PHPUnit_Framework_TestCase
{
    private $filename = __DIR__ . '/../../../../data/arbresremarquablesparis2011.json';


    protected $_helper;

    protected function setUp() {
        $this->_helper = new Helper();
    }

    /**
     * @expectedException \MyLegacyProject\Manager\Helper\HelperException
     * @expectedExceptionMessage File not found
     */
    public function testLoadJsonData() {
        $this->_helper->loadJsonData('');
    }

    public function testLoadJsonDataSuccess() {
        $this->_helper->loadJsonData($this->filename);
    }



}