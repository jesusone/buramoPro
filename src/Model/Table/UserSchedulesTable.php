<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserSchedulesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('brm_user_fortune_schedule');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Fortunes', [
            'foreignKey' => 'fortune_id',
        ]);

        $this->belongsTo('UserFortuneFavorite', [
            'foreignKey' => 'fortune_id',
        ]);

        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
        ]);

    }

    public function validationDefault(Validator $validator)
    {
        // return $validator
        //     ->notEmpty('username', 'A username is required')
        //     ->notEmpty('mail_address', 'A mail address is required')
        //     ->add('mail_address', 'inList', [
        //         'rule' => 'email',
        //         'message' => 'Please enter a valid email'])
        //     ->allowEmpty('telephone')
        //     ->add('telephone', 'inList', [
        //         'rule' => 'numeric',
        //         'message' => 'Please enter a valid telephone'])
        //     ->notEmpty('gender', 'A gender is required')
        //     ->add('gender', 'inList', [
        //         'rule' => ['inList', ['0', '1', '2']],
        //         'message' => 'Please enter a valid gender'])
        //     ->notEmpty('mail_maga', 'A mail maga is required')
        //     ->add('mail_maga', 'inList', [
        //         'rule' => ['inList', ['0', '1']],
        //         'message' => 'Please enter a valid mail maga']);
        return $validator
            ->notEmpty('fortune_user_name', 'A fortune name is required');
    }

    /**
     * get all favorite fortunes Schedules in the week of the user
     * @param null $user_id
     * @param null $date
     * @return $this
     */
    public function findUserFavoriteFortuneSchedule($user_id  = null, $date  = null) {

        $data = $this->find('all')
            ->select(['fortunes.id', 'fortunes.username'])
            //->where(['UserSchedules.user_id' => $user_id])
            //user not set schedule yet
            //->where(['UserSchedules.user_id' => 0])
            ->where(['UserSchedules.schedule_day' => $date])
            ->where(['UserSchedules.delete_flg' => 0])
            ->contain('Fortunes')
            ->contain('User')
            ->contain('UserFortuneFavorite')
            ->group(['Fortunes.id'])
            ->autoFields(true);

        return $data->toArray();
    }

    /**
     * get daily schedule information of the user and fortune
     * @param null $user_id
     * @return $this
     */
    public function findUserSchedules($user_id  = null) {
        return $this->find('all')
            //->where(['user_id' => $user_id]);
            ->where(['delete_flg' => 0])
            ->toArray();
    }

    /**
     * get all fortunes Schedules in 8 day from today
     * @param null $date
     * @return $this
     */
    public function findFortuneSchedule($date  = null) {

        $data = $this->find()
            ->select(['fortune_id', 'fortunes.username', 'UserSchedules.schedule_day'])
            ->where(['UserSchedules.schedule_day' => $date])
            //user not set schedule yet
            //->where(['UserSchedules.user_id' => 0])
            ->where(['UserSchedules.delete_flg' => 0])
            ->contain('Fortunes')
            ->group(['Fortunes.id']);
        return $data->toArray();
    }

    /**
     * get all fortunes Expected Schedules in the week
     * @param null $date
     * @return $this
     */
    public function findFortuneExpectedSchedule($date  = null) {

        $data = $this->find()
            ->select(['fortune_id', 'fortunes.username', 'UserSchedules.schedule_day'])
            ->where(['UserSchedules.schedule_day' => $date])
            ->where(['UserSchedules.delete_flg' => 0])
            ->contain('Fortunes')
            ->group(['Fortunes.id']);
        return $data->toArray();
    }
}
