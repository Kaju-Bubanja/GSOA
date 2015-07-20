<?php
namespace App\Model\Table;

use App\Model\Entity\Export;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Export Model
 *
 */
class ExportTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('export');
        $this->displayField('Id');
        $this->primaryKey('Id');
    }

    public function getAllData(){
        $queryAll = $this->Export->find()
            ->hydrate(false)
            ->join([
                'table' => 'laender',
                'alias' => 'l',
                'type' => 'INNER',
                'conditions' => 'l.Code = Export.Code'
                ])
            ->all();
        return $queryAll;
    }

    public function getKoordinatesSwiss(){
        $querySwiss = $this->Laender->find()
            ->select(['Latitude', 'Longitude'])
            ->where(['Code' => 'CH']);
        return $querySwiss;
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('Id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('Id', 'create');
            
        $validator
            ->allowEmpty('Code');
            
        $validator
            ->allowEmpty('Art');
            
        $validator
            ->allowEmpty('System');
            
        $validator
            ->allowEmpty('Kategorie');
            
        $validator
            ->allowEmpty('Year');
            
        $validator
            ->add('Betrag', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('Betrag');

        return $validator;
    }
}
