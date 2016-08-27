<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;


/**
 * UserFortuneFavoriteTable Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $FortuneUsers
 *
 * @method \App\Model\Entity\UserFortuneFavorite get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserFortuneFavorite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserFortuneFavorite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserFortuneFavorite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserFortuneFavorite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserFortuneFavorite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserFortuneFavorite findOrCreate($search, callable $callback = null)
 */
class UserFortuneFavoriteTable extends Table
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

        $this->table('brm_user_fortune_favorite');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('User', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Fortunes', [
            'foreignKey' => 'fortune_id'
        ]);

        $this->hasOne('UserFortuneComment', [
            'foreignKey' => 'fortune_id'
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
        $rules->add($rules->existsIn(['fortune_id'], 'FortuneUsers'));

        return $rules;
    }

    /**
     * get all favorite fortunes information of the user
     * @param null $user_id
     * @return $this
     */
    public function findUserFortuneFavorite($user_id  = null) {

        $query = $this->find('all');
        $query->select(['fortunes.username'
                        ,'fortunes.name'
                        ,'fortunes.price'
                        ,'fortunes.avatar'
                        ,'fortunes.start_time'
                        ,'fortunes.experience_history'])
                        ->select(['total_comments' => $query->func()->count('UserFortuneComment.id')])
                        //->where(['user_id' => $user_id]);
                        ->where(['UserFortuneFavorite.delete_flg' => 0])
                        ->contain(['User','Fortunes','UserFortuneComment'])
                        ->group(['fortunes.id'])
                        ->autoFields(true);
        return $query;
    }
}
