<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Event\Event;

/**
 * Admin Controller
 *
 * @property \App\Model\Table\AdminTable $Admin
 */
class AdminController extends AppController
{

    /**
     * UserController constructor.
     * @param null $request
     * @param null $response
     */
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'loginAction' => [
                'controller' => 'Admin',
                'action' => 'login',
                'prefix' => 'admin'
            ],
            'loginRedirect' => [
                'controller' => 'Admin',
                'action' => 'index'
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ],
                    'userModel'=>'Admin'
                ]
            ],
            'logoutRedirect' => [

                'controller' => 'Admin',
                'action' => 'index',
            ]
        ]);

    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

    	//index page
        $this->set('admins', $this->paginate($this->Admin));
        $this->set('_serialize', ['admins']);
        $this->render('/Administrators/index');
    }

    /**
     * View method
     *
     * @param string|null $id Admin id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        //debug($this->request->params);
        //debug($id); return;
        $admin = $this->Admin->get($id
            //, ['contain' => ['Articles']]
        );
        $this->set('admin', $admin);
        $this->set('_serialize', ['admin']);
        $this->render('/Administrators/view');
    }

    /*Ranking Fortune*/
    public  function  adminRunRankingFortune(){
        if($this->request->is('post')){
          $type= $this->request->data('type');
            switch ($type){
                case 'week':
                    $param = array();
                    $day = date('w');
                    $param['start'] = date('Y-m-d', strtotime('-'.$day.' days'));
                    $param['end']  = date('Y-m-d', strtotime('+'.(6-$day).' days'));
                    $param['type']  = $type;
                    $model = $this->loadModel('FortuneExecuteHistorys');
                    $ranking = $model->getRunRanking($param);
                    dump($ranking);die;
                    $this->render('/Administrators/Fortunes/run_ranking');
                break;
            }
        }
        $this->render('/Administrators/Fortunes/run_ranking');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        // Allow users to login and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.

        $this->Auth->allow(['login', 'logout']);
        //check if not user redirect to login page
        $user = $this->Auth->user();
        if(isset($user) && $user['role'] != 'admin' && $this->request->param('action') != 'login' )
        {
           $this->redirect('/admin/login');
        }

    }

    /**
     * @return \Cake\Network\Response|null
     */
    public function login()
    {

        if ($this->request->is('post')) {
            $admin = $this->Auth->identify();
            if ($admin) {
                $this->Auth->setUser($admin);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Admin Username or Admin password is incorrect'), [
                    'key' => 'auth'
                ]);
            }
        }
        $this->render('/Administrators/login');
    }

    /**
     * @return \Cake\Network\Response|null
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($user)
    {

        return parent::isAuthorized($user);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $admin = $this->Admin->newEntity();
        if ($this->request->is('post')) {
            $admin = $this->Admin->patchEntity($admin, $this->request->data);
            if ($this->Admin->save($admin)) {
                $this->Flash->success(__('The admin has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The admin could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('admin'));
        $this->set('_serialize', ['admin']);
        $this->render('/Administrators/add');
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $admin = $this->Admin->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Admin->patchEntity($admin, $this->request->data);
            if ($this->Admin->save($admin)) {
                $this->Flash->success(__('The admin has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The admin could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('admin'));
        $this->set('_serialize', ['admin']);
        $this->render('/Administrators/edit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $admin = $this->Admin->get($id);
        if ($this->Admin->delete($admin)) {
            $this->Flash->success(__('The admin has been deleted.'));
        } else {
            $this->Flash->error(__('The admin could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


}
