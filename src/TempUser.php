<?php 

namespace App\Models;

class TempUser
{
    public $id;
    public $name;
    public $email;
    public $login;
    public $ddd;
    public $phone;
    public $document;
    public $type;
    public $section_id;
    public $area_id;
    public $token;
    public $data_creation_token;
    public $authentication;
    public $active;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->login = $data['login'];
        $this->ddd = $data['ddd'];
        $this->phone = $data['phone'];
        $this->document = $data['document'];
        $this->type = $data['type'];
        $this->section_id = $data['section_id'];
        $this->area_id = $data['area_id'];
        $this->token = $data['token'];
        $this->data_creation_token = $data['data_creation_token'];
        $this->authentication = $data['authentication'];
        $this->active = $data['active'];
    }
}