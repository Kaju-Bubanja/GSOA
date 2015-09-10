<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Skandale Controller
 *
 * @property \App\Model\Table\SkandaleTable $Skandale
 */
class SkandaleController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Laender']
        ];
        $this->set('skandale', $this->paginate($this->Skandale));
        $this->set('_serialize', ['skandale']);
    }

    /**
     * View method
     *
     * @param string|null $id Skandale id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $skandale = $this->Skandale->get($id, [
            'contain' => ['Laender']
        ]);
        $this->set('skandale', $skandale);
        $this->set('_serialize', ['skandale']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $skandale = $this->Skandale->newEntity();
        if ($this->request->is('post')) {
            $skandale = $this->Skandale->patchEntity($skandale, $this->request->data);
            if ($this->Skandale->save($skandale)) {
                $this->Flash->success(__('The skandale has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The skandale could not be saved. Please, try again.'));
            }
        }
        $laender = $this->Skandale->Laender->find('list', ['limit' => 200]);
        $this->set(compact('skandale', 'laender'));
        $this->set('_serialize', ['skandale']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Skandale id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $skandale = $this->Skandale->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $skandale = $this->Skandale->patchEntity($skandale, $this->request->data);
            if ($this->Skandale->save($skandale)) {
                $this->Flash->success(__('The skandale has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The skandale could not be saved. Please, try again.'));
            }
        }
        $laender = $this->Skandale->Laender->find('list', ['limit' => 200]);
        $this->set(compact('skandale', 'laender'));
        $this->set('_serialize', ['skandale']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Skandale id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $skandale = $this->Skandale->get($id);
        if ($this->Skandale->delete($skandale)) {
            $this->Flash->success(__('The skandale has been deleted.'));
        } else {
            $this->Flash->error(__('The skandale could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
