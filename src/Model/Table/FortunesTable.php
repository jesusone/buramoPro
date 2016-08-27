<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;
use Cake\Event\Event;

class FortunesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('brm_fortune_base');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('UserFortuneComment', [
            'foreignKey' => 'fortune_id',
            'dependent'  => true,
        ]);
        $this->hasMany('UserFortuneFavorite', [
            'foreignKey' => 'fortune_id',
            'dependent'  => true,
        ]);
        $this->hasMany('FortuneExpertInfors', [
            'foreignKey' => 'fortune_id',
            'dependent'  => true,
        ]);


        $this->hasMany('UserSchedules', [
            'foreignKey' => 'fortune_id',
            'dependent'  => true,
        ]);

        $this->belongsTo('BrmFortuneProfile', [
            'foreignKey' => 'fortune_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('UserFortuneFavorite', [
            'foreignKey' => 'fortune_id',
            'dependent'  => true,
        ]);

        $this->hasMany('FortuneExecuteHistorys', [
            'foreignKey' => 'fortune_id',
            'dependent'  => true,
        ]);

        $this->hasMany('UserFortuneMsg', [
            'foreignKey' => 'fortune_id',
            'dependent'  => true,
        ]);

		$this->addBehavior('Xety/Cake3Upload.Upload', [
		        'fields' => [
		            'avatar' => [
		                'path' => 'upload/avatar/:id/:md5',
		                'prefix' => '../'
		            ]
		        ]
		    ]
		);
    }

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'A username is required')
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
            ->add('avatar_file', 'file', [
                'rule' => ['mimeType', ['image/jpeg', 'image/png']],
                'message' => 'Please chose a valid photo *.image or *.png']);
    }
    /*Get list fortune*/
    public function getListFortune($user_id = null,$contain)
    {
        $data = $this->find('all')
                ->select(['username','id','avatar']);
        if(!empty($user_id)){
         //   $data->select
        }
        if($data != null)
        {
            $data = $data->toArray();
            return $data;
        }
        return null;
    }
    /*Find fortune*/
    public  function  searchFortune($data){
        $query = $this->find('all');
        if(!empty($data['keyword'])){
            $query->where(['name LIKE ' => '%'.$data['keyword'].'%']);
        }
        return $query->toArray();
    }


    /**
     * @return array
     */
    public function findFortuneRankingDataByLatest()
    {
        $data = $this->find();
        $data->select('id')
            ->where(['delete_flg' => 0])
            ->limit(3)
            ->order(['start_time' => 'DESC']);
        return $data;
    }

}
