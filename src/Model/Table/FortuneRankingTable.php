<?php
namespace App\Model\Table;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FortuneRanking Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Fortunes
 *
 * @method \App\Model\Entity\FortuneRanking get($primaryKey, $options = [])
 * @method \App\Model\Entity\FortuneRanking newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FortuneRanking[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FortuneRanking|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FortuneRanking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FortuneRanking[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FortuneRanking findOrCreate($search, callable $callback = null)
 */
class FortuneRankingTable extends Table
{

    const KIND_WEEK     = 'week';
    const KIND_MONTH    = 'month';
    const KIND_PHONE    = 'phone';
    const KIND_MESSAGE  = 'message';
    const KIND_COMMENT  = 'comment';
    const KIND_LATEST   = 'latest';
    const KIND_YEAR     = 'year';

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('brm_fortune_ranking');
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
            ->integer('rank')
            ->requirePresence('rank', 'create')
            ->notEmpty('rank');

        $validator
            ->integer('rank_kind')
            ->requirePresence('rank_kind', 'create')
            ->notEmpty('rank_kind');

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
     * @param $rank_type
     */
    public function deteteFortuneRankingData($rank_type)
    {
        switch ($rank_type) {
            case self::KIND_WEEK:
                $query = $this->query();
                $query->update()
                    ->set(['delete_flg' => 1])
                    ->where(['fortune_kind_name' => $rank_type])
                    ->execute();
                break;
            case self::KIND_MONTH:
                $query = $this->query();
                $query->update()
                    ->set(['delete_flg' => 1])
                    ->where(['fortune_kind_name' => $rank_type])
                    ->execute();
                break;
            case self::KIND_PHONE:
                $query = $this->query();
                $query->update()
                    ->set(['delete_flg' => 1])
                    ->where(['fortune_kind_name' => $rank_type])
                    ->execute();
                break;
            case self::KIND_MESSAGE:
                $query = $this->query();
                $query->update()
                    ->set(['delete_flg' => 1])
                    ->where(['fortune_kind_name' => $rank_type])
                    ->execute();
                break;
            case self::KIND_COMMENT:
                $query = $this->query();
                $query->update()
                    ->set(['delete_flg' => 1])
                    ->where(['fortune_kind_name' => $rank_type])
                    ->execute();
                break;
            case self::KIND_LATEST:
                $query = $this->query();
                $query->update()
                    ->set(['delete_flg' => 1])
                    ->where(['fortune_kind_name' => $rank_type])
                    ->execute();
                break;
            case self::KIND_YEAR:
                $query = $this->query();
                $query->update()
                    ->set(['delete_flg' => 1])
                    ->where(['fortune_kind_name' => $rank_type])
                    ->execute();
                break;
            default:
                echo "Your rank type is not support!";
        }
    }

    /**
    * get all best fortunes in this week
    * @return $this
    */
    public function findBestFortuneInWeek() {
        $query = $this->find();
        $query->select(['fortune_id'
            ,'rank'
            ,'fortunes.name'
            ,'fortunes.price'
            ,'fortunes.price'
            ,'fortunes.avatar'
            ,'fortunes.start_time'
            ,'fortunes.experience_history'])
            ->where(['fortune_kind_name' => self::KIND_WEEK])
            ->where(['FortuneRanking.delete_flg' => 0])
            ->contain(['Fortunes'])
            ->group(['fortune_id'])
            ->order(['rank' => 'asc']);
        return $query;
    }

    /**
     * get all best fortunes in this month
     * @return $this
     */
    public function findBestFortuneInMonth() {
        $query = $this->find();
        $query->select(['fortune_id'
            ,'rank'
            ,'fortunes.name'
            ,'fortunes.price'
            ,'fortunes.price'
            ,'fortunes.avatar'
            ,'fortunes.start_time'
            ,'fortunes.experience_history'])
            ->where(['fortune_kind_name' => self::KIND_MONTH])
            ->where(['FortuneRanking.delete_flg' => 0])
            ->contain(['Fortunes'])
            ->group(['fortune_id'])
            ->order(['rank' => 'asc']);
        return $query;
    }

    /**
     * get all best fortunes in this year
     * @return $this
     */
    public function findBestFortuneInYear() {
        $query = $this->find();
        $query->select(['fortune_id'
            ,'rank'
            ,'fortunes.name'
            ,'fortunes.price'
            ,'fortunes.price'
            ,'fortunes.avatar'
            ,'fortunes.start_time'
            ,'fortunes.experience_history'])
            ->where(['fortune_kind_name' => self::KIND_YEAR])
            ->where(['FortuneRanking.delete_flg' => 0])
            ->contain(['Fortunes'])
            ->group(['fortune_id'])
            ->order(['rank' => 'asc']);
        return $query;
    }

    /**
     * get 3 best fortunes have the most phone
     * @return $this
     */
    public function findBestFortuneByPhone() {
        $query = $this->find();
        $query->select(['fortune_id'
            ,'rank'
            ,'fortunes.name'
            ,'fortunes.price'
            ,'fortunes.price'
            ,'fortunes.avatar'
            ,'fortunes.start_time'
            ,'fortunes.experience_history'])
            ->where(['fortune_kind_name' => self::KIND_PHONE])
            ->where(['FortuneRanking.delete_flg' => 0])
            ->contain(['Fortunes'])
            ->group(['fortune_id'])
            ->order(['rank' => 'asc']);
        return $query;
    }

    /**
     * get 3 best fortunes have the most messages
     * @return $this
     */
    public function findBestFortuneByMessage() {
        $query = $this->find();
        $query->select(['fortune_id'
            ,'rank'
            ,'fortunes.name'
            ,'fortunes.price'
            ,'fortunes.price'
            ,'fortunes.avatar'
            ,'fortunes.start_time'
            ,'fortunes.experience_history'])
            ->where(['fortune_kind_name' => self::KIND_MESSAGE])
            ->where(['FortuneRanking.delete_flg' => 0])
            ->contain(['Fortunes'])
            ->group(['fortune_id'])
            ->order(['rank' => 'asc']);
        return $query;
    }

    /**
     * get 3 best fortunes have the most comment
     * @return $this
     */
    public function findBestFortuneByComment() {
        $query = $this->find();
        $query->select(['fortune_id'
            ,'rank'
            ,'fortunes.name'
            ,'fortunes.price'
            ,'fortunes.price'
            ,'fortunes.avatar'
            ,'fortunes.start_time'
            ,'fortunes.experience_history'])
            ->where(['fortune_kind_name' => self::KIND_COMMENT])
            ->where(['FortuneRanking.delete_flg' => 0])
            ->contain(['Fortunes'])
            ->group(['fortune_id'])
            ->order(['rank' => 'asc']);
        return $query;
    }

    /**
     * get 3 newest fortunes
     * @return $this
     */
    public function findNewestFortune() {
        $query = $this->find();
        $query->select(['fortune_id'
            ,'rank'
            ,'fortunes.name'
            ,'fortunes.price'
            ,'fortunes.price'
            ,'fortunes.avatar'
            ,'fortunes.start_time'
            ,'fortunes.experience_history'])
            ->where(['fortune_kind_name' => self::KIND_LATEST])
            ->where(['FortuneRanking.delete_flg' => 0])
            ->contain(['Fortunes'])
            ->group(['fortune_id'])
            ->order(['rank' => 'asc']);
        return $query;
    }
}
