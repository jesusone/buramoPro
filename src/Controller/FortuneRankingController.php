<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FortuneRanking Controller
 *
 * @property \App\Model\Table\FortuneRankingTable $FortuneRanking
 */
class FortuneRankingController extends AppController
{
    public $paginate = [
        'fields' => ['FortuneRanking.id', 'FortuneRanking.fortune_id', 'FortuneRanking.rank', 'FortuneRanking.rank_kind', 'FortuneRanking.fortune_kind_name'],
        'limit' => 25,
        'order' => [
            'FortuneRanking.id' => 'asc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $fortuneRanking = $this->paginate($this->FortuneRanking);

        $this->set(compact('fortuneRanking'));
        $this->set('_serialize', ['fortuneRanking']);
    }

    /**
     * View method
     *
     * @param string|null $id Fortune Ranking id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fortuneRanking = $this->FortuneRanking->get($id, [
            'contain' => []
        ]);

        $this->set('fortuneRanking', $fortuneRanking);
        $this->set('_serialize', ['fortuneRanking']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fortuneRanking = $this->FortuneRanking->newEntity();
        if ($this->request->is('post')) {
            $fortuneRanking = $this->FortuneRanking->patchEntity($fortuneRanking, $this->request->data);
            if ($this->FortuneRanking->save($fortuneRanking)) {
                $this->Flash->success(__('The fortune ranking has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fortune ranking could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('fortuneRanking'));
        $this->set('_serialize', ['fortuneRanking']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fortune Ranking id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fortuneRanking = $this->FortuneRanking->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fortuneRanking = $this->FortuneRanking->patchEntity($fortuneRanking, $this->request->data);
            if ($this->FortuneRanking->save($fortuneRanking)) {
                $this->Flash->success(__('The fortune ranking has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fortune ranking could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('fortuneRanking'));
        $this->set('_serialize', ['fortuneRanking']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fortune Ranking id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fortuneRanking = $this->FortuneRanking->get($id);
        if ($this->FortuneRanking->delete($fortuneRanking)) {
            $this->Flash->success(__('The fortune ranking has been deleted.'));
        } else {
            $this->Flash->error(__('The  fortune ranking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * show method
     *
     * @return \Cake\Network\Response|null
     */
    public function show()
    {
        $fortuneRankingInWeek = $this->FortuneRanking->findBestFortuneInWeek();
        // use paginate
        //$this->set('fortuneRanking', $this->paginate($fortuneRanking));
        $this->set(compact('fortuneRankingInWeek'));
        $this->set('_serialize', ['fortuneRankingInWeek']);

        $fortuneRankingInMonth = $this->FortuneRanking->findBestFortuneInMonth();
        $this->set(compact('fortuneRankingInMonth'));
        $this->set('_serialize', ['fortuneRankingInMonth']);

        $fortuneRankingByPhone = $this->FortuneRanking->findBestFortuneByPhone();
        $this->set(compact('fortuneRankingByPhone'));
        $this->set('_serialize', ['fortuneRankingByPhone']);

        $fortuneRankingByMessage = $this->FortuneRanking->findBestFortuneByMessage();
        $this->set(compact('fortuneRankingByMessage'));
        $this->set('_serialize', ['fortuneRankingByMessage']);

        $fortuneRankingByComment = $this->FortuneRanking->findBestFortuneByComment();
        $this->set(compact('fortuneRankingByComment'));
        $this->set('_serialize', ['fortuneRankingByComment']);

        $fortuneLatest = $this->FortuneRanking->findNewestFortune();
        $this->set(compact('fortuneLatest'));
        $this->set('_serialize', ['fortuneLatest']);

        $fortuneRankingByYear = $this->FortuneRanking->findBestFortuneInYear();
        $this->set(compact('fortuneRankingByYear'));
        $this->set('_serialize', ['fortuneRankingByYear']);
    }
}
