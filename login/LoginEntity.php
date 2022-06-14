<?php
namespace User\V1\Rest\Login;


class LoginEntity
{
    public $id;
    public $userId;
    public $department;
    public $logDate;
    public $loginTime;
    public $status;
    
    
    


    public function exchangeArray($data) 
    {

        $this->id                   = isset($data['id']) ? $data['id'] : "";
        $this->userId                 = isset($data['userId']) ? $data['userId'] : "";
        $this->logDate              = isset($data['logDate']) ? $data['logDate'] : "";
        $this->loginTime            = isset($data['loginTime']) ? $data['loginTime'] : "";
        $this->logoutTime           = isset($data['logoutTime']) ? $data['logoutTime'] : "";
        $this->status               = isset($data['status']) ? $data['status'] :1;
        
        
        
                
    }

        

  
    public function populate($data)
    {
        
        $this->id                       = isset($data->id) ? $data->id : "";
        $this->userId                     = isset($data->userId) ? $data->userId : "";
        $this->logDate                  = isset($data->logDate) ? $data->logDate : "";
        $this->loginTime                = isset($data->loginTime) ? $data->loginTime : "";
        $this->logoutTime               = isset($data->logoutTime) ? $data->logoutTime : "";
        $this->status                   = isset($data->status) ? $data->status :1;
        
        
        
    }
}


