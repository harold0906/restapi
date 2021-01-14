<?php namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'employee_id';
    protected $allowedFields = ['employee_id','firstname','lastname','middlename','password'];

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data){
        $data =  $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data){
        $data =  $this->passwordHash($data);
        return $data;
    }
    protected function passwordHash(array $data){
        if(isset($data['data']['password']))
            $data['data']['password'] = password_hash($data['data']['password'],PASSWORD_DEFAULT);
        
        return $data;
    }
}