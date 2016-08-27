<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class FortunesController extends AppController
{
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

            $this->loadComponent('DateTime');
            $this->loadComponent('Check');

    }

    /** 
     * [login description]
     * @return [void] [description]
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $fortune = $this->Auth->identify();
            if ($fortune) {
                $this->Auth->setUser($fortune);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Fortune username or Fortune password is incorrect'));
            }
        }
    }

    /** 
     * [rankingFortune description]
     * @return [type] [description]
     */
    public  function  rankingFortune()
    {
       $ranking =  $this->Fortunes->getRankingFortuneByWeekly();
    }

    /** 
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /** 
     * [initialize description]
     * @return [type] [description]
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Check');
        $this->loadModel('FortuneBlog');
        $this->loadModel('FortuneExecuteHistorys');
        $this->loadModel('UserFortuneMsg');
        $this->loadModel('ScheduleTime');
        $this->loadModel('UserFortuneSchedule');
        $this->loadComponent(


            'Auth', [
            'authorize' => ['Controller'],
            'loginAction' => [
                'controller' => 'Fortunes',
                'action' => 'login',
            ],
            'loginRedirect' => [
                'controller' => 'Fortunes',
                'action' => 'todaySchedule'
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ],
                    'userModel'=>'Fortunes'
                ]
            ],
            'logoutRedirect' => [
                'controller' => 'Fortunes',
                'action' => 'index',
            ]
        ]);
        $this->Auth->allow(['login','logout','findFortune']);
    }

    /** 
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $this->set('fortunes', $this->paginate($this->Fortunes));
        $this->set('_serialize', ['fortunes']);
    }

    /** 
     * [beforeFilter description]
     * @param  Event  $event [description]
     * @return [type]        [description]
     */
    public function beforeFilter(Event $event)
    {
        $this->viewBuilder()->layout('fortunes');
        parent::beforeFilter($event);

        $this->Auth->allow(['login', 'logout']);

        $user = $this->Auth->user();
        if(isset($user) && $user['role'] != 'fortune' && $this->request->param('action') != 'login' ) {
            $this->redirect('/fortune/login');
        }
    }

    /** 
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fortune = $this->Fortunes->get($id);
        if ($this->Fortunes->delete($fortune)) {
            $this->Flash->success(__('The fortune has been deleted.'));
        } else {
            $this->Flash->error(__('The fortune could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /** 
     * [searchFortune description]
     * @return [type] [description]
     */
    public function searchFortune()
    {
        $query = $this->Fortunes->find();
    }

    /**
     * Check Exist Email method
     *
     * @param string|null $email Fortune Email email.
     * @return true if exist email
     */
    public function checkIsExistEmail($email = null)
    {
        $results = $this->Fortunes
                        ->find()
                        ->where(['mail_address =' => $email])
                        ->toArray();
        if(isset($results)) return true;
        return false;
    }

    /**
     * [setSchedule description]
     * input: empty
     */
    public function setSchedule ()
    {
        $this->loadComponent('DateTime');
        $this->loadModel('ScheduleTime');
        $data         = $this->Auth->user();
        $id_fortune   = $data['id'];
        $days         = $this->DateTime->allDayInWeek();
        $months       = $this->DateTime->allDayInMonth();
        $times        = $this->ScheduleTime->getListTime();
        if ($this->Check->isId($id_fortune)) {
            $this->set([
                'times' => $times,
                'days'  => $months,
                'id'    => $id_fortune
            ]);
        } else{
            $this->Flash->error(__('Id not found'));
        }
    }

    /** 
     * [loadAjaxSettingSchedule description]
     * @return [type] [description]
     */
    public function setScheduleAjax()
    {
        $this->loadModel('UserFortuneSchedule');
        $id_fortune = $_POST['id'];
        $day        = $_POST['day'];
        $id_times   = $_POST['id_time'];
        $messages   = '';
        $isSaveSetSchedule = $this->UserFortuneSchedule->insertSchedule($id_fortune, $day, $id_times);
        if ( $isSaveSetSchedule ) {
            $messages .= 'success';
            die($messages);
        } else {
            $messages .= 'fail';
            die($messages);
        }
    }

    /**
     * [todaySchedule description]
     * @return [type] [description]
     */
    public function todaySchedule()
    {
        $this->loadComponent('DateTime');
        $this->loadModel('ScheduleTime');
        $data         = $this->Auth->user();
        $id_fortune   = $data['id'];
        $days         = $this->DateTime->allDayInWeek();
        $months       = $this->DateTime->allDayInMonth();
        $times        = $this->ScheduleTime->getListTime();
        if ($this->Check->isId($id_fortune)) {
            $this->set([
                'times' => $times,
                'days'  => $months,
                'id'    => $id_fortune
            ]);
        } else{
            $this->Flash->error(__('Id not found'));
        }
    }

    /** 
     * [inforUserScheduleAjax description]
     * @return [void] [description]
     */
    public function inforUserScheduleAjax()
    {
        $this->loadModel('UserFortuneSchedule');
        $id_fortune = $_POST['id'];
        $day        = $_POST['day'];
        $id_times   = $_POST['id_time'];

        $inforDataUser = $this->UserFortuneSchedule->getInforUser($id_fortune, $day, $id_times);
        if ($inforDataUser) {
            die($inforDataUser);
        }
    }

    /**
     * [historyTeller description]
     * @return [type] [description]
     */
    public function historyTeller()
    {
        $data         = $this->Auth->user();
        $id_fortune   = $data['id'];
        if ($this->Check->isId($id_fortune) != true) {
            // do something
        } else {
            $useHistorySchedule = $this->fortuneRepo->getHistoryUserSchedule($id_fortune);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $from_time = $this->request->data['from_time'];
                $end_time  = $this->request->data['end_time'];

                if (strcmp($from_time, "") === 0 || strcmp($end_time, "") === 0  ) {
                    $this->Flash->error(__('Start time or end time is not blank'));
                    return $this->redirect(['action' => 'historyTeller']);
                }

                if ($from_time > $end_time) {
                    $this->Flash->error(__('Start time must larger end time'));
                    return $this->redirect(['action' => 'historyTeller']);
                }

                $output = $this->fortuneRepo->getHistoryFollowDate($from_time,$end_time, $id_fortune);
                $this->set(['history_schedules' => $output]);
            } else {
                $this->set(['history_schedules' => $useHistorySchedule,]);
            }
        }
    }

    /** 
     * [listHistoryFiveTeller description]
     * @return [type] [description]
     */
    public function listHistoryFiveTeller()
    {
        $data         = $this->Auth->user();
        $id_fortune   = $data['id'];
        if ($this->Check->isId($id_fortune) != true) {
            // do something
        } else {
            $listFiveHistory = $this->FortuneExecuteHistorys->getFiveHistory($id_fortune);
            $this->set(compact('listFiveHistory'));
        }
    }

    /**
     * [excuteHistory description]
     * @return [void] [description]
     */
    public function excuteHistory()
    {
        $this->loadModel('FortuneExecuteHistorys');
        $data = $this->Auth->user();
        $id_fortune = $data['id'];
        if ($this->Check->isId($id_fortune)) {
            $dataForExeHistory = $this->FortuneExecuteHistorys->getExeHistory($id_fortune);
            $this->set(['dataHistory' => $dataForExeHistory]);
        } else {
            $this->Flash->error(__('ID not found'));
        }
    }

    /**
     * [excuteHistoryByMonth description]
     * @return [void] [description]
     */
    public function excuteHistoryByMonth()
    {
        $data = $this->Auth->user();
        $id_fortune = $data['id'];
        if ($this->Check->isId($id_fortune)) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $month = $this->request->data['month'];
                $year  = $this->request->data['years']['year'];
                if (strcmp($month, "") === 0 || strcmp($year, "") === 0) {
                    $this->Flash->error(__('Must choose month or year'));
                } else {
                    $dataHistoryByMonth = $this->FortuneExecuteHistorys->getByMonth($month, $year, $id_fortune);
                    $this->set(['dataHistory' => $dataHistoryByMonth]);
                }
            } else {
                $dataForExeHistory = $this->FortuneExecuteHistorys->getExeHistory($id_fortune);
                $this->set(['dataHistory' => $dataForExeHistory]);
            }
        }
    }

    /**
     * [messages description]
     * @return \Cake\Network\Response|null [type] [description]
     */
    public function messages()
    {
        $this->loadModel('UserFortuneMsg');
        $data = $this->Auth->user();
        $id_fortune = $data['id'];
        if ($this->Check->isId($id_fortune)) {
            $messages      = $this->UserFortuneMsg->getMessages($id_fortune);
            $this->set([
                'messages'      => $messages,
            ]);
        } else {
            $this->Flash->error(__('id not found'));
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * [detailMsg description]
     */
    public function detailMsg($id = null)
    {
        $this->loadModel('UserFortuneMsg');
        $id_msg = $this->UserFortuneMsg->get($id)->id;
    }

    /**
     * [setBlog description]
     */
    public function setBlog ()
    {
        $data       = $this->Auth->user();
        $id_fortune = $data['id'];
        if ($this->Check->isId($id_fortune)) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $isSaveBlog = $this->FortuneBlog->saveBlog($this->request->data, $id_fortune);
                if ($isSaveBlog) {
                    $this->Flash->success(__('Save is success'));
                    return $this->redirect(['controller' => 'fortunes', 'action' => 'indexBlog']);
                } else {
                    $this->Flash->error(__('Save is not success'));
                }
            } else {
            }
        } else {
            $this->Flash->error(__('id not found'));
        }
    }

    /** 
     * [addUrlRoot description]
     */
    public function addUrlRoot()
    {
        $data       = $this->Auth->user();
        $id_fortune = $data['id'];
        if ($this->Check->isId($id_fortune)) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $this->loadModel('FortuneProfile');
                $addUrlRoot = $this->FortuneProfile->updateUrlRoot($id_fortune, $this->request->data);
                if ($addUrlRoot) {
                    $this->Flash->success(__('Update success'));
                    return $this->redirect(['controller' => 'fortunes', 'action' => 'indexBlog']);
                } else {
                    $this->Flash->success(__('Update is not success'));
                }
            }
        }
    }

    /** 
     * [indexBlog description]
     * @return [type] [description]
     */
    public function indexBlog ()
    {
        $data       = $this->Auth->user();
        $id_fortune = $data['id'];
        if ($this->Check->isId($id_fortune)) {
            $listBlog = $this->FortuneBlog->getListBlog($id_fortune);
            $this->set([
                'listBlog' => $listBlog
            ]);
        }
    }

    /** 
     * [editBlog description]
     * @return [void] [description]
     */
    public function editBlog()
    {
        $id_blog = $this->request->pass['0'];
        if ($this->Check->isId($id_blog)) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $isUpdateBlog = $this->FortuneBlog->updateBlog($this->request->data);
                if ($isUpdateBlog) {
                    $this->Flash->success(__('Update is success'));
                    return $this->redirect(['controller' => 'Fortunes', 'action' => 'indexBlog']);
                } else {
                    $this->Flash->error(__('Update is not success'));
                    return $this->redirect(['controller' => 'Fortunes', 'action' => 'indexBlog']);
                }
            }
            $firstBlog = $this->FortuneBlog->getBlogById($id_blog);
            $this->set([
                'dataBlog' => $firstBlog,
            ]);
        } else {
            $this->Flash->error(__('Id not found'));
            return $this->redirect(['controller' => 'Fortunes', 'action' => 'indexBlog']);
        }
    }

    /** 
     * [deleteBlog description]
     * @return [void] [description]
     */
    public function deleteBlog()
    {
        $id_blog = $this->request->pass['0'];
        if ($this->Check->isId($id_blog)) {
            $isDelBlog = $this->FortuneBlog->delBlog($id_blog);
            if ($isDelBlog) {
                $this->Flash->success(__('Delete is success'));
                return $this->redirect(['controller' => 'Fortunes', 'action' => 'indexBlog']);
            } else {
                $this->Flash->error(__('Delete is not success'));
                return $this->redirect(['controller' => 'Fortunes', 'action' => 'indexBlog']);
            }
        } else {
            $this->Flash->error(__('Id not found'));
            return $this->redirect(['controller' => 'Fortunes', 'action' => 'indexBlog']);
        }
    }


    /** 
     * [watchComment description]
     * @return [type] [description]
     */
    public function watchComment()
    {
        $id_fortune = 2;
        if ($this->Check->isId($id_fortune)) {
            $commentFortune = $this->UserFortuneComments->getCommentByFortune($id_fortune);
            $this->set([
                'commentFortune' => $commentFortune,
            ]);
        }
    }
    /*Function find Fortune
    * Date 24/08/2016
    */
    public  function findFortune(){
        $this->Auth->allow();
        if ($this->request->is('post')) {
            $data =	$this->request->data;
            $result = $this->Fortunes->searchFortune($data);
            dump($result);

        }
    }

}
