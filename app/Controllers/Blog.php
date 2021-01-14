<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Blog extends ResourceController
{
	protected $modelName = 'App\Models\BlogModel';
	protected $format = 'json';

	public function index()
	{
		$post = $this->model->findAll();
		return $this->respond(array('data' => $post));
	}

	public function create(){
		helper(['form']);

		$rules = [
			'title' => 'required',
			'desc' => 'required',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			$data = [
				'blogtitle' =>$this->request->getVar('title'),
				'blogdesc' =>$this->request->getVar('desc'),
			];
			$blogid = $this->model->insert($data);
			$data['blogid'] = $blogid;
			return $this->respondCreated(array('data' => 'Successfully added',$data));

		}
	}
	public function create_update(){
		helper(['form']);

		$rules = [
			'id' => 'required',
			'title' => 'required',
			'desc' => 'required',
		];
		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			$checkblog = $this->model->find($this->request->getVar('id'));
			if(empty($checkblog)){
				return $this->fail('Data not found');
			}
			$data = [
				'blogid' =>$this->request->getVar('id'),
				'blogtitle' =>$this->request->getVar('title'),
				'blogdesc' =>$this->request->getVar('desc'),
			];
			$this->model->save($data);
			return $this->respondCreated(array('data' => 'Successfully Updated',$data));

		}
	}

	public function update($id = null){
		helper(['form']);

		$rules = [
			'title' => 'required',
			'desc' => 'required',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			$input = $this->request->getRawInput();
			$data = [
				'blogid' => $id,
				'blogtitle' => $input['title'],
				'blogdesc' => $input['desc'],
			];
			$this->model->save($data);
			return $this->respondCreated(array('data' => 'Successfully Updated',$data));

		}
	}
}
