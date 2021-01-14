<?php namespace App\Models;

use CodeIgniter\Model;

class Loginmodel extends Model
{
    protected $table = 'oauth_access_tokens';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['access_tokens','client_id','user_id'];
}