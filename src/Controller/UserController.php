<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use CsvCombine\Form\CsvImportForm;
use App\Model\Entity\UserReview;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

class UserController extends AppController
{
    protected $tableUserSchedules;

    /**
     * UserController constructor.
     * @param null $request
     * @param null $response
     */
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

        $this->tableUserSchedules = $this->loadModel('UserSchedules');
        $this->loadComponent('Captcha', ['field'=>'securitycode']);
        $this->loadComponent('DateTime');
        $this->loadComponent('CsvCombine.CsvExport');
        $this->loadComponent('Mail');
        $this->loadComponent('Check');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'loginAction' => [
                'controller' => 'User',
                'action' => 'login',
            ],
            'loginRedirect' => [
                'controller' => 'User',
                'action' => 'getListFortune'
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ],
                    'userModel'=>'User'
                ]
            ],
            'logoutRedirect' => [
                'controller' => 'User',
                'action' => 'index',
            ]
        ]);
    }
    /**
     * @return \Cake\Network\Response|null
     */
    public function login() {

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error('Username or password is incorrect');
            }
        }
    }

    /** 
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /*Function Get FortuneDetail
    * Chauttn@bap.jp
    */
    public function FortuneDetail($id = null){

        $fortuneMd    = $this->loadModel('Fortunes');
        $historyMd    = $this->loadModel('FortuneExecuteHistorys');
        $comment      = $this->loadModel('UserFortuneComment');
        $profile      = $this->loadModel('FortuneProfile');
        $blogModel    = $this->loadModel('FortuneBlog');
        $fortuneFreec = $this->loadModel('FortuneFree');

        $fortune                 = $fortuneMd->get($id);
        $fortune->count_history  = $historyMd->countHistory($id);
        $fortune->count_comments = $comment->countComments($id);
        $fortuneExtract          = $profile->getFortuneExtractById($id);
        $comments                = $comment->getCommentsByFortuneId($id);
        $blogs                   = $blogModel->getListBlog($id);
        $blogUrlRoot             = $profile->getUrl($id);

        // menu 1
        $this->loadModel('ScheduleTime');
        $times        = $this->ScheduleTime->getListTime();
        $seventDaynow = $this->DateTime->getSeventDayFromNowday();

        // menu 2
        $timeEstimates = $this->ScheduleTime->listScheduleTime();
        $allDayInWeek  = $this->DateTime->allDayInWeek();

        // menu 4
        $fortuneFree   = $fortuneFreec->getFortuneFree($id);

        $this->set(compact('fortune','fortuneExtract','comments', 'blogs', 'blogUrlRoot', 'times','seventDaynow', 'timeEstimates', 'allDayInWeek', 'id', 'fortuneFree'));
    }

    /**
     * [captcha description]
     * @return [type] [description]
     */
    public function captcha(){
        $this->autoRender = false;
        $this->Captcha->create();
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('users', $this->paginate($this->User));
        $this->set('_serialize', ['users']);
    }

    /**
     * [view description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function view($id = null)
    {
        $user = $this->User->get($id);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * [beforeFilter description]
     * @param  Event  $event [description]
     * @return [type]        [description]
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['getListFortune','logout','login']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->User->newEntity();

        $tableMQuestion = $this->loadModel('MQuestion');
        $mquestions = $tableMQuestion->listMasterQuestion();

        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->User->setCaptcha('securitycode', $this->Captcha->getCode('securitycode'));
            $user = $this->User->patchEntity($user, $this->request->data);

            if($this->checkIsExistEmail($user->mail_address)) {
                if ($this->User->save($user)) {

                    $userMail = $this->User->getByEmail($this->request->data['mail_address']);

                    $this->Mail->sendUserEmail($userMail->mail_address, 'User Confirmation Email', $userMail->api_key_plain);

                    $this->Flash->success(__('The user has been created.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    // if not save, will show errors
                    debug($user->errors());
                    $this->Flash->error(__('The user could not be created. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('User Email had been register in the database. Please choose another email.'));
            }
        }

        $this->set(compact('mquestions'));
        $this->set('_serialize', ['$mquestions']);

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->User->get($id);

        $tableMQuestion = $this->loadModel('MQuestion');
        $mquestions = $tableMQuestion->listMasterQuestion();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->User->patchEntity($user, $this->request->data);
            if ($this->User->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('mquestions'));
        $this->set('_serialize', ['$mquestions']);

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        if ($this->User->deleteById($id)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * show user schedule method
     *
     * @return void.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function schedule()
    {
        $tableUserSchedules = $this->loadModel('UserSchedules');
        $listSchedule = $tableUserSchedules->findUserSchedules($this->Auth->user('id'));

        $days = $this->DateTime->allDayInWeek();

        $this->set([
            'days'         => $days,
            'listSchedule' => $listSchedule
         ]);
    }

    /**
     * show all favorite fortunes of a user
     *
     * @return void.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function favorite()
    {
        $tableUserFortuneFavorite = $this->loadModel('UserFortuneFavorite');
        $listFavoriteFortunes = $tableUserFortuneFavorite->findUserFortuneFavorite($this->Auth->user('id'));

        $this->set(array(
            'listFavoriteFortunes' => $listFavoriteFortunes
        ));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fortune id.
     * @return void Redirects to favorite.
     */
    public function deleteFavoriteFortune($id = null)
    {
        $tableUserFortuneFavorite = $this->loadModel('UserFortuneFavorite');
        if ($tableUserFortuneFavorite->deleteFavoriteFortuneById($id)) {
            $this->Flash->success(__('The Favorite Fortune has been deleted.'));
        } else {
            $this->Flash->error(__('The Favorite Fortune could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'favorite']);
    }

    /**
     * show all user favorite fortune schedules method
     *
     * @return void.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function favoriteSchedule()
    {
        $tableTime  = $this->loadModel('ScheduleTime');
        $times      = $tableTime->listScheduleTime();

        $days       = $this->DateTime->allDayInWeek();
        $weekDays   = $this->DateTime->weekDays;
        $result     = array();

        for($i = 0; $i < count($days) ; $i++) {
            $result[$i]['day']  = $weekDays['day_'.$i];
            $result[$i]['data'] = $this->getDataFavoriteFortuneScheduleByDate($days[$i]);
        }

        $this->set([
            'times'              => $times,
            'listScheduleInWeek' => $result,
        ]);
    }

    /**
     * @param null $day
     * @return mixed
     */
    public function getDataFavoriteFortuneScheduleByDate($day = null)
    {
        return $this->tableUserSchedules->findUserFavoriteFortuneSchedule($this->Auth->user('id'), $day);
    }

    public function isAuthorized($user)
    {
        // All people users can add new user
        if ($this->request->action === 'add') {
            return true;
        }

        // The owner of user can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {
        $userId = (int)$this->request->params['pass'][0];
            if ($user['id'] == $userId) {
                return true;
            }
            else {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Export method
     *
     * @return mixed
     */
    public function export()
    {
        $usersExport = $this->User->find('all')->toArray();

        $header = array (
            'username',
            'mail_address',
            'telephone',
        );

        $i = 0;
        foreach ($usersExport as $key => $item) {
            $array_user [$i][$header[0]] = $item->username;
            $array_user [$i][$header[1]] = $item->mail_address;
            $array_user [$i][$header[2]] = $item->telephone;
            $i++;
        }

        /*
         *@array $list 出力のための配列(二次元配列が基本)
         *@param $file_name 出力ファイル名(デフォルトはexport.csv)
         *@param $delimiter 区切り文字の設定(デフォルトは",")
         *@param $directory 一時保存ディレクトリ(デフォルトはTMP,最終的にファイルを削除をする)
         *@param $export_encoding 出力するファイルのエンコード(デフォルトはSJIS-win
         *@param $array_encoding 入力する配列のエンコード(デフォルトはUTF-8
        */
        return $this->CsvExport->export($this->makeHeader($header, $array_user), 'export'.rand(0,99).'.csv');
    }

    /**
     * Import method
     *
     * @return exit
     */
    public function import()
    {
        $import = new CsvImportForm();
        //defaut in C:\xampp\htdocs\buramoPro\tmp
        $file = TMP . 'test.csv';
        $header = [
            'username',
            'mail_address',
            'telephone',
        ];
        /*
         *@array file ファイルパス(必須
         *@array $column カラム名を並び順に(必須
         *@param $delimiter 区切り文字を設定 (デフォルトは","で"\t"や"|"などを指定することが可能)
         *@param $array_encoding 出力する配列のエンコード(デフォルトはUTF-8
         *@param $import_encoding 入力するファイルのエンコード(デフォルトはSJIS-win
        */
        $result = $import->loadDataCsv($file,$header);
        debug($result);
        exit;
    }

    /**
     * makeHeader method
     * @param null $header .
     * @param null $data .
     * @return an array with the header
     */
    public function makeHeader($header = null, $data = null)
    {
        $tmp = array(
        [
            0 => $header[0],
            1 => $header[1],
            2 => $header[2]
        ]);

        $data = array_merge($tmp, $data);
        return $data;
    }

    /**
     * Check Exist Email method
     *
     * @param string|null $email Fortune Email email.
     * @return true if exist email
     */
    public function checkIsExistEmail($email = null)
    {
        $results = $this->User
            ->find()
            ->where(['mail_address =' => $email])
            ->toArray();
        if(isset($results)) return true;
        return false;
    }

    /**
     *  get list fortune medthod
     */
    public function getListFortune()
    {

        /*Load module*/
        $model = $this->loadModel('Fortunes');
        $user_id = $this->Auth->user('id');
        $fortune =$model->getListFortune($user_id,'UserFortuneFavorite');
        if(!empty($fortune)) {

            $this->set(compact('fortune','user_id'));
        } else {
            $this->Flash->error(__('The data null'));
        }
    }

    /**
     * get comment fortune method
     * @return \Cake\Network\Response|null
     */
    public function commentFortune()
    {
        $id_fortune = $this->request['pass'][0];
        $tmp = array();

        if (!isset($id_fortune) || !is_numeric($id_fortune)) {
            return $this->redirect(['action' => 'getListFortune']);
        }else {
            //
            $fortune     = $this->commentRepo->getDataFortune($id_fortune);
            $listComment = $this->commentRepo->getListComment($id_fortune);
            if ($fortune != null && $listComment != null) {
                $this->set([
                    'listComment' => $listComment,
                    'fortune' => $fortune
                ]);
            } else
                $this->Flash->error(__('The data is empty'));
        }

        if ($this->request->is(['patch', 'post', 'put']))
        {
            /* get id user */
            $idUser         = $this->Auth->user('id');
            $data           = $this->request->data;
            $content        = $data['comment_content'];
            $tmp['user_id'] = $idUser;
            $tmp['fortune_id'] = $id_fortune;
            $tmp['comment_content'] = $content;

            /** save into brm_fortune_user_comment */
            if ( $this->commentRepo->insert($tmp) )
            {
                return $this->redirect(['action' => 'commentFortune', $id_fortune]);
            } else
            {
                $this->Flash->error(__('The data not save, fail'));
            }
        }
    }

    /**
     * get user point method
     */
    public function point()
    {
        $months = $this->DateTime->getLast12Month();

        if ($this->request->is(['patch', 'post', 'put'])) {
                $startTime      = date('Y-m-d', strtotime($this->request->data('startTime')));
                $endTime        = date('Y-m-d', strtotime($this->request->data('endTime')));
                $tablePoint     = $this->loadModel('UserPoint');
                $data           = $tablePoint->findUserPointSearch($startTime, $endTime);
        } else {
            $tablePoint = $this->loadModel('UserPoint');
            $data = $tablePoint->findUserPoint($this->Auth->user('id'));
        }
        $this->set([
            'UserPoints'              => $data,
            'Months'                  => $months,
        ]);
    }

    /**
     * show all user review fortune information
     *
     * @return void.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function comment()
    {
        //Nghien cuu ap dung cho slacks 2.
       /* $categories = TableRegistry::get('Categories');
        $categories->recover();
        $descendants = $categories->find('children', ['for' => 1])->find('threaded');

        foreach ($descendants as $category) {
            dump($category);

        }*/

       /* $key = Security::hash('Fortune', 'sha1', 'login-salt');
        $key2 = Security::hash('FortuneDFF', 'sha1', 'login-salt2');
        $cipher = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
        $result = Security::encrypt($cipher, $key);
        $check = Security::decrypt($result, $key2);
        dump($check);*/
        $tableComment = $this->loadModel('UserFortuneComment');
        $listComments = $tableComment->findUserComments();
        $this->set(['listComments' => $this->paginate($listComments)]);
    }

    /**
     * [coin description]
     */
    public function coin()
    {
        $table = $this->loadModel('UserCoinPayment');
        $listCoins = $table->findUserCoin($this->Auth->user('id'));
        $this->set(['listCoins' => $listCoins,]);
    }

    /**
     * [level description]
     * @return [type] [description]
     */
    public function level()
    {
        $tableType = $this->loadModel('UserLevelType');
        $tableLevel  = $this->loadModel('UserLevelMap');

        $listTypes = $tableType->listType();
        $userLevel = $tableLevel->findUserLevel($this->Auth->user('id'));

        $this->set([
            'listType'              => $listTypes,
            'userLevel'              => $userLevel,
        ]);
    }

    /**
     * show all fortune schedules method
     *
     * @return void.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function fortuneSchedule()
    {
        $tableTime  = $this->loadModel('ScheduleTime');
        $times      = $tableTime->getListTime();

        $days       = $this->DateTime->get8DayAfterToday();
        $weekDays   = $this->DateTime->weekDays;

        $result     = array();

        for($i = 0; $i < count($days) ; $i++) {
            $result[$i]['day']  = $days[$i];
            $result[$i]['data'] = $this->getDataFortuneScheduleByDate($days[$i]);
        }

        $this->set([
            'times'              => $times,
            'listSchedule'       => $result,
        ]);
    }

    /**
     * @param null $day
     * @return mixed
     */
    public function getDataFortuneScheduleByDate($day = null)
    {
        return $this->tableUserSchedules->findFortuneSchedule($day);
    }

    /**
     * show all fortune schedules method
     *
     * @return void.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function fortuneExpectedSchedule()
    {
        $tableTime  = $this->loadModel('ScheduleTime');
        $times      = $tableTime->listScheduleTime();

        $days       = $this->DateTime->allDayInWeek();
        $weekDays   = $this->DateTime->weekDays;
        $result     = array();

        for($i = 0; $i < count($days) ; $i++) {
            $result[$i]['day']  = $weekDays['day_'.$i];
            $result[$i]['data'] = $this->getDataFortuneExpectedScheduleByDate($days[$i]);
        }

        $this->set([
            'times'              => $times,
            'listScheduleInWeek' => $result,
        ]);
    }

    /**
     * @param null $day
     * @return mixed
     */
    public function getDataFortuneExpectedScheduleByDate($day = null)
    {
        return $this->tableUserSchedules->findFortuneExpectedSchedule($day);
    }
}
