<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BrmFortuneExpertInfo Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Fortunes
 * @property \Cake\ORM\Association\BelongsTo $Experts
 *
 * @method \App\Model\Entity\BrmFortuneExpertInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\BrmFortuneExpertInfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BrmFortuneExpertInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BrmFortuneExpertInfo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BrmFortuneExpertInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BrmFortuneExpertInfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BrmFortuneExpertInfo findOrCreate($search, callable $callback = null)
 */
class FortuneExpertInforsTable extends Table
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

        $this->table('brm_fortune_expert_info');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Fortunes', [
            'foreignKey' => 'fortune_id',
//            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ExpertInfors', [
            'foreignKey' => 'expert_id',
//            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['fortune_id'], 'Fortunes'));
        $rules->add($rules->existsIn(['expert_id'], 'Experts'));

        return $rules;
    }

    public  function getTagsByFortune($id){

        $data = $this->find()
            ->select(['ExpertInfors.expert_name'])
            ->where(['fortune_id =' => $id])
            ->contain(['ExpertInfors'])
            ->toArray();
        if($data) {
            return $data;
        }
        return null;
    }
}
