<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserFortuneCommentTable Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Fortunes
 *
 * @method \App\Model\Entity\UserFortuneComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserFortuneComment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserFortuneComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserFortuneComment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserFortuneComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserFortuneComment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserFortuneComment findOrCreate($search, callable $callback = null)
 */
class UserFortuneCommentTable extends Table
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

        $this->table('brm_user_fortune_comment');
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

        $this->hasOne('UserFortuneFavorite', [
            'foreignKey' => 'fortune_id'
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
            ->requirePresence('comment_content', 'create')
            ->notEmpty('comment_content');

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
        $rules->add($rules->existsIn(['fortune_id'], 'Fortunes'));

        return $rules;
    }

    /**
     * @param null $user_id
     * @return $this
     */
    public function findUserComments()
    {
        try {
            $data = $this->find('all')
                ->select([
                    'comment_content','Fortunes.avatar','UserFortuneComment.date_created',
                    'Fortunes.id','User.full_name',
                    'Fortunes.id','User.birthday',
                ])
                ->contain(['User','Fortunes'])
                ->where(['UserFortuneComment.delete_flg =' => 0]);
            return $data;
        } catch (PDOException $e) {
            $this->log("Error Query", 'error');
        }
    }

    /**
     * @param $startTime
     * @param $endTime
     * @return $this
     */
    public function findUserPointSearch($startTime, $endTime){
        $data = $this->find('all')
            ->where(['date >=' => $startTime, 'date <=' => $endTime])
            ->select(['Fortunes.name'])
            ->hydrate(false)
            //->where(['user_id' => $user_id])
            ->where(['UserPoint.delete_flg' => 0])
            ->contain('Fortunes');

        return $data;
    }

    /**
     * [getCommentByFortune description]
     * @param  [type] $id_fortune [description]
     * @return [type]             [description]
     */
    public function getCommentByFortune($id_fortune)
    {
        $fortuneComment = TableRegistry::get('UserFortuneComments');
        $query = $fortuneComment->find()
                                ->where(['fortune_id' => $id_fortune])
                                ->contain(['User']);
        return $query;
    }
    /**
     * Get count Comments
     * @param $fortune_id
     * @return bool
     */
    public function countComments($fortune_id = null){
        $data = $this->find('all');
        $data->select([
            'count' => $data->func()->count('*')
        ])
            ->where(['fortune_id' => $fortune_id]);

        if(!empty($data)) {
            foreach ($data as $row) {
                return $row->count;
            }
        }
        else {
            return false;
        }
    }

    public  function  getCommentsByFortuneId($id){

        $data  = $this->find('all')
            ->where(['fortune_id' => $id])
            ->contain(['User'])
            ->toArray();
        if(!empty($data)){
            return $data;
        }else {
            return null;
        }
    }

    /**
     * create fortune ranking data by comment for the Ranking Shell
     * @return $this
     */
    public function findFortuneRankingDataByComment() {

        $query = $this->find();
        $query->select(['fortune_id'])
            ->select([
                'total_comments' => $query->func()->count('*')
            ])
            ->where(['delete_flg' => 0])
            ->group(['fortune_id'])
            ->order(['total_comments' => 'DESC'])
            ->limit(3);
        return $query;
    }
}
