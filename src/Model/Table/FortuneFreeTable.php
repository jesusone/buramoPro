<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BrmUserFortuneFree Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Fortunes
 *
 * @method \App\Model\Entity\BrmUserFortuneFree get($primaryKey, $options = [])
 * @method \App\Model\Entity\BrmUserFortuneFree newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneFree[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneFree|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BrmUserFortuneFree patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneFree[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneFree findOrCreate($search, callable $callback = null)
 */
class FortuneFreeTable extends Table
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

        $this->table('brm_user_fortune_freec');
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
            ->requirePresence('job', 'create')
            ->notEmpty('job');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

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
     * [getListFreecByFortuneId description]
     * @param  [int] $fortune_id  [description]
     * @param  [type] $contain    [description]
     * @param  [type] $id         [description]
     * @return [type]             [description]
     */
    public  function getListFreecByFortuneId($fortune_id = null,$contain = null,$id = null)
    {
        $query = $this->find()
            ->where(['fortune_id =' => $fortune_id,'FortuneFree.id !=' => $id])
            ->contain($contain['contain'])
            ->toArray();
            return $query;
    }

    /** 
     * [getFortuneFreec description]
     * @param  [int] $id  [description]
     * @return [type]     [description]
     */
    public function getFortuneFree($id = null)
    {
        $query = $this->find()
                      ->where(['fortune_id' => $id]);
        return $query;
    }
}
