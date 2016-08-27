<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BrmScheduleTime Model
 *
 * @method \App\Model\Entity\BrmScheduleTime get($primaryKey, $options = [])
 * @method \App\Model\Entity\BrmScheduleTime newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BrmScheduleTime[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BrmScheduleTime|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BrmScheduleTime patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BrmScheduleTime[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BrmScheduleTime findOrCreate($search, callable $callback = null)
 */
class ScheduleTimeTable extends Table
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

        $this->table('brm_schedule_time');
        $this->displayField('name');
        $this->primaryKey('id');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('time_text', 'create')
            ->notEmpty('time_text');

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
     * get all fortunes schedules of the user
     * @return $this
     */
    public function listScheduleTime()
    {
        return $this->find('all')
            ->where(function($exp) {
                return $exp->between('id', 5, 20);
            })
            ->where(['delete_flg' => 0])
            ->toArray();
    }

    /** 
     * [getListTime description]
     * @return [type] [description]
     */
    public function getListTime()
    {
        $query = $this->find();
        return $query->toArray();
    }
}
