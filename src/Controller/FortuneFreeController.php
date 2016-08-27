<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use App\Model\Entity\FortuneFree;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Auth;

/**
 * BrmUserFortuneFree Controller
 *
 * @property \App\Model\Table\FortuneFreeTable $BrmUserFortuneFree
 */
class FortuneFreeController  extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $this->paginate = [
            'contain' => ['User', 'Fortunes']
        ];
        $free =  $this->FortuneFree->find('all');
        if(!empty($this->request->query['keyword'])){
            $free->where(['name LIKE ' => '%'.$this->request->query['keyword'].'%']);
            $free->orWhere([
                'answer_title LIKE ' => '%'.$this->request->query['keyword'].'%',
                'answer_contents LIKE ' => '%'.$this->request->query['keyword'].'%',
                'job LIKE ' => '%'.$this->request->query['keyword'].'%',
                'content LIKE ' => '%'.$this->request->query['keyword'].'%',
            ]);
        }
        $frees= $this->paginate($free);
        $this->set(compact('frees'));
        $this->set('_serialize', ['frees']);

    }

    /**
     * View method
     *
     * @param string|null $id Brm User Fortune Freec id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $brmUserFortuneFree = $this->FortuneFree->get($id, [
            'contain' => ['User', 'Fortunes']
        ]);

        $listViews = $this->FortuneFree->getListFreecByFortuneId($brmUserFortuneFree->fortune_id, ['contain' => ['User', 'Fortunes']],$id);

        $this->set(compact('brmUserFortuneFree','listViews'));
        $this->set('_serialize', ['brmUserFortuneFree']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $freeTable = TableRegistry::get('FortuneFree');
        $free =  $freeTable->newEntity();
        $freeFortune = '';

        if ($this->request->is('post')) {
            $free->user_id =	$this->request->data['user_id'];
            $free->username =	$this->request->data['username'];
            $free->job =	$this->request->data['job'];
            $free->content =	$this->request->data['content'];
            $free->date_created =	Time::now();
            $free->date_modified =	Time::now();

            if ($freeTable->save($free)) {
                $this->Flash->success(__('The brm user fortune freec has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The brm user fortune freec could not be saved. Please, try again.'));
            }
        }
        $this->loadComponent('Auth');
        $users = $this->Auth->user();
        $this->set(compact('freeFortune', 'users'));
        $this->set('_serialize', ['brmUserFortuneFree']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Brm User Fortune Freec id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $brmUserFortuneFree = $this->FortuneFree->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $brmUserFortuneFree = $this->FortuneFree->patchEntity($brmUserFortuneFree, $this->request->data);
            if ($this->FortuneFree->save($brmUserFortuneFree)) {
                $this->Flash->success(__('The brm user fortune freec has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The brm user fortune freec could not be saved. Please, try again.'));
            }
        }
        $users = $this->FortuneFree->Users->find('list', ['limit' => 200]);
        $fortunes = $this->FortuneFree->Fortunes->find('list', ['limit' => 200]);
        $this->set(compact('brmUserFortu    neFreec', 'users', 'fortunes'));
        $this->set('_serialize', ['brmUserFortuneFree']);
    }
    /**
     * Delete method
     *
     * @param string|null $id Brm User Fortune Freec id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $brmUserFortuneFree = $this->BrmUserFortuneFree->get($id);
        if ($this->BrmUserFortuneFree->delete($brmUserFortuneFree)) {
            $this->Flash->success(__('The brm user fortune freec has been deleted.'));
        } else {
            $this->Flash->error(__('The brm user fortune freec could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
