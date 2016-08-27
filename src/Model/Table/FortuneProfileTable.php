<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BrmFortuneProfile Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Fortunes
 *
 * @method \App\Model\Entity\BrmFortuneProfile get($primaryKey, $options = [])
 * @method \App\Model\Entity\BrmFortuneProfile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BrmFortuneProfile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BrmFortuneProfile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BrmFortuneProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BrmFortuneProfile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BrmFortuneProfile findOrCreate($search, callable $callback = null)
 */
class FortuneProfileTable extends Table
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

        $this->table('brm_fortune_profile');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->requirePresence('news_from_teacher', 'create')
            ->notEmpty('news_from_teacher');

        $validator
            ->requirePresence('message_to_everyone', 'create')
            ->notEmpty('message_to_everyone');

        $validator
            ->requirePresence('consultation_content', 'create')
            ->notEmpty('consultation_content');

        $validator
            ->requirePresence('good_at_consultation', 'create')
            ->notEmpty('good_at_consultation');

        $validator
            ->requirePresence('fortune_telling_style', 'create')
            ->notEmpty('fortune_telling_style');

        $validator
            ->requirePresence('spiritual_force', 'create')
            ->notEmpty('spiritual_force');

        $validator
            ->requirePresence('hobby', 'create')
            ->notEmpty('hobby');

        $validator
            ->boolean('delete_flg')
            ->allowEmpty('delete_flg');

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
        return $rules;
    }

    /** 
     * [getFortuneExtractById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public  function  getFortuneExtractById($id = null){
        $data  = $this->find('all')
            ->where(['fortune_id' => $id])
            ->first();
        if(!empty($data)){
            return $data;
        }else {
            return null;
        }
    }

    /** 
     * [addUrlRoot description]
     * @param [type] $id_fortune [description]
     * @param [type] $data       [description]
     */
    public function updateUrlRoot($id_fortune, $data)
    {
        $query = $this->query();
        $query->update()
            ->set([
                    'blog_header_root' => $data['blog_header_root'],
                    'blog_url_root'    => $data['blog_url_root'],
                ])
            ->where(['id' => $id_fortune])
            ->execute();
        if ($query) {
            return true;
        }
        return false;
    }

    /** 
     * [getUrl description]
     * @param  [int] $id  [description]
     * @return [void]     [description]
     */
    public function getUrl($id)
    {
        $query = $this->findById($id)
                      ->select(['blog_header_root', 'blog_url_root'])
                      ->first();
        return $query;
    }
}
