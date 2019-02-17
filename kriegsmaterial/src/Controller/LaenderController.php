<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Laender Controller
 *
 * @property \App\Model\Table\LaenderTable $Laender
 */
class LaenderController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('laender', $this->paginate($this->Laender));
        $this->set('_serialize', ['laender']);
    }

    /**
     * View method
     *
     * @param string|null $id Laender id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $laender = $this->Laender->get($id, [
            'contain' => []
        ]);
        $this->set('laender', $laender);
        $this->set('_serialize', ['laender']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $laender = $this->Laender->newEntity();
        if ($this->request->is('post')) {
            $laender = $this->Laender->patchEntity($laender, $this->request->data);
            if ($this->Laender->save($laender)) {
                $this->Flash->success(__('The laender has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The laender could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('laender'));
        $this->set('_serialize', ['laender']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Laender id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $laender = $this->Laender->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $laender = $this->Laender->patchEntity($laender, $this->request->data);
            if ($this->Laender->save($laender)) {
                $this->Flash->success(__('The laender has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The laender could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('laender'));
        $this->set('_serialize', ['laender']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Laender id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $laender = $this->Laender->get($id);
        if ($this->Laender->delete($laender)) {
            $this->Flash->success(__('The laender has been deleted.'));
        } else {
            $this->Flash->error(__('The laender could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
