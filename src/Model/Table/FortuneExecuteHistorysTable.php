<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;


class FortuneExecuteHistorysTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('brm_fortune_execute_history');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Fortunes', [
            'foreignKey' => 'fortune_id',
        ]);

        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
        ]);
    }

    public function validationDefault(Validator $validator)
    {

        return $validator
            ->notEmpty('nickname', 'A nickname is required')
            ->notEmpty('mail_address', 'A mail address is required')
            ->add('mail_address', 'inList', [
                'rule' => 'email',
                'message' => 'Please enter a valid email'])
            ->allowEmpty('telephone')
            ->add('telephone', 'inList', [
                'rule' => 'numeric',
                'message' => 'Please enter a valid telephone'])
            ->notEmpty('gender', 'A gender is required')
            ->add('gender', 'inList', [
                'rule' => ['inList', ['0', '1', '2']],
                'message' => 'Please enter a valid gender'])
            ->notEmpty('mail_maga', 'A mail maga is required')
            ->add('mail_maga', 'inList', [
                'rule' => ['inList', ['0', '1']],
                'message' => 'Please enter a valid mail maga']);
    }

    /** 
     * [getExeHistory description]
     * @return [type] [description]
     */
    public function getExeHistory($id_fortune)
    {
        $fortuneExeHistorys = TableRegistry::get('FortuneExecuteHistorys');
        $query = $fortuneExeHistorys->find()
                                    ->where(['fortune_id' => $id_fortune])
                                    ->contain(['Fortunes', 'User']);
        return $query;
    }

    /** 
     * [getByMonth description]
     * @param  [type] $month [description]
     * @param  [type] $year  [description]
     * @return [type]        [description]
     */
    public function getByMonth($month, $year, $id_fortune)
    {
        $query = $this->getExeHistory($id_fortune)->where([
            'MONTH(FortuneExecuteHistorys.date_created) ='  => $month,
            'YEAR(FortuneExecuteHistorys.date_created)  ='  => $year,
        ]);
        return $query;
    }

    /** 
     * [getRunRanking description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public  function  getRunRanking($data)
    {
        switch ($data['type']){
            case  'week':
                /*Set week*/
               $query =  $this->find('all')
                   ->where([
                       'date_created BETWEEN :start AND :end'
                   ])
                   ->bind(':start', $data['start'], 'date')
                   ->bind(':end',  $data['end'], 'date')
                   ->order(['money' => 'DESC'])
                   ->distinct()
                   ->limit(20)
                   ->toArray();
                return $query;
                break;
            default :
                break;

        }
    }

    /** 
     * [countHistory description]
     * @param  [type] $fortune_id [description]
     * @return [type]             [description]
     */
    public function countHistory($fortune_id = null)
    {
        $data = $this->find('all');
        $data->select([
            'count' => $data->func()->count('*')
        ])
            ->where(['fortune_id' => $fortune_id]);
        if(!empty($data)) {
            foreach ($data as $row) {
                return $row->count;
            }
        }
        else {
            return false;
        }
    }

    /** 
     * [getFiveHistory description]
     * @param  [type] $id_fortune [description]
     * @return [type]             [description]
     */
    public function getFiveHistory($id_fortune)
    {
        $query = $this->find()
                      ->where(['fortune_id =' => $id_fortune])
                      ->limit(5)
                      ->order(['date_created' => 'DESC']);
        return $query;
    }
    /**
     * @return array
     */
    public function findFortuneRankingDataByDay($start_date = null, $end_date = null)
    {
        $data = $this->find();
        $data->select('fortune_id')
            ->select([
                'sum_money' => $data->func()->SUM('money')
            ])
            ->where(function ($exp, $q) use($start_date,$end_date) {
                return $exp->between('date_created', $start_date, $end_date);
            })
            ->where(['delete_flg' => 0])
            ->limit(20)
            ->group('fortune_id')
            ->order(['sum_money' => 'DESC']);

        return $data;
    }

    /**
     * @return array
     */
    public function findFortuneRankingDataByPhone()
    {
        $data = $this->find();
        $data->select('fortune_id')
            ->select([
                'total_phone' => $data->func()->count('*')
            ])
            ->where(['call_type' => 1])
            ->where(['delete_flg' => 0])
            ->limit(3)
            ->group('fortune_id')
            ->order(['total_phone' => 'DESC']);

        return $data;
    }

    /**
     * @return array
     */
    public function findFortuneRankingDataByMessage()
    {
        $data = $this->find();
        $data->select('fortune_id')
            ->select([
                'total_message' => $data->func()->count('*')
            ])
            ->where(['call_type' => 2])
            ->where(['delete_flg' => 0])
            ->limit(3)
            ->group('fortune_id')
            ->order(['total_message' => 'DESC']);

        return $data;
    }
}
