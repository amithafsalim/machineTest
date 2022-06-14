<?php
namespace User\V1\Rest\User;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use \User\V1\Rest\User\UserEntity;
use \Application\Controller\AppAbstractResourceListener;


class UserResource extends AppAbstractResourceListener
{
     
    protected $mapper;
    public function __construct(UserMapper $mapper)
    {   
        $this->mapper = $mapper;
        
    }
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    { 
      
        $entity= new UserEntity();
        $entity->populate($data);
        $data_1= $this->mapper->save($entity);
        if(!empty($data_1))
        {
            $resp[]['userId']=$data_1;
            $response_info=["status"=>"success","message"=>"User created"];
            return $this->processResponse($response_info,$resp);
        }
        else
        {
            $response_info=["status"=>"error message","message"=>"email id already exists"];
            return $this->processResponse($response_info);
        }
        
    
        
            
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    

    public function fetch($id)
    {
        $identityArray= $this->getIdentity()->getAuthenticationIdentity();
        if($identityArray['user_id'])
        {
            $data=$this->mapper->fetchOne($id);
            $response_info=["status"=>"success","message"=>"User $id information"];
            return $this->processResponse($response_info,$data);
        }
        else
        {
            return new ApiProblem(401, 'Unauthorized Access');
        }
    }

       
    

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {

        
            $params_=$params->toArray();
        
            if(isset($params_['page']))
            {
                $page=$params_['page'];
                unset($params_['page']);
            }else
            {
                $page=1;
                unset($params_['page']);
            }
            
            
            $data=$this->mapper->fetchAll($params_);

            $pagecount=$data[1]['pagecount'];
            $pagenumber=$data[1]['currentpage'];
            unset($data[1]);

            $response_info=["status"=>"success","message"=>"log details","itemsPerPage"=>25,"pagePount"=>$pagecount,"currentPage"=>$pagenumber];
            return $this->processResponse($response_info,$data[0]);
        
       
    }
    

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        $identityArray= $this->getIdentity()->getAuthenticationIdentity();
        if($identityArray['user_id'])
        {
            if($data->parent_id_change)
            {
                $data_1= $this->mapper->update($data,$id);
                $response_info=["status"=>"success","message"=>"User information $data_1 Updated"];
                return $this->processResponse($response_info);
            }
            if($data->user_status)
            {
            
                $data_1= $this->mapper->updateStatus($data,$id);
                $response_info=["status"=>"success","message"=>"User information $data_1 Updated"];
                return $this->processResponse($response_info);
            }
            else
            {
                $data->parent_id=$identityArray['user_id'];
                $data->content_app_id =PG_A_STATUS;
                $data->org_id =PG_A_STATUS;
                $data->device_id =PG_STATUS;
                $entity= new UserEntity();
                $entity->populate($data);
                $data_1= $this->mapper->save($entity,$id);
                $response_info=["status"=>"success","message"=>"User information $data_1 Updated"];
                return $this->processResponse($response_info);
            }
            
        }
        else
        {
            return new ApiProblem(401, 'Unauthorized Access');
        }
    }
}
