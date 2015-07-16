<?php
namespace TillReceiptTest\Model;

use TillReceipt\Model\TillReceipt;
use PHPUnit_Framework_TestCase;

class TillReceiptTest extends PHPUnit_Framework_TestCase
{
    public function testInputFiltersAreSetCorrectly()
    {
        $tillReceipt = new TillReceipt();

        $inputFilter = $tillReceipt->getReceipt();

        $this->assertSame(5, count($inputFilter));
        $this->assertArrayHasKey('items',$inputFilter);
       /* $this->assertTrue($inputFilter->has('id'));
        $this->assertTrue($inputFilter->has('title'));*/
    }
}