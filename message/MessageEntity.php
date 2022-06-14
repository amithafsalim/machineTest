<?php
namespace User\V1\Rest\Message;

class MessageEntity
{
    public $id;
    public $userId;
    public $message;
   
    
    
    


    public function exchangeArray($data) 
    {

        $this->id                   = isset($data['id']) ? $data['id'] : "";
        $this->userId               = isset($data['userId'])? $data['userId'] : "";
        $this->message              = isset($data['message']) ? $data['message'] : "";
        $this->created              = isset($data['created']) ? $data['created'] : "";
        
        
        
        
                
    }

        
    

    public function getArrayCopy() {
        return get_object_vars($this);
    }
    
    public function populate($data)
    {
        
        $this->id                       = isset($data->id) ? $data->id : "";
        $this->userId                   = isset($data->userId)? $data->userId : "";
        $this->message                  = isset($data->message) ? $data->message : "";
        $this->created              = isset($data->created) ? $data->created : "";
       
        
        
        
    }
}
