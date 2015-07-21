<?php
namespace App\Model\Table;

use App\Model\Entity\Laender;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Laender Model
 *
 */
class LaenderTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('laender');
        $this->displayField('Code');
        $this->primaryKey('Code');
        $this->hasMany('Export', [
            'foreignKey' => 'export_Code'
        ]);
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
            ->allowEmpty('Code', 'create');
            
        $validator
            ->allowEmpty('Kontinent');
            
        $validator
            ->allowEmpty('Land');
            
        $validator
            ->allowEmpty('LandFranz');
            
        $validator
            ->add('latitude', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('latitude');
            
        $validator
            ->add('longitude', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('longitude');

        return $validator;
    }
}
