<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserCoinPayment Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Transactions
 *
 * @method \App\Model\Entity\UserCoinPayment get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserCoinPayment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserCoinPayment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserCoinPayment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserCoinPayment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserCoinPayment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserCoinPayment findOrCreate($search, callable $callback = null)
 */
class UserCoinPaymentTable extends Table
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

        $this->table('brm_user_coin_payment');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Transactions', [
            'foreignKey' => 'transaction_id',
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
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->integer('coin')
            ->requirePresence('coin', 'create')
            ->notEmpty('coin');

        $validator
            ->requirePresence('transaction_type', 'create')
            ->notEmpty('transaction_type');

        $validator
            ->integer('coin_type')
            ->requirePresence('coin_type', 'create')
            ->notEmpty('coin_type');

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
        $rules->add($rules->existsIn(['transaction_id'], 'Transactions'));

        return $rules;
    }

    public function findUserCoin($user_id = null)
    {
        $data = $this->find('all')
                        ->select(['date_created', 'amount'])
                        ->contain('User')
                        ->where([
                            //'UserCoinPayment.user_id =' => $user_id,
                            'UserCoinPayment.status =' => 1,
                            'UserCoinPayment.delete_flg =' => 0,
                        ]);
        return $data->toArray();
    }
}
