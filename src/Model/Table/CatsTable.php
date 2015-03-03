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
            ->add('weight', 'valid', ['rule' => 'numeric', 'message' => 'Must be a number',
])
            ->requirePresence('weight', 'create')
            ->notEmpty('weight')
            ->requirePresence('gender', true)
            ->notEmpty('gender')
            ->requirePresence('ssn', 'create')
            // SSN validation
            ->add('ssn', 'valid', [
                'rule' => ['custom', '/^\d{3}-\d{2}-\d{4}$/'],
                'message' => 'Format social security as 123-45-6789'
            ])
            ->notEmpty('ssn')
            // Custom validation for birth_year less than or equal to current year
            ->add('birth_year', 'custom', [
                'rule' => function($value, $context) {
                    return $value <= date('Y');
                },
                'message' => 'Year must be less than or equal to '.date('Y')
            ])
            ->add('birth_year', 'valid', ['rule' => 'numeric'])
            ->requirePresence('birth_year', 'create')
            ->notEmpty('birth_year');

        return $validator;
    }

    /**
     * Default order of is_alive DESC followed by name ASC
     */
    public function beforeFind($event, $query, $options, $primary) {
        if (!$query->clause('order')) {
            $query->order(['is_alive' => 'DESC', 'name' => 'ASC']);
        }
        return $query;
    }

    /**
     * Order clause by weight DESC
     */
    public function findHeaviest(Query $query, $options = []) {
        return $query->order(['weight' => 'DESC']);
    }

    /**
     * Order clause weight ASC
     */
    public function findLightest(Query $query, $options = []) {
        return $query->order(['weight' => 'ASC']);
    }

    /**
     * Where clause is_alive 1
     */
    public function findAlive(Query $query, $options = []) {
        return $query->where(['is_alive' => 1]);
    }

    /**
     * Where clause is_alive 0
     */
    public function findDead(Query $query, $options = []) {
        return $query->where(['is_alive' => 0]);
    }

    /**
     * Grouped gender
     */
    public function findGenderCount(Query $query) {
        return $query->select(['gender', 'gender_count' => $query->func()->count('gender')])->group('gender');
    }

    /**
     * Compute age
     */
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
