<?php
namespace User\V1\Rest\Message;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use \User\V1\Rest\User\UserEntity;
use \Application\Controller\AppAbstractResourceListener;

class MessageResource extends AppAbstractResourceListener
{
    protected $mapper;
    public function __construct(MessageMapper $mapper)
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
        $entity= new MessageEntity();
        $entity->populate($data);
        $data_1= $this->mapper->save($entity);
        $resp[]['messageId']=$data_1;
        $response_info=["status"=>"success","message"=>"Message created Successfully"];
        return $this->processResponse($response_info,$resp);
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $delete=$this->mapper->delete($id);
        
        
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
        $page=0;  
        $params_=$params->toArray();
        if(isset($params_['page']))
        {
            $page=$params_['page'];
            unset($params_['page']);
        }else
        {
            $page=1;
        }

       
        $data= $this->mapper->fetchAll($params_,$page);
        $pagecount=$data[1]['pagecount'];
        $pagenumber=$data[1]['currentpage'];
        unset($data[1]);
        $response_info=["status"=>"success","message"=>"Message Information","items_per_page"=>25,"page_count"=>$pagecount,"current_page"=>$pagenumber];
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
        $data_1= $this->mapper->update($id,$data);
        $response_info=["status"=>"success","message"=>"Message Updated Successfully "];
        return $this->processResponse($response_info);
    }
}
