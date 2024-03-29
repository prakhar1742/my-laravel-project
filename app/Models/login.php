<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class login extends Eloquent
{
    protected $collection="logins";
    protected $hidden=["password"];
    

}
