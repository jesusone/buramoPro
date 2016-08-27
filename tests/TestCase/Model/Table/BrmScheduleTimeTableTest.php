<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BrmScheduleTimeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BrmScheduleTimeTable Test Case
 */
class BrmScheduleTimeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BrmScheduleTimeTable
     */
    public $BrmScheduleTime;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.brm_schedule_time'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BrmScheduleTime') ? [] : ['className' => 'App\Model\Table\BrmScheduleTimeTable'];
        $this->BrmScheduleTime = TableRegistry::get('BrmScheduleTime', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BrmScheduleTime);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
