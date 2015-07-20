<?php
namespace App\Controller;

use App\Controller\AppController;


/**
 * Export Controller
 *
 * @property \App\Model\Table\ExportTable $Export
 */
class ExportController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('export', $this->paginate($this->Export));
        $this->set('_serialize', ['export']);
    }

    /**
     * View method
     *
     * @param string|null $id Export id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $export = $this->Export->get($id, [
            'contain' => []
        ]);
        $this->set('export', $export);
        $this->set('_serialize', ['export']);
    }

    public function test(){
        
        $this->layout= '';
        $this->set('export', $this->paginate($this->Export));
        $this->set('_serialize', ['export']);
        $queryAll = $this->ExportTable->getAllData();
        $this->set('allData', $queryAll);
        $querySwiss = $this->ExportTable->getKoordinatesSwiss();
        $this->set('schweizKordinaten', $querySwiss);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $export = $this->Export->newEntity();
        if ($this->request->is('post')) {
            $export = $this->Export->patchEntity($export, $this->request->data);
            if ($this->Export->save($export)) {
                $this->Flash->success(__('The export has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The export could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('export'));
        $this->set('_serialize', ['export']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Export id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $export = $this->Export->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $export = $this->Export->patchEntity($export, $this->request->data);
            if ($this->Export->save($export)) {
                $this->Flash->success(__('The export has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The export could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('export'));
        $this->set('_serialize', ['export']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Export id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $export = $this->Export->get($id);
        if ($this->Export->delete($export)) {
            $this->Flash->success(__('The export has been deleted.'));
        } else {
            $this->Flash->error(__('The export could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
