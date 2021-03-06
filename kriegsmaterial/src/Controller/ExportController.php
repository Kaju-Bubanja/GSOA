<?php
namespace App\Controller;

use App\Controller\AppController;


// TODO: Antillen not working for query, because ,


/**
 * Export Controller
 *
 * @property \App\Model\Table\ExportTable $Export
 */
class ExportController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event){
        $this->Auth->allow(['test','search','searchskandals']);

    }

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
    }

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


        $this->loadModel('Laender');
        $this->loadModel('Firmen');
        
        $this->layout= '';
        
        $this->set('export', $this->paginate($this->Export));
        $this->set('_serialize', ['export']);

        if($this->request->is('ajax')){
            $this->render('ajax_table_part');
        }
        
        $querySwiss = $this->Laender->find()
            ->select(['Latitude', 'Longitude'])
            ->where(['Code' => 'CH']);
        
        $this->set('schweizKordinaten', $querySwiss);

        $this->loadModel('Art');
        $this->loadModel('System');
        $this->loadModel('Kategorie');
        $this->loadModel('Skandale');

        $laender = $this->Laender->find()
            ->select(['Land', 'LandFranz', 'Code', 'Latitude', 'Longitude'])
            ->where(["Code != 'CH' AND Code IN (SELECT Code FROM export) OR Code IN (SELECT Code FROM skandale)"])
            ->order(['Land' => 'ASC']);
        $skandale = $this->Skandale->find()
	        ->select(['Code', 'Link']);
        $art = $this->Art->find()
            ->select(['Art'])
            ->order(['Art' => 'ASC']);
        $system = $this->System->find()
            ->select(['System'])
            ->order(['System' => 'ASC']);
        $kategorie = $this->Kategorie->find()
        	->where('Kategorie IN (SELECT Kategorie FROM export)')
            ->select(['Kategorie'])
            ->order(['Id' => 'ASC']);
        $firmen = $this->Firmen->find()
            ->select(['Firma'])
            ->order(['Firma' => 'ASC']);
        
        $this->set('laender', $laender);
        $this->set('skandale', $skandale);
        $this->set('art', $art);
        $this->set('system', $system);
        $this->set('kategorie', $kategorie);
        $this->set('firmen', $firmen);

    }

    public function searchskandals(){

        $data = [];
        $this->layout= '';

        if($this->request->is('ajax')) {
            $this->loadModel('Laender');
            $this->loadModel('Skandale');
            $land = $this->request->data['landSkandal'];
            $firma = $this->request->data['firma'];
            $yearBegin = $this->request->data['yearBeginSkandale'];
            $yearEnd = $this->request->data['yearEndSkandale'];
            
            $code = $this->Laender->find()
            ->select('Code')
            ->where(['Land' => $land]);
            
            $queryArray = [];

            if(strcmp($land, "Alle Staaten") != 0){
                $queryArray[$this->Skandale->aliasField('Code')] = $code;
            }
            if(strcmp($firma, "Firma") != 0)
                $queryArray['Firma'] = $firma;
            if(strcmp($yearBegin, "Von") == 0)
                $yearBegin = 1939;
            if(strcmp($yearEnd, "Bis") == 0)
                $yearEnd = 2014;
  
            if($this->RequestHandler->accepts('json')){
                $searchDataTmp = $this->Skandale->find();
                
                $sumData = $searchDataTmp->select(['Betrag' => $searchDataTmp->func()->sum('Betrag')])
                    ->where($queryArray)
                    ->where(function ($exp, $q) use (&$yearBegin) {
                        return $exp->gte('DatumAnfang', $yearBegin);
                    })
                    ->where(function ($exp, $q) use (&$yearEnd){
                        return $exp->lte('DatumAnfang', $yearEnd + 1);
                    })->all();

                $searchData = $this->Skandale->find()
                    ->select(['Code'],['Land'])
                    ->where($queryArray)
                    ->where(function ($exp, $q) use (&$yearBegin) {
                        return $exp->gte('DatumAnfang', $yearBegin);
                    })
                    ->where(function ($exp, $q) use (&$yearEnd){
                        return $exp->lte('DatumAnfang', $yearEnd + 1);
                    })
                    ->contain(['Laender' => 
                    function ($q){
                        return $q->select(['Land', 'LandFranz']);
                    }
                    ])->all();
                $data['response'] = $searchData;
                $data['sum'] = $sumData;
                
                $this->set(compact('data'));
                $this->set('_serialize', 'data');
            }
            else if($this->RequestHandler->accepts('html')){
                $search = $this->request->data['searchSkandals'];
                if(strcmp($search, "true") == 0){
                    $searchData = $this->Skandale->find()
                    ->where($queryArray)
                    ->where(function ($exp, $q) use (&$yearBegin) {
                        return $exp->gte('DatumAnfang', $yearBegin);
                    })
                    ->where(function ($exp, $q) use (&$yearEnd){
                        return $exp->lte('DatumAnfang', $yearEnd + 1);
                    })
                    ->contain(['Laender' =>
                    		function ($q){
                    			return $q->select(['Land', 'LandFranz']);
                    		}
                    ])
                    ->order(['Land' => 'ASC', 'DatumAnfang' => 'ASC']);
                    
                    $this->set('skandale', $this->paginate($searchData));
                    $this->set('_serialize', ['skandale']);
                }
                else{
                    $this->set('skandale', $this->paginate($this->Skandale));
                    $this->set('_serialize', ['skandal']);
                }
                $this->render('ajax_table_part_skandale');
            }
        }
    }

    public function search(){
    	
        $data = [];
        $this->layout= '';
        if($this->request->is('ajax')) {
            $this->loadModel('Laender');
            $land = $this->request->data['land'];
            $art = $this->request->data['art'];
            $system = $this->request->data['system'];
            $kategorie = $this->request->data['kategorie'];
            $yearBegin = $this->request->data['yearBegin'];
            $yearEnd = $this->request->data['yearEnd'];
	        
            $code = $this->Laender->find()
            ->select('Code')
            ->where(['Land' => $land]);
            
            $queryArray = [];

            if(strcmp($land, "Alle Staaten") != 0){
                $queryArray[$this->Export->aliasField('Code')] = $code;
            }
            if(strcmp($art, "Alle Arten") != 0)
                $queryArray['Art'] = $art;
            if(!(empty($system) || strcmp($system, "Alle Systeme") == 0))
                $queryArray['System'] = $system;
            if(!empty($kategorie))
                $queryArray['Kategorie'] = $kategorie;
            if(strcmp($yearBegin, "Von") == 0)
                $yearBegin = 2006;
            if(strcmp($yearEnd, "Bis") == 0)
                $yearEnd = date("Y"); // = current year
  
            if($this->RequestHandler->accepts('json')){
                $searchDataTmp = $this->Export->find();
                
                $sumData = $searchDataTmp->select(['Betrag' => $searchDataTmp->func()->sum('Betrag')])
                    ->where($queryArray)
                    ->where(function ($exp, $q) use (&$yearBegin) {
                        return $exp->gte('Exportdate', $yearBegin. "-01-01");
                    })
                    ->where(function ($exp, $q) use (&$yearEnd){
                        return $exp->lte('Exportdate', ($yearEnd + 1) . "-01-01");
                    })
                    ->all();

               /* $this->log("HERE!");
                $this->log(debug($searchDataTmp->select(['Betrag' => $searchDataTmp->func()->sum('Betrag')])
                    ->where($queryArray)
                    ->where(function ($exp, $q) use (&$yearBegin) {
                        return $exp->gte('Exportdate', $yearBegin . "-01-01");
                    })
                    ->where(function ($exp, $q) use (&$yearEnd){
                        return $exp->lte('Exportdate', ($yearEnd + 1) . "-01-01");
                    })));*/
                    
                $searchDataTmp2 = $this->Export->find();
                $searchData = $searchDataTmp2
                    ->select(['Code', 'Betrag' => $searchDataTmp2->func()->sum('Betrag')])
                    ->where($queryArray)
                   ->where(function ($exp, $q) use (&$yearBegin) {
                       return $exp->gte('Exportdate', $yearBegin. "-01-01");
                    })
                    ->where(function ($exp, $q) use (&$yearEnd){
                        return $exp->lte('Exportdate', ($yearEnd + 1) . "-01-01");
                    })
                    ->group('Code')
                    ->all();
                 
                $data['response'] = $searchData;
                $data['sum'] = $sumData;
                $this->set(compact('data'));
                $this->set('_serialize', 'data');
            }
            else if($this->RequestHandler->accepts('html')){
                $search = $this->request->data['search'];
                if(strcmp($search, "true") == 0){
                    $searchData = $this->Export->find()
                    ->where($queryArray)
                    ->where(function ($exp, $q) use (&$yearBegin) {
                        return $exp->gte('Exportdate', $yearBegin. "-01-01");
                    })
                    ->where(function ($exp, $q) use (&$yearEnd){
                        return $exp->lte('Exportdate', ($yearEnd + 1) . "-01-01");
                    }) 
                    ->contain(['Laender' =>
                    		function ($q){
                    			return $q->select(['Land', 'LandFranz']);
                    		}
                    ])
                    ->order(['Betrag' => 'DESC', 'Land' => 'ASC']);
                    
                    $this->set('export', $this->paginate($searchData));
                    $this->set('_serialize', ['export']);
                }
                else{
                    $this->set('export', $this->paginate($this->Export));
                    $this->set('_serialize', ['export']);
                }
                $this->render('ajax_table_part');
            }
        }
       
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
