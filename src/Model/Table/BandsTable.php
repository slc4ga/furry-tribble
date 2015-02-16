<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class BandsTable extends Table {
	public function initialize(array $config) {
        $this->hasMany('Comments',[
            'foreignKey' => 'band_id',
            'dependent' => false,
        ]);
    }
}
?>