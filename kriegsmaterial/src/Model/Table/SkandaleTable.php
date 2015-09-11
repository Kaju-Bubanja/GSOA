<?php
namespace App\Model\Table;

use App\Model\Entity\Skandale;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Skandale Model
 *
 */
class SkandaleTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('skandale');
        $this->displayField('Id');
        $this->primaryKey('Id');
        $this->belongsTo('Laender', [
            'foreignKey' => 'Code'
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
            ->add('Id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('Id', 'create');
            
        $validator
            ->requirePresence('Code', 'create')
            ->notEmpty('Code');
            
        $validator
            ->allowEmpty('Firma');
            
        $validator
            ->add('DatumAnfang', 'valid', ['rule' => 'date'])
            ->allowEmpty('DatumAnfang');
            
        $validator
            ->add('DatumEnde', 'valid', ['rule' => 'date'])
            ->allowEmpty('DatumEnde');
            
        $validator
            ->allowEmpty('Betrag');
            
        $validator
            ->requirePresence('Link', 'create')
            ->notEmpty('Link');

        return $validator;
    }
}
