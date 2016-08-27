<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserPointTable Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Fortunes
 *
 * @method \App\Model\Entity\UserPoint get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserPoint newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserPoint[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserPoint|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPoint patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserPoint[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserPoint findOrCreate($search, callable $callback = null)
 */
class UserPointTable extends Table
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

        $this->table('brm_user_point');
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
            ->integer('point')
            ->requirePresence('point', 'create')
            ->notEmpty('point');

        $validator
            ->integer('money_value')
            ->requirePresence('money_value', 'create')
            ->notEmpty('money_value');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

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

        return $rules;
    }

    /**
     * @param null $user_id
     * @return $this
     */
    public function findUserPoint($user_id = null)
    {
        $data = $this->find()
            ->select([
                'Fortunes.name',
                'point',
                'money_value',
                'date',
            ])
            ->where([
                //'UserPoint.user_id =' => $user_id,
                'UserPoint.delete_flg =' => 0,
            ])
            ->contain('User')
            ->contain('Fortunes');
        return $data;
    }

    /**
     * @param $startTime
     * @param $endTime
     * @return $this
     */
    public function findUserPointSearch($startTime, $endTime){
        $data = $this->find()
            ->select([
                'Fortunes.name',
                'point',
                'money_value',
                'date',
            ])
            ->where([
                //'UserPoint.user_id =' => $user_id,
                'UserPoint.delete_flg =' => 0,
            ])
            ->where(['date >=' => $startTime, 'date <=' => $endTime])
            ->contain('User')
            ->contain('Fortunes');
        return $data;
    }
}
