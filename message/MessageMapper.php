<?php

namespace User\V1\Rest\Message;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\TableIdentifier;
use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Adapter\Adapter;
use Zend\Paginator\Adapter\DbSelect;;
use User\V1\Rest\User\UserCollection;
use Zend\Crypt\Password\Bcrypt;
use Zend\Crypt\BlockCipher;
use Zend\Http\Header\AbstractDate;


class MessageMapper
{
    protected $adapter;
    protected $sql;
    protected $table;
   
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->sql = new Sql($adapter);
        $this->table = new TableIdentifier('message');
    }
    
    public function save(MessageEntity $data,$id = 0)
    {
        $date = date('y-m-d');
        $insert = new Insert($this->table);          
        $insert->values([

                'userId'            =>$data->userId,
                'message'           =>$data->message,
                
                
              

            ]);
            $statement = $this->sql->prepareStatementForSqlObject($insert);
            $result= $statement->execute();
            $id = $this->adapter->getDriver()->getLastGeneratedValue();
        
     
            return $id;
    }

    public function update( $id,$data)
    {
        
        $update = new Update($this->table);
        $update->set([

            
            'message'           =>$data->message,
            
          

        ]);
        $update->where(['id' => $id]);
        $statement = $this->sql->prepareStatementForSqlObject($update);
        
        $result = $statement->execute();
        return[$id];
    }

    public function fetchAll($filters = [],$page=null)
    {  
    
        $select = new Select($this->table);
        $select->columns([
            'messageId'                =>'id',
            'userId'                   =>'userId',
            'message'                  =>'message',
            'created'                  =>'created',
           
            
        
        ]);
        $select->join(['rg' => 'userRegistration'], 'rg.id = message.userId', ['name'=>'name','department'=>'department'], Select::JOIN_INNER);
        
       
        $paginatorAdapter = new DbSelect($select, $this->adapter);
        
        $collection = new UserCollection($paginatorAdapter);
        $collection->setCurrentPageNumber($page);

        $pagedetails=array();  
        $pagedetails["pagecount"]=$collection->getPages()->pageCount;
        $pagedetails["currentpage"]=$collection->getCurrentPageNumber();
        
        return [$collection->toFetch(),$pagedetails];
    }
    public function delete($id)
    {
        $delete = new Delete("message");
        $delete->where(['id' => $id]);
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        $result = $statement->execute();
        return $result->getAffectedRows() > 0;
    }
}