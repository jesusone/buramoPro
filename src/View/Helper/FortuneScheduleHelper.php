<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\ORM\TableRegistry;

/**
 * FortuneSchedule helper
 */
class FortuneScheduleHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public    $helpers        = ['FortuneSchedule'];

    /**
     * [CheckIsTime description]
     * @param [int] $id       [description]
     * @param [datetime] $day [description]
     * @param [int] $id_time  [description]
     */
    public function CheckIsTime($id = null, $day = null, $id_time = null)
    {
    	$fortuneSchedule  = TableRegistry::get('UserFortuneSchedule');
    	$query = $fortuneSchedule->find()->select(['id'])
    	                           ->where(['fortune_id =' => $id])
    	                           ->where([
    	                           		'schedule_day ='     => $day,
    	                           		'schedule_time_id =' => $id_time
    	                           	]);
    	if ( ! empty($query->toArray() )) {
    		return true;
    	} else {
    		return false;
    	}
    }

    /** 
     * [CheckIsTime description]
     * @param [int] $id          [description]
     * @param [date] $day        [description]
     * @param [id_time] $id_time [description]
     */
    public function CheckIsHasUser($id = null, $day = null, $id_time = null)
    {
        $fortuneSchedule  = TableRegistry::get('UserFortuneSchedule');
        $query = $fortuneSchedule->find()->select(['user_id'])
                                   ->where(['fortune_id =' => $id])
                                   ->where([
                                        'schedule_day ='     => $day,
                                        'schedule_time_id =' => $id_time
                                    ])
                                   ->first();
        if ($query != null) {
            if ($query->user_id != 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** 
     * [getListTime description]
     * @param  [int] $id  [description]
     * @param  [type] $day [description]
     * @return [type]      [description]
     */
    public function getListTime($id = null, $day = null)
    {
    	$fortuneSchedule  = TableRegistry::get('UserFortuneSchedule');
    	$query = $fortuneSchedule->find()
    							 ->where(['fortune_id =' => $id])
    							 ->where(['schedule_day =' => $day]);
    	return $query;
    }

    /** 
     * [getCountMsg description]
     * @param  [type] $id_fortune [description]
     * @return [type]             [description]
     */
    public function getCountMsg($id_fortune = null)
    {
        $userFortuneMsg = TableRegistry::get('UserFortuneMsg');
        $query = $userFortuneMsg->find()
                                ->where(['fortune_id =' => $id_fortune])
                                ->where(['is_views ='   => 0]);
        if ($query) {
            return count($query->toArray());
        } else {
            return false;
        }
    }

    /**
     * @param null $fortune_id
     * @param null $day
     * @return array time
     */
    public function getTimeScheduleByFortune($fortune_id = null, $day = null){

       $tableUserFortuneSchedule  = TableRegistry::get('UserFortuneSchedule');
       $query = $tableUserFortuneSchedule->find();

       $query->select(['ScheduleTime.name','ScheduleTime.id'])
               ->where(['UserFortuneSchedule.fortune_id' => $fortune_id])
               ->where(['UserFortuneSchedule.schedule_day' => $day])
               ->where(['UserFortuneSchedule.delete_flg' => 0])
               ->contain('ScheduleTime')
               ->group(['schedule_time_id']);

       return $query->toArray();
    }

    /** 
     * [checkUserOrder description]
     * @param  [int] $id_fortune [description]
     * @param  [datetime] $day   [description]
     * @param  [int] $id_time    [description]
     * @return [boolean]         [description]
     */
    public function checkUserOrder($id_fortune = null, $day = null, $id_time = null)
    {
        $tableUserFortuneSchedule  = TableRegistry::get('UserFortuneSchedule');
        $query = $tableUserFortuneSchedule->find()
                                          ->where(['fortune_id' => $id_fortune])
                                          ->where([
                                                'schedule_day ='     => $day,
                                                'schedule_time_id =' => $id_time,
                                                'user_id' => 0
                                            ]);
        if (!empty($query->toArray())) {
            return true;
        } else {
            return false;
        }
    }
}
