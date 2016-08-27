<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\Utility\Text;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

/**
 * UserTable Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MQuestions
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 */
class UserTable extends Table
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

        $this->table('brm_user_base');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('MQuestion', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('UserFortuneComment', [
            'foreignKey' => 'user_id',
            'dependent' => true,
        ]);

        $this->hasMany('UserSchedules', [
            'foreignKey' => 'user_id',
            'dependent' => true,
        ]);

        $this->hasMany('FortuneExecuteHistorys', [
            'foreignKey' => 'user_id',
            'dependent' => true,
        ]);

        $this->hasMany('UserFortuneMsg', [
            'foreignKey' => 'user_id',
            'dependent' => true,
        ]);

        $this->hasMany('FortuneFree', [
            'foreignKey' => 'user_id',
            'dependent' => true,
        ]);

        $this->addBehavior('Captcha', [
            'field' => 'securitycode',
            'message' => 'Incorrect captcha code value'
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->allowEmpty('mail_address');

        $validator
            ->allowEmpty('telephone');

        $validator
            ->date('birthday')
            ->allowEmpty('birthday');

//        $validator
//            ->requirePresence('user_type', 'create')
//            ->notEmpty('user_type');

        $validator
            ->boolean('gender')
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

//        $validator
//            ->boolean('mail_maga')
//            ->requirePresence('mail_maga', 'create')
//            ->notEmpty('mail_maga');

        $validator
            ->allowEmpty('answer');

        $validator
            ->allowEmpty('post_code');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('kanji_name');

        $validator
            ->allowEmpty('kana_name');

        $validator
            ->allowEmpty('full_name');

        $validator
            ->allowEmpty('api_key_plain');

        $validator
            ->allowEmpty('api_key');

//        $validator
//            ->integer('user_coin')
//            ->requirePresence('user_coin', 'create')
//            ->notEmpty('user_coin');

//        $validator
//            ->boolean('delete_flg')
//            ->requirePresence('delete_flg', 'create')
//            ->notEmpty('delete_flg');

        $validator
            ->dateTime('date_created')
            ->allowEmpty('date_created');

        $validator
            ->dateTime('date_modified')
            ->allowEmpty('date_modified');

        $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('mail_address', 'A mail address is required')
            ->add('mail_address', 'inList', [
                'rule' => 'email',
                'message' => 'Please enter a valid email'])
            ->allowEmpty('telephone')
            ->add('telephone', 'inList', [
                'rule' => 'numeric',
                'message' => 'Please enter a valid telephone'])
            ->notEmpty('gender', 'A gender is required')
            ->add('gender', 'inList', [
                'rule' => ['inList', ['0', '1', '2']],
                'message' => 'Please enter a valid gender'])
            ->notEmpty('mail_maga', 'A mail maga is required')
            ->add('mail_maga', 'inList', [
                'rule' => ['inList', ['0', '1']],
                'message' => 'Please enter a valid mail maga'])
            ->add('current_password', 'custom', [
                'rule' => function ($value, $context) {
                    $user = $this->get($context['data']['id']);
                    if ($user) {
                        if ((new DefaultPasswordHasher)->check($value, $user->password)) {
                            return true;
                        }
                    }
                    return false;
                },
                'message' => 'The old password does not match the current database password!',
            ])
            ->notEmpty('current_password');

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
        $rules->add($rules->isUnique(['username']));
        return $rules;
    }

    /**
     * @param Event $event
     * @return bool
     */
    public function beforeSave(Event $event)
    {
        $entity = $event->data['entity'];

        if ($entity->isNew()) {
            $hasher = new DefaultPasswordHasher();

            // Generate an API 'token'
            $entity->api_key_plain = sha1(Text::uuid());

            // Bcrypt the token so BasicAuthenticate can check
            // it during login.
            $entity->api_key = $hasher->hash($entity->api_key_plain);
        }
        return true;
    }

    /**
     * get users by email.
     * @param null $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        return $this->find('first')
                ->where([
                'mail_address =' => $email
                ]);
    }
}
