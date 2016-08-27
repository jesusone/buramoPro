<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BrmUserFortuneScheduleTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BrmUserFortuneScheduleTable Test Case
 */
class BrmUserFortuneScheduleTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BrmUserFortuneScheduleTable
     */
    public $BrmUserFortuneSchedule;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.brm_user_fortune_schedule',
        'app.users',
        'app.user_fortune_comments',
        'app.fortunes',
        'app.fortune_expert_infors',
        'app.expert_infors',
        'app.user_schedules',
        'app.brm_fortune_profile',
        'app.fortune_execute_historys',
        'app.user_fortune_msg',
        'app.user_fortune_msg_detail',
        'app.schedule_times'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BrmUserFortuneSchedule') ? [] : ['className' => 'App\Model\Table\BrmUserFortuneScheduleTable'];
        $this->BrmUserFortuneSchedule = TableRegistry::get('BrmUserFortuneSchedule', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BrmUserFortuneSchedule);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
