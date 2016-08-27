<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MQuestionTable Model
 *
 * @method \App\Model\Entity\MQuestionTable get($primaryKey, $options = [])
 * @method \App\Model\Entity\MQuestionTable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MQuestionTable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MQuestionTable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MQuestionTable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MQuestionTable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MQuestionTable findOrCreate($search, callable $callback = null)
 */
class MQuestionTable extends Table
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

        $this->table('brm_m_question');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('User', [
            'foreignKey' => 'question_id',
            'dependent' => true,
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
            ->requirePresence('question', 'create')
            ->notEmpty('question');

        $validator
            ->requirePresence('option1_answer', 'create')
            ->notEmpty('option1_answer');

        $validator
            ->requirePresence('option2_answer', 'create')
            ->notEmpty('option2_answer');

        $validator
            ->requirePresence('option3_answer', 'create')
            ->notEmpty('option3_answer');

        $validator
            ->boolean('delete_flg')
            ->requirePresence('delete_flg', 'create')
            ->notEmpty('delete_flg');

        $validator
            ->dateTime('date_created')
            ->allowEmpty('date_created');

        $validator
            ->dateTime('date_modified')
            ->allowEmpty('date_modified');

        return $validator;
    }

    /**
     * get all master question data.
     *
     */
    public function listMasterQuestion() {
        $queryData = $this->find('all')
            ->select('id', 'question')
            ->where(['delete_flg' => 0]);
        $mQuestions = null;
        foreach ($queryData as $key => $value) {
            $mQuestions[$key] = $value['id'];
            $mQuestions[$key] = $value['question'];
        }
        return $mQuestions;
    }
}
