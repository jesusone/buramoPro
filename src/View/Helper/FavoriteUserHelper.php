<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/10/2016
 * Time: 1:51 PM
 */
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;


class FavoriteUserHelper extends Helper
{
    public $helpers = ['Favorite'];

    public function  Favorite($id = null,$user_id = null){
        $model  = TableRegistry::get('UserFortuneFavorite');
        $data = $model->find('all')->select('id')
            ->where(['user_id =' => $user_id])
            ->where(['fortune_id =' => $id])
            ->where(['delete_flg' => 0]);

        if($data) {
            return true;
        }
        return false;
    }

    /*Function get Add Tags Fortune */
    public  function  TagsByFortune($fortune_id){
        $fortuneExpert  = TableRegistry::get('FortuneExpertInfors');
        if($fortune_id == ''){
            return false;
        }
         $tags = $fortuneExpert->getTagsByFortune($fortune_id);
        $show_tag = '';
        if($tags){
            $show_tag = '';
            $i = 0;
            $count = count($tags);
            foreach($tags as $tag){
                if($i < 1  ){
                    $show_tag .= $tag['ExpertInfors']->expert_name;
                }
                elseif($i = $count) {
                    $show_tag .= $tag['ExpertInfors']->expert_name;
                }
                else{
                    $show_tag .= $tag['ExpertInfors']->expert_name.', ';
                }
            }
        }
        return $show_tag;
    }
    public function getAgeForUser($birthdate = '0000-00-00') {
        if ($birthdate == '0000-00-00') return 'Unknown';
        $bits = explode('-', $birthdate);
        $age = date('Y') - $bits[0] - 1;

        $arr[1] = 'm';
        $arr[2] = 'd';

        for ($i = 1; $arr[$i]; $i++) {
            $n = date($arr[$i]);
                if ($n < $bits[$i])
                break;
            if ($n > $bits[$i]) {
                ++$age;
                break;
            }
        }
        return $age;
    }

    /**
     * @param $fortune_id
     * @return int
     */
    public function countFortuneComment($fortune_id){
        $commentTable  = TableRegistry::get('UserFortuneComment');
        if($fortune_id == ''){
            return false;
        }
        return $commentTable->countComments($fortune_id);
    }

    /**
     * @param $fortune_id
     * @return int
     */
    public function countHistory($fortune_id){
        $historyTable  = TableRegistry::get(' FortuneExecuteHistorys');
        if($fortune_id == ''){
            return false;
        }
        return $historyTable->countHistory($fortune_id);
    }
}
