<?php namespace App\Controllers;

use \App\Libraries\Oauth;
use \OAuth2\Request;
use CodeIgniter\API\ResponseTrait;
use App\Models\EmployeeModel;

class Registration extends BaseController
{
	use ResponseTrait;

	public function register(){
        
        helper(['form']);
        $data = [];

        if($this->request->getMethod() != 'post'){
            return $this->fail('Only post request is allowed');
        }

		$rules = [
			'employee_id' => 'required|min_length[5]',
			'lastname' => 'required|min_length[5]',
			'firstname' => 'required|min_length[5]',
			'middlename' => 'required|min_length[5]',
			'password' => 'required|min_length[5]',
			'confirm_password' => 'matches[password]',
		];
		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
            $model = new EmployeeModel();
			$data = [
                'employee_id' => $this->request->getVar('employee_id'),
                'lastname' => $this->request->getVar('lastname'),
                'firstname' => $this->request->getVar('firstname'),
                'middlename' => $this->request->getVar('middlename'),
                'password' => $this->request->getVar('password')
			];
            $emp = $model->insert($data);
            unset($data['password']);
			return $this->respondCreated(array('message' => 'Employee Successfully Created', 'data' => $emp));

		}
	}
}