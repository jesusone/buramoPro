<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\FortuneScheduleHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\FortuneScheduleHelper Test Case
 */
class FortuneScheduleHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\FortuneScheduleHelper
     */
    public $FortuneSchedule;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->FortuneSchedule = new FortuneScheduleHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FortuneSchedule);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
