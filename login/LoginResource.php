<?php
namespace User\V1\Rest\Login;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use \User\V1\Rest\Login\LoginEntity;
use \Application\Controller\AppAbstractResourceListener;


class LoginResource extends AppAbstractResourceListener
{
    protected $mapper;
    public function __construct(LoginMapper $mapper)
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
        $data_1= $this->mapper->save($data);
        if($data_1[0] == ('on'))
        
        {
            $resp[]['logId']=$data_1[1];
            $response_info=["status"=>"success","message"=>"User is already logged in "];
            return $this->processResponse($response_info,$resp);
        }
        elseif($data_1[0]==('f'))
        {
            
            
            $response_info=["status"=>"error message","message"=> "No user Found,Kindly register"];
            return $this->processResponse($response_info);
        }
        else
        {
            $resp[]['logId']=$data_1[0];
            $response_info=["status"=>"success","message"=>"User logged in successfully "];
            return $this->processResponse($response_info,$resp);
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
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        return new ApiProblem(405, 'The GET method has not been defined for collections');
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
    public function update($id)
    {
        $data_1= $this->mapper->update($id);
        if($data_1[0]==('f'))
        {
            $response_info=["status"=>"error message","message"=> "You are not logged in!"];
            return $this->processResponse($response_info);
        }else
        {
            $response_info=["status"=>"success","message"=>"User logged out Successfully "];
            return $this->processResponse($response_info);
        }
        
    }
}
