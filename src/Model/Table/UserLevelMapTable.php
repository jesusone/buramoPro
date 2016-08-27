<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserLevelMap Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Levels
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserLevelMap get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserLevelMap newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserLevelMap[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserLevelMap|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserLevelMap patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserLevelMap[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserLevelMap findOrCreate($search, callable $callback = null)
 */
class UserLevelMapTable extends Table
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

        $this->table('brm_user_level_map');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('UserLevelType', [
            'foreignKey' => 'level_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
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
            ->boolean('delete_flg')
            ->requirePresence('delete_flg', 'create')
            ->notEmpty('delete_flg');

        $validator
            ->dateTime('date_created')
            ->requirePresence('date_created', 'create')
            ->notEmpty('date_created');

        $validator
            ->dateTime('date_updated')
            ->requirePresence('date_updated', 'create')
            ->notEmpty('date_updated');

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
        $rules->add($rules->existsIn(['level_id'], 'Levels'));
        $rules->add($rules->existsIn(['user_id'], 'User'));

        return $rules;
    }

    /**
     * @param null $user_id
     * @return array
     */
    public function findUserLevel($user_id = null)
    {
        $data = $this->find('all')
            ->select(['user.full_name'])
            ->contain('User')
            ->where([
                //'UserLevelMap.user_id =' => $user_id,
                'UserLevelMap.delete_flg =' => 0,
            ]);
        return $data;
    }
}
