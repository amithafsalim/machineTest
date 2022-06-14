<?php
/**
* @Desc Mapper class for User api
* @Creator : Fathima Salim
* @Created:29-9-2020
* @Updated by : 
* @Updated On : 
**/
namespace User\V1\Rest\Login;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\TableIdentifier;
use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Adapter\Adapter;
use Zend\Paginator\Adapter\DbSelect;;
use User\V1\Rest\Login\LoginCollection;
use Zend\Crypt\Password\Bcrypt;
use Zend\Crypt\BlockCipher;
use Zend\Http\Header\AbstractDate;


class LoginMapper
{
    protected $adapter;
    protected $sql;
    protected $table;
   
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->sql = new Sql($adapter);
        $this->table = new TableIdentifier('login');
    }
    
    public function save( $data)
    {
       
        $timezone = date_default_timezone_set('Asia/Kolkata');
        $ctime = date('d-m-y H:i:s');
        $time=date("h:i a",strtotime($ctime));
        $date = date('y-m-d');
       
        $select = new Select("userRegistration");
        $select->columns([
                    'id'            => 'id',
                  
                ]);
        $select->where(['userRegistration.email' => $data->email]);
        $select->where(['userRegistration.password' => $data->password]);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $current = $result->current();
        $userId=$current['id'];
        if ($userId) 
        {
            
            $select = new Select($this->table);
            $select->columns([
                
                'id'=>'id',
                
            
            ]);
           
            $select->where(['userId'=>$userId]);
            $select->where(['date'=>$date]); 
            $statement = $this->sql->prepareStatementForSqlObject($select);
            $result = $statement->execute();
            $current_1 = $result->current();
            if (!$current_1) 
            {
                
                
                $insert = new Insert($this->table);          
                $insert->values([
    
                    'userId'            =>$userId,
                    'status'            =>'1',
                    'date'              =>$date,
                    'loginTime'         =>$time,
    
                ]);
                $statement = $this->sql->prepareStatementForSqlObject($insert);
                $result= $statement->execute();
                $id = $this->adapter->getDriver()->getLastGeneratedValue();
                return[$id];
            }
            else
            {
                
                $update = new Update($this->table);
                $update->set([
    
                    
                    'loginTime'         =>$time,
                    'status'            =>'1',
    
                ]);
                $update->where(['id' => $current_1['id']]);
                $statement = $this->sql->prepareStatementForSqlObject($update);
                
                $result = $statement->execute();
                $id = $current_1['id'];
                $in=on;
                return[$in,$id,];
            }
        }
        else
        {
                $z=f;
                return[$z];
        }
    }

    public function update( $id)
    {
        $select = new Select($this->table);
        $select->columns([
        
            'status'=>'status',
            
        
        ]);
        $select->where(['id'=>$id]);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $current= $result->current();
       
        if ($current['status']==1) 
        {
            $ctime = date('d-m-y H:i:s');
            $time=date("h:i a",strtotime($ctime));
            $update = new Update($this->table);
            $update->set([

                
                'logoutTime'         =>$time,
                'status'            =>'0',

            ]);
            $update->where(['id' => $id]);
            $statement = $this->sql->prepareStatementForSqlObject($update);
            
            $result = $statement->execute();
            return[$id];
        }
        else
        {
            $z=f;
            return[$z];
        }
    }
}
                
              