<?php
namespace JiongruanTest\HyperfUtils;
use Jiongruan\HyperfUtils\ObjetcUtil;
use JiongruanTest\HyperfUtils\Demo\DemoA;
use JiongruanTest\HyperfUtils\Demo\DemoB;
use JiongruanTest\HyperfUtils\Demo\DemoC;
use \PHPUnit\Framework\TestCase;
class ArrayTest extends TestCase
{
    public function testToArray(){
        $demoA=new DemoA();
        $demoA->a=123;
        $demoA->c=456;
        $demoA->b="789";
        $array=ObjetcUtil::toArray($demoA);
        $this->assertIsArray($array);
        $this->assertArrayHasKey('a',$array);
        $this->assertArrayHasKey('b',$array);
        $this->assertArrayHasKey('c',$array);
        $this->assertEquals($demoA->a,$array['a']);
        $this->assertEquals($demoA->b,$array['b']);
        $this->assertEquals($demoA->c,$array['c']);
    }

    public  function testToArrayWithCamelKeytoUnderLine(){
        $demoB=new DemoB();
        $demoB->a_a="7777";
        $demoB->aA="VVVVVV";
        $demoB->c_cData="7777";
        $demoB->aSCdeo=123123;
        $demoB->demoC=new DemoC();
        $demoB->demoC->aSCdeo=7777;
        $array=ObjetcUtil::toArrayWithCamelKeytoUnderLine($demoB);

        $this->assertIsArray($array);
        $this->assertArrayHasKey('a_a',$array);
        $this->assertArrayHasKey('c_c_data',$array);
        $this->assertArrayHasKey('a_scdeo',$array);
        $this->assertArrayNotHasKey('aSCdeo',$array);
        $this->assertArrayNotHasKey('aA',$array);
        $this->assertArrayNotHasKey('c_cData',$array);

        $this->assertIsArray($array['demo_c']);
        $this->assertArrayHasKey('a_d',$array['demo_c']);
        $this->assertArrayHasKey('b_123',$array['demo_c']);
        $this->assertArrayHasKey('c_c_data',$array['demo_c']);
        $this->assertArrayHasKey('a_a',$array['demo_c']);
        $this->assertArrayHasKey('a_scdeo',$array['demo_c']);
    }
}
