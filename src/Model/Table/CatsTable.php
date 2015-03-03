<?php
namespace App\Model\Table;

use App\Model\Entity\Cat;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cats Model
 */
class CatsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('cats');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
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
            ->add('id', 'valid', ['rule' => 'uuid'])
            ->allowEmpty('id', 'create')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('is_alive', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('is_alive')
            ->add('weight', 'valid', ['rule' => 'numeric'])
            ->requirePresence('weight', 'create')
            ->notEmpty('weight')
            ->requirePresence('gender', true)
            ->notEmpty('gender')
            ->requirePresence('ssn', 'create')
            ->add('ssn', 'valid', [
                'rule' => ['custom', '/^\d{3}-\d{2}-\d{4}$/'],
                'message' => 'Format social security as 123-45-6789'
            ])
            ->notEmpty('ssn')
            ->add('birth_year', 'valid', ['rule' => 'numeric'])
            ->requirePresence('birth_year', 'create')
            ->notEmpty('birth_year');

        return $validator;
    }

    public function beforeFind($event, $query, $options, $primary) {
        if (!$query->clause('order')) {
            $query->order(['is_alive' => 'DESC', 'name' => 'ASC']);
        }
        return $query;
    }

    public function findHeaviest(Query $query, $options = []) {
        return $query->order(['weight' => 'DESC']);
    }

    public function findLightest(Query $query, $options = []) {
        return $query->order(['weight' => 'ASC']);
    }

    public function findAlive(Query $query, $options = []) {
        return $query->where(['is_alive' => 1]);
    }

    public function findDead(Query $query, $options = []) {
        return $query->where(['is_alive' => 0]);
    }

    public function findGenderCount(Query $query) {
        return $query->select(['gender', $query->func()->count('gender')])->group('gender');
    }

    public function findAge(Query $query) {
        return $query->formatResults(function (\Cake\Datasource\ResultSetInterface $results) {
            return $results->map(function ($row) {
                $date = new \DateTime();
                $date->setDate($row['birth_year'], date('m'), date('d'));
                $row['age'] = $date->diff(new \DateTime)->y;
                return $row;
            });
        });
    }
}
