<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/22/2016
 * Time: 10:59 AM
 */

namespace App\Shell;
use Cake\Console\Shell;
use Cake\Datasource\ConnectionManager;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\DateTimeComponent;
use Cake\ORM\TableRegistry;
use App\Model\Entity\FortuneRanking;
use Cake\I18n\Time;

class RankingShell extends Shell
{
    protected $dateTime;

    const WEEK          = 1;
    const MONTH         = 2;
    const SPECIAL       = 3;
    const YEAR          = 4;
    const FLG_OFF       = 0;

    const KIND_WEEK     = 'week';
    const KIND_MONTH    = 'month';
    const KIND_PHONE    = 'phone';
    const KIND_MESSAGE  = 'message';
    const KIND_COMMENT  = 'comment';
    const KIND_LATEST   = 'latest';
    const KIND_YEAR     = 'year';


    public function initialize()
    {
        parent::initialize();

        // toan use to debug query for code //cli-debug.log
        $conn = ConnectionManager::get('default');
        // Turn query logging on.
        $conn->logQueries(true);

        $this->dateTime = new DateTimeComponent(new ComponentRegistry());

    }

    public function main()
    {
        $this->out('Hello world.');
    }


//    public function createFortuneRankingData()
//    {
//        if (empty($this->args[0])) {
//            // Use error() before CakePHP 3.2
//            return $this->abort('Please enter a rank type.');
//        }
//
//        $tableFortuneExecuteHistory = $this->loadModel('brm_fortune_execute_history');
//
//        $rank_type = $this->args[0];
//
//        switch ($rank_type) {
//            case "week":
//                //best fortune in this week
//                break;
//            case "month":
//                //best fortune in this month
//                break;
//            case "phone":
//                //best fortune by phone
//                break;
//            case "message":
//                //best fortune by message
//                break;
//            case "comment":
//                //best fortune by comment
//                break;
//            case "latest":
//                //the latest fortune join
//                break;
//            case "year":
//                //the best fortune in year
//                break;
//            default:
//                echo "Your rank type is not support!";
//        }
//        $user = $tableFortuneExecuteHistory->findFortuneRankingDataByWeek();
//        dump($user);die;
//        $this->out(print_r($user, true));
//        $this->out('Hello world.');
//    }

    /**
     *  create top 20 fortune ranking in this week
     */
    public function createFortuneRankingDataByWeek()
    {
        $start_date                     = $this->dateTime->beginDayofWeek();
        $end_date                       = $this->dateTime->lastDayofWeek();
        $tableFortuneExecuteHistory     = $this->loadModel('FortuneExecuteHistorys');
        $data                           = $tableFortuneExecuteHistory->findFortuneRankingDataByDay($start_date, $end_date);

        $this->out(print_r(dump($data)));

        $rankingTable                   = TableRegistry::get('FortuneRanking');
        $rankingTable->deteteFortuneRankingData(self::KIND_WEEK);

        foreach ($data as $index => $history) {
            $ranking                    =   $rankingTable->newEntity();
            $ranking->fortune_id        =	$history->fortune_id;
            $ranking->rank              =	$index + 1;
            $ranking->rank_kind         =	self::WEEK;
            $ranking->fortune_kind_name =	self::KIND_WEEK;
            $ranking->delete_flg        =	self::FLG_OFF;
            $ranking->date_created      =	Time::now();
            $ranking->date_modified     =	Time::now();

            $rankingTable->save($ranking);
        }
    }

    /**
     *  create top 20 fortune ranking in this month
     */
    public function createFortuneRankingDataByMonth()
    {
        $start_date                     = $this->dateTime->beginDayofThisMonth();
        $end_date                       = $this->dateTime->lastDayofThisMonth();
        $tableFortuneExecuteHistory     = $this->loadModel('FortuneExecuteHistorys');
        $data                           = $tableFortuneExecuteHistory->findFortuneRankingDataByDay($start_date, $end_date);

        $this->out(print_r(dump($data)));

        $rankingTable                   = TableRegistry::get('FortuneRanking');
        $rankingTable->deteteFortuneRankingData(self::KIND_MONTH);

        foreach ($data as $index => $history) {
            $ranking                    =   $rankingTable->newEntity();
            $ranking->fortune_id        =	$history->fortune_id;
            $ranking->rank              =	$index + 1;
            $ranking->rank_kind         =	self::MONTH;
            $ranking->fortune_kind_name =	self::KIND_MONTH;
            $ranking->delete_flg        =	self::FLG_OFF;
            $ranking->date_created      =	Time::now();
            $ranking->date_modified     =	Time::now();

            $rankingTable->save($ranking);
        }
    }

