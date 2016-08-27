<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserLevelTypeTable Model
 *
 * @method \App\Model\Entity\UserLevelType get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserLevelType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserLevelType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserLevelType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserLevelType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserLevelType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserLevelType findOrCreate($search, callable $callback = null)
 */
class UserLevelTypeTable extends Table
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

        $this->table('brm_user_level_type');
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
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->integer('coin_start')
            ->requirePresence('coin_start', 'create')
            ->notEmpty('coin_start');

        $validator
            ->integer('coin_end')
            ->requirePresence('coin_end', 'create')
            ->notEmpty('coin_end');

        $validator
            ->integer('coin_bonus')
            ->requirePresence('coin_bonus', 'create')
            ->notEmpty('coin_bonus');

        $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image');

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
     * @return $this
     */
    public function listType()
    {
        $data = $this->find('all')
            ->select(['name', 'description', 'image'])
            ->where([
                'UserLevelType.delete_flg =' => 0,
            ]);
        return $data;
    }
}
