<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    public $timestamps = false;

    public function user() { // essendo uno ad uno si mete singolare
        return $this->belognsTo('App\User'); // ha la foreign key quindi belognsTo
    }
}
