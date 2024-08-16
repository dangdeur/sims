<?php

namespace App\Controllers;

use App\Models\ItemsModel;

class Home extends BaseController
{

  public function __construct()
  {
    $this->model = new ItemsModel();
  }

	public function index()
	{
    $data = [
      'title' => 'List of Items'
    ];
		return view('items/index', $data);
	}

  public function get_items()
  {
    if ($this->request->isAJAX()) {
      $data = [
        'items' => $this->model->findAll()
      ];

      $output = view('items/source-data', $data);
      echo json_encode($output);
    } else {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
  }

  public function get_item()
  {
    if ($this->request->isAJAX()) {
      $id = $this->request->getVar('id');
      $data['item'] = $this->model->find($id);

      $output = view('items/detail', $data);
      echo json_encode($output);
    } else {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
  }

  public function get_add_item_modal()
  {
    if ($this->request->isAJAX()) {
      $output = view('items/add-form');
      echo json_encode($output);
    } else {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
  }

  public function save_item()
  {
    $rules = [
      'name' => 'required',
      'category' => 'required',
    ];

    $price = $this->request->getPost('price');
    if ($price) {
      $rules['price'] = 'numeric';
    }

    if (!$this->validate($rules)) {
      $errors = [
        'name' => $this->validation->getError('name'),
        'price' => $this->validation->getError('price'),
        'category' => $this->validation->getError('category'),
      ];

      $output = [
        'status' => FALSE,
        'errors' => $errors
      ];
      echo json_encode($output);
    } else {
      $this->model->save([
        'name' => $this->request->getPost('name'),
        'price' => $price,
        'category' => $this->request->getPost('category'),
        'detail' => $this->request->getPost('detail'),
      ]);
      echo json_encode(['status' => TRUE]);
    }
  }

  public function get_delete_item_modal()
  {
    if ($this->request->isAJAX()) {
      $id = $this->request->getVar('id');
      $data['item'] = ['id' => $id];

      $output = view('items/delete-form', $data);
      echo json_encode($output);
    } else {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
  }

  public function delete_item()
  {
    $id = $this->request->getPost('id');
    $this->model->where('id', $id)->delete();
    echo json_encode(['status' => TRUE]);
  }

  public function get_update_item_modal()
  {
    if ($this->request->isAJAX()) {
      $id = $this->request->getVar('id');
      $data['item'] = $this->model->find($id); // better: this->db->query("SELECT id, name, price, category, detail ..)
      $data['categories'] = ['kaos', 'kemeja'];

      $output = view('items/update-form', $data);
      echo json_encode($output);
    } else {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
  }

  public function update_item()
  {
    $rules = [
      'name' => 'required',
      'category' => 'required',
    ];

    $price = $this->request->getPost('price');
    if ($price) {
      $rules['price'] = 'numeric';
    }

    if (!$this->validate($rules)) {
      $errors = [
        'name' => $this->validation->getError('name'),
        'price' => $this->validation->getError('price'),
        'category' => $this->validation->getError('category'),
      ];

      $output = [
        'status' => FALSE,
        'errors' => $errors
      ];
      echo json_encode($output);
    } else {
      $this->model->save([
        'id' => $this->request->getPost('id'),
        'name' => $this->request->getPost('name'),
        'price' => $price,
        'category' => $this->request->getPost('category'),
        'detail' => $this->request->getPost('detail'),
      ]);
      echo json_encode(['status' => TRUE]);
    }
  }

}
