<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BrmFortuneRankingTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BrmFortuneRankingTable Test Case
 */
class BrmFortuneRankingTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BrmFortuneRankingTable
     */
    public $BrmFortuneRanking;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.brm_fortune_ranking',
        'app.fortunes',
        'app.user_fortune_comments',
        'app.users',
        'app.user_schedules',
        'app.fortune_execute_historys',
        'app.user_fortune_msg',
        'app.user_fortune_msg_detail',
        'app.fortune_expert_infors',
        'app.expert_infors',
        'app.brm_fortune_profile'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BrmFortuneRanking') ? [] : ['className' => 'App\Model\Table\BrmFortuneRankingTable'];
        $this->BrmFortuneRanking = TableRegistry::get('BrmFortuneRanking', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BrmFortuneRanking);

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
