<?php namespace App\Models;

use CodeIgniter\Model;

class Blogmodel extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'blogid';
    protected $allowedFields = ['blogtitle','blogdesc'];
}