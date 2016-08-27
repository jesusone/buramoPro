<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * BrmUserFortuneMsg Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $FortuneUsers
 *
 * @method \App\Model\Entity\BrmUserFortuneMsg get($primaryKey, $options = [])
 * @method \App\Model\Entity\BrmUserFortuneMsg newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneMsg[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneMsg|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BrmUserFortuneMsg patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneMsg[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BrmUserFortuneMsg findOrCreate($search, callable $callback = null)
 */
class UserFortuneMsgTable extends Table
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

        $this->table('brm_user_fortune_msg');
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

        $this->hasMany('UserFortuneMsgDetail', [
            'foreignKey' => 'msg_id',
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
            ->requirePresence('msg_header', 'create')
            ->notEmpty('msg_header');

        $validator
            ->requirePresence('msg_body', 'create')
            ->notEmpty('msg_body');

        $validator
            ->integer('delete_flg')
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

        $validator
            ->integer('is_views')
            ->requirePresence('is_views', 'create')
            ->notEmpty('is_views');

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
        $rules->add($rules->existsIn(['fortune_id'], 'FortuneUsers'));

        return $rules;
    }

    /** 
     * [getMessages description]
     * @param  [int] $id   [description]
     * @return [collection][description]
     */
    public function getMessages($id)
    {
        $fortuneMessages = TableRegistry::get('UserFortuneMsg');
        $query = $fortuneMessages->find()
                                 ->where(['fortune_id =' => $id])
                                 ->contain(['User', 'Fortunes']);
        return $query;
    }
}
