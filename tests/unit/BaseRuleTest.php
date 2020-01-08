<?php 
class BaseRuleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testRandomNameMd5()
    {
        $rand = \daxslab\nocaptcha\rules\BaseRule::getRandomName(\daxslab\nocaptcha\rules\BaseRule::RANDOM_MD5);
        $this->assertIsString($rand);
        $this->assertTrue(preg_match('/^[a-f0-9]{32}$/', $rand) == true);
    }

    public function testRandomNameSha1()
    {
        $rand = \daxslab\nocaptcha\rules\BaseRule::getRandomName(\daxslab\nocaptcha\rules\BaseRule::RANDOM_SHA1);
        $this->assertIsString($rand);
        $this->assertTrue(preg_match('/^[0-9a-f]{40}$/i', $rand) == true);

    }

    public function testRandomNameSha256()
    {
        $rand = \daxslab\nocaptcha\rules\BaseRule::getRandomName(\daxslab\nocaptcha\rules\BaseRule::RANDOM_SHA256);
        $this->assertIsString($rand);
        $this->assertTrue(preg_match('/^[0-9a-f]{64}$/i', $rand) == true);
    }

    public function testRandomNameUniqId()
    {
        $rand = \daxslab\nocaptcha\rules\BaseRule::getRandomName(\daxslab\nocaptcha\rules\BaseRule::RANDOM_UNIQID);
        $this->assertIsString($rand);
        $this->assertTrue(preg_match('/^[0-9a-f]{13}$/i', $rand) == true);
    }

    public function testRandomNameInteger()
    {
        $rand10 = \daxslab\nocaptcha\rules\BaseRule::getRandomName(10);
        $this->assertIsString($rand10);
        $this->assertTrue(preg_match('/^[0-9a-z]{10}$/i', $rand10) == true);

        $rand4 = \daxslab\nocaptcha\rules\BaseRule::getRandomName(4);
        $this->assertIsString($rand4);
        $this->assertTrue(preg_match('/^[0-9a-z]{4}$/i', $rand4) == true);
    }

    public function testRandomNameArray()
    {
        $arrayValues = ['a', 'b', 'c', 'd', 'e', 'h', 'i', 'j'];
        $rand = \daxslab\nocaptcha\rules\BaseRule::getRandomName($arrayValues);
        $this->assertContains($rand, $arrayValues);
    }

    public function testCreateBaseRule(){
        $newBaseRule = \daxslab\nocaptcha\rules\BaseRule::create([
            'name' => 'new_base_rule',
        ]);
        $this->assertEquals('new_base_rule', $newBaseRule->name);
        $this->assertEquals(\daxslab\nocaptcha\rules\BaseRule::METHOD_POST, $newBaseRule->method);
    }

    public function testCreateBaseRuleWithRandomName(){
        $baseRule = \daxslab\nocaptcha\rules\BaseRule::create([
            'random_name' => 10,
        ]);
        $this->assertTrue(preg_match('/^[0-9a-z]{10}$/i', $baseRule->name) == true);
        $name = $baseRule->name;
        $newBaseRule = \daxslab\nocaptcha\rules\BaseRule::create([
            'random_name' => 10,
        ]);
        $this->assertEquals($name, $newBaseRule->name);
    }

}