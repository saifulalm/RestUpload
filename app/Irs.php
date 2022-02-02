<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Irs extends Model
{
    protected $table = "irs_message_transaction";
    protected $primaryKey = 'idtrx';
    protected $fillable = ['userid','idtrx','tujuan','kode','status','response'];
    protected $keyType = 'string';

}
