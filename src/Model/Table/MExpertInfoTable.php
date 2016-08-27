<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BrmMExpertInfo Model
 *
 * @method \App\Model\Entity\BrmMExpertInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\BrmMExpertInfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BrmMExpertInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BrmMExpertInfo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BrmMExpertInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BrmMExpertInfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BrmMExpertInfo findOrCreate($search, callable $callback = null)
 */
class MExpertInfoTable extends Table
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

        $this->table('brm_m_expert_info');
        $this->displayField('id');
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
            ->requirePresence('expert_name', 'create')
            ->notEmpty('expert_name');

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
}