    /**
     *  create top 3 fortune ranking have the most phone
     */
    public function createFortuneRankingDataByPhone()
    {
        $tableFortuneExecuteHistory     = $this->loadModel('FortuneExecuteHistorys');
        $data                           = $tableFortuneExecuteHistory->findFortuneRankingDataByPhone();

        $this->out(print_r(dump($data)));

        $rankingTable                   = TableRegistry::get('FortuneRanking');
        $rankingTable->deteteFortuneRankingData(self::KIND_PHONE);

        foreach ($data as $index => $history) {
            $ranking                    =   $rankingTable->newEntity();
            $ranking->fortune_id        =	$history->fortune_id;
            $ranking->rank              =	$index + 1;
            $ranking->rank_kind         =	self::SPECIAL;
            $ranking->fortune_kind_name =	self::KIND_PHONE;
            $ranking->delete_flg        =	self::FLG_OFF;
            $ranking->date_created      =	Time::now();
            $ranking->date_modified     =	Time::now();

            $rankingTable->save($ranking);
        }
    }

    /**
     *  create top 3 fortune ranking have the most message
     */
    public function createFortuneRankingDataByMessage()
    {
        $tableFortuneExecuteHistory     = $this->loadModel('FortuneExecuteHistorys');
        $data                           = $tableFortuneExecuteHistory->findFortuneRankingDataByMessage();

        $this->out(print_r(dump($data)));

        $rankingTable                   = TableRegistry::get('FortuneRanking');
        $rankingTable->deteteFortuneRankingData(self::KIND_MESSAGE);


        foreach ($data as $index => $history) {
            $ranking                    =   $rankingTable->newEntity();
            $ranking->fortune_id        =	$history->fortune_id;
            $ranking->rank              =	$index + 1;
            $ranking->rank_kind         =	self::SPECIAL;
            $ranking->fortune_kind_name =	self::KIND_MESSAGE;
            $ranking->delete_flg        =	self::FLG_OFF;
            $ranking->date_created      =	Time::now();
            $ranking->date_modified     =	Time::now();

            $rankingTable->save($ranking);
        }
    }

    /**
     *  create top 3 fortune ranking have the most comment
     */
    public function createFortuneRankingDataByComment()
    {
        $tableUserFortuneComment        = $this->loadModel('UserFortuneComment');
        $data                           = $tableUserFortuneComment->findFortuneRankingDataByComment();

        $this->out(print_r(dump($data)));

        $rankingTable                   = TableRegistry::get('FortuneRanking');
        $rankingTable->deteteFortuneRankingData(self::KIND_COMMENT);


        foreach ($data as $index => $history) {
            $ranking                    =   $rankingTable->newEntity();
            $ranking->fortune_id        =	$history->fortune_id;
            $ranking->rank              =	$index + 1;
            $ranking->rank_kind         =	self::SPECIAL;
            $ranking->fortune_kind_name =	self::KIND_COMMENT;
            $ranking->delete_flg        =	self::FLG_OFF;
            $ranking->date_created      =	Time::now();
            $ranking->date_modified     =	Time::now();

            $rankingTable->save($ranking);
        }
    }

    /**
     * create top 3 newest fortune ranking
     */
    public function createFortuneRankingDataByLatest()
    {
        $tableFortune                   = $this->loadModel('Fortunes');
        $data                           = $tableFortune->findFortuneRankingDataByLatest();

        $this->out(print_r(dump($data)));

        $rankingTable                   = TableRegistry::get('FortuneRanking');
        $rankingTable->deteteFortuneRankingData(self::KIND_LATEST);

        foreach ($data as $index => $fortune) {
            $ranking                    =   $rankingTable->newEntity();
            $ranking->fortune_id        =	$fortune->id;
            $ranking->rank              =	$index + 1;
            $ranking->rank_kind         =	self::SPECIAL;
            $ranking->fortune_kind_name =	self::KIND_LATEST;
            $ranking->delete_flg        =	self::FLG_OFF;
            $ranking->date_created      =	Time::now();
            $ranking->date_modified     =	Time::now();

            $rankingTable->save($ranking);
        }
    }

    /**
     *  create top fortunes ranking in this year
     */
    public function createFortuneRankingDataByYear()
    {
        $start_date                     = $this->dateTime->beginDayofThisYear();
        $end_date                       = $this->dateTime->lastDayofThisYear();
        $tableFortuneExecuteHistory     = $this->loadModel('FortuneExecuteHistorys');
        $data                           = $tableFortuneExecuteHistory->findFortuneRankingDataByDay($start_date, $end_date);

        $this->out(print_r(dump($data)));

        $rankingTable                   = TableRegistry::get('FortuneRanking');
        $rankingTable->deteteFortuneRankingData(self::KIND_YEAR);

        foreach ($data as $index => $history) {
            $ranking                    =   $rankingTable->newEntity();
            $ranking->fortune_id        =	$history->fortune_id;
            $ranking->rank              =	$index + 1;
            $ranking->rank_kind         =	self::YEAR;
            $ranking->fortune_kind_name =	self::KIND_YEAR;
            $ranking->delete_flg        =	self::FLG_OFF;
            $ranking->date_created      =	Time::now();
            $ranking->date_modified     =	Time::now();

            $rankingTable->save($ranking);
        }
    }
}
