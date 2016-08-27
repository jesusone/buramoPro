<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * BrmFortuneBlog Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Fortunes
 *
 * @method \App\Model\Entity\BrmFortuneBlog get($primaryKey, $options = [])
 * @method \App\Model\Entity\BrmFortuneBlog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BrmFortuneBlog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BrmFortuneBlog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BrmFortuneBlog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BrmFortuneBlog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BrmFortuneBlog findOrCreate($search, callable $callback = null)
 */
class FortuneBlogTable extends Table
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

        $this->table('brm_fortune_blog');
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
            ->integer('blog_header')
            ->requirePresence('blog_header', 'create')
            ->notEmpty('blog_header');

        $validator
            ->integer('blog_url')
            ->requirePresence('blog_url', 'create')
            ->notEmpty('blog_url');

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
     * [updateBlog description]
     * @param  [array] $data [description]
     * @return [boolean]     [description]
     */
    public function updateBlog($data)
    {
        $fortuneBlog = TableRegistry::get('FortuneBlog');
        $query       = $fortuneBlog->query();
        $query->update()
                ->set([
                        'blog_header' => $data['blog_header'],
                        'blog_url'  => $data['blog_url']
                    ])
                ->where(['id' => $data['id_blog']])
                ->execute();
        if ($query) {
            return true;
        }
        return false;
    }

    /** 
     * [delBlog description]
     * @param  [int] $id [description]
     * @return [boolean] [description]
     */
    public function delBlog($id)
    {
        $fortuneBlog = TableRegistry::get('FortuneBlog');
        $query       = $fortuneBlog->query();
        $query->delete()
              ->where(['id' => $id])
              ->execute();
        if ($query) {
            return true;
        }
        return false;
    }

    /** 
     * [getListBlog description]
     * @param  [int] $id_fortune [description]
     * @return [array][description]
     */
    public function getListBlog($id_fortune)
    {
        $fortuneBlog = TableRegistry::get('FortuneBlog');
        $query = $fortuneBlog->find('all')
                             ->where(['fortune_id =' => $id_fortune]);
        return $query;
    }

    /** 
     * [saveBlog description]
     * @param  [array] $data [description]
     * @return [true/false]       [description]
     */
    public function saveBlog($data, $id_fortune)
    {
        $fortuneBlog = TableRegistry::get('FortuneBlog');
        $query       = $fortuneBlog->query();
        $query  ->insert(['fortune_id', 'blog_header', 'blog_url'])
                ->values([
                    'fortune_id'  => $id_fortune,
                    'blog_header' => $data['blog_header'],
                    'blog_url'    => $data['blog_url']
                ])
                ->execute();
        if ($query) {
            return true;
        }
        return false;
    }

    /** 
     * [getBlogById description]
     * @param  [int] $id_blog [description]
     * @return [array]        [description]
     */
    public function getBlogById($id_blog)
    {
        $fortuneBlog = TableRegistry::get('FortuneBlog');
        $query       = $fortuneBlog->findById($id_blog)
                                   ->first();
        return $query;
    }
}
