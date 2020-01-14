<?php

require_once('lib/bootstrap.php');

class XmlTest extends PHPUnit_Framework_TestCase {

  protected $string;

  public function setUp(): void {
    $this->string = 'Süper Önencœded ßtring';
  }

  public function testEncodeDecode() {

    $expected = 'S&#252;per &#214;nenc&#339;ded &#223;tring';

    $this->assertEquals($expected, xml::encode($this->string));
    $this->assertEquals($this->string, xml::decode($expected));

  }

}
