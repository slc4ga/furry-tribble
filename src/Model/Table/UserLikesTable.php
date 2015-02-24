<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class UserLikesTable extends Table {
	public function initialize(array $config) {
        $this->belongsTo('Comments');
    }
}
?>