<?php

class ApiController extends REST_Controller
{

    public $todo = array(
        "1" => "Buy milk",
        "2" => "Pour glass of milk",
        "3" => "Eat cookies"
    );

    /*
     * used to fetch array to records 
     * http://local.restful-zend-framework-example/api
     * Method : Get
     */

    public function indexAction()
    {
        $this->view->resources = $this->todo;
        $this->getResponse()->setHttpResponseCode(200);
    }

    /*
     * used to fetch single entity record
     * http://local.restful-zend-framework-example/api/id/1
     * Method : Get
     */

    public function getAction()
    {
        $this->view->id = $this->_getParam('id');
        $this->view->resource = new stdClass;
        $this->getResponse()->setHttpResponseCode(200);
    }

    /*
     * http://local.restful-zend-framework-example/api
     * Method POST
     * post data in JSON
     * {
      "1": "Buy milk",
      "2": "Pour glass of milk",
      "3": "Eat cookies"
      }
     */

    public function postAction()
    {
        $rawBody = $this->getRequest()->getRawBody();
        $dataArray = Zend_Json::decode($rawBody);
        $this->view->message = sprintf('Resource #%s POST', $dataArray["1"]);
        $this->getResponse()->setHttpResponseCode(201);
    }

    /*
     * http://local.restful-zend-framework-example/api
     * Method PUT
     * post data in JSON
     * {
      "1": "Buy milk",
      "2": "Pour glass of milk",
      "3": "Eat cookies"
      }
     */

    public function putAction()
    {
        $rawBody = $this->getRequest()->getRawBody();
        $dataArray = Zend_Json::decode($rawBody);
        $this->view->message = sprintf('Resource #%s PUT', $dataArray["1"]);
        $this->getResponse()->setHttpResponseCode(201);
    }

    /*
     * http://local.restful-zend-framework-example/api/id/1
     * Method : Delete
     */

    public function deleteAction()
    {
        $this->view->message = sprintf('Resource #%s Deleted', $this->_getParam('id'));
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function headAction()
    {
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function optionsAction()
    {
        $this->view->message = 'Option is Not in use';
        $this->getResponse()->setHttpResponseCode(200);
    }

}
