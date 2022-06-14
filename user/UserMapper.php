<?php

namespace User\V1\Rest\User;

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


class UserMapper
{
    protected $adapter;
    protected $sql;
    protected $table;
   
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->sql = new Sql($adapter);
        $this->table = new TableIdentifier('userRegistration');
    }
    
    public function save(UserEntity $data,$id = 0)
    {
        $select = new Select("userRegistration");
        $select->columns([
                    'id'            => 'id',
                  
                ]);
        $select->where(['userRegistration.email' => $data->email]);
      
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $current = $result->current();
        if(empty($current['id']))
        {
            $insert = new Insert($this->table);          
            $insert->values([

                'name'          =>$data->name,
                'email'         =>$data->email,
                'password'      =>$data->password,
                'department'    =>$data->department,
                'status'        =>$data->status,
              

            ]);
            $statement = $this->sql->prepareStatementForSqlObject($insert);
            $result= $statement->execute();
            $id = $this->adapter->getDriver()->getLastGeneratedValue();
        
     
            return $id;
        }
        else
        {
            $current['id'];
        }
        
        
    }
}