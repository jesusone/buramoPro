<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * BrmUserFortuneSchedule Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Fortunes
 * @property \Cake\ORM\Association\BelongsTo $ScheduleTimes
 *
 * @method \App\Model\Entity\BrmUserFortuneSchedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\BrmUserFortuneSchedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneSchedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneSchedule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BrmUserFortuneSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneSchedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneSchedule findOrCreate($search, callable $callback = null)
 */
class UserFortuneScheduleTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('brm_user_fortune_schedule');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Fortunes', [
            'foreignKey' => 'fortune_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ScheduleTime', [
            'foreignKey' => 'schedule_time_id',
            'joinType' => 'INNER'
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->date('schedule_day')
            ->requirePresence('schedule_day', 'create')
            ->notEmpty('schedule_day');

        $validator
            ->date('user_updated')
            ->allowEmpty('user_updated');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->boolean('delete_flg')
            ->requirePresence('delete_flg', 'create')
            ->notEmpty('delete_flg');

        $validator
            ->dateTime('date_created')
            ->requirePresence('date_created', 'create')
            ->notEmpty('date_created');

        $validator
            ->dateTime('date_modified')
            ->requirePresence('date_modified', 'create')
            ->notEmpty('date_modified');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'User'));
        $rules->add($rules->existsIn(['fortune_id'], 'Fortunes'));
        $rules->add($rules->existsIn(['schedule_time_id'], 'ScheduleTimes'));

        return $rules;
    }

    /**
     * [getSchedule description]
     * @param  [int] $id  [description]
     * @param  [datetime] $day [description]
     * @return [array]      [description]
     */
    public function getSchedule($id, $day)
    {
        $fortuneSchedule = TableRegistry::get('UserFortuneSchedule');
        $query           = $fortuneSchedule->find();
        $query->where(['fortune_id ='   => $id])
              ->where(['schedule_day =' => $day])
              ->contain(['ScheduleTimes']);
        return $query->toArray();
    }

    /**
     * [getDateTimeFortuneSchedule description]
     * @param  [type] $id_fortune [description]
     * @param  [type] $day        [description]
     * @return [type]             [description]
     */
    public function getDateTimeFortuneSchedule($id_fortune, $day, $id_times)
    {
        $fortuneSchedule = TableRegistry::get('UserFortuneSchedule');
        $query = $fortuneSchedule->find()
                                 ->where(['fortune_id = ' => $id_fortune])
                                 ->where(['schedule_day =' => $day, 'schedule_time_id =' => $id_times])
                                 ->contain(['ScheduleTimes']);
        $data = $query->toArray();
        if ($data) {
            return true;
        }
        return false;
    }

    /**
     * [insertSchedule description]
     * @param  [int] $id_fortune [description]
     * @param  [date] $day       [description]
     * @param  [int] $id_time    [description]
     * @return [type]            [description]
     */
    public function insertSchedule($id_fortune, $day, $id_time)
    {
        $query = $this->query();
        $query->insert(['user_id', 'fortune_id', 'schedule_day', 'schedule_time_id'])
              ->values([
                            'user_id'          => 0,
                            'fortune_id'       => $id_fortune,
                            'schedule_day'     => $day,
                            'schedule_time_id' => $id_time
                      ])
              ->execute();
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * [getInforUser description]
     * @param  [int] $id_fortune      [description]
     * @param  [datetime] $day        [description]
     * @param  [id_times] $id_time    [description]
     * @return [array]                [description]
     */
    public function getInforUser($id_fortune, $day, $id_time)
    {
        $query = $this->find()
                     ->where(['fortune_id ='   => $id_fortune])
                     ->where(['schedule_day =' => $day, 'schedule_time_id =' => $id_time])
                     ->contain(['User', 'ScheduleTime'])
                     ->first();
        return $query;
    }

}
