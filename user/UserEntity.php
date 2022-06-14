<?php
/**
* @Desc Entity class for User api
* @Creator : Fathima Salim
* @Created:14-06-2022
* @Updated by : 
* @Updated On : 
**/
namespace User\V1\Rest\User;


class UserEntity
{
    public $id;
    public $name;
    public $department;
    public $email;
    public $status;
    
    
    


    public function exchangeArray($data) 
    {

        $this->id                   = isset($data['id']) ? $data['id'] : "";
        $this->name                 = isset($data['name']) ? $data['name'] : "";
        $this->department           = isset($data['department'])? $data['department'] : "";
        $this->email                = isset($data['email']) ? $data['email'] : "";
        $this->password             = isset($data['password']) ? $data['password'] : "";
        $this->status               = isset($data['status']) ? $data['status'] :1;
        
        
        
                
    }

        
    

    public function getArrayCopy() {
        return get_object_vars($this);
    }
    
    public function populate($data)
    {
        
        $this->id                       = isset($data->id) ? $data->id : "";
        $this->name                     = isset($data->name) ? $data->name : "";
        $this->department               = isset($data->department)? $data->department : "";
        $this->email                    = isset($data->email) ? $data->email : "";
        $this->password                 = isset($data->password) ? $data->password : "";
        $this->status                   = isset($data->status) ? $data->status :1;
        
        
        
    }
}


