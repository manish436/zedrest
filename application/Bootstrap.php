<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initActionHelpers()
    {
        $contextSwitch = new REST_Controller_Action_Helper_ContextSwitch();
        Zend_Controller_Action_HelperBroker::addHelper($contextSwitch);

        $restContexts = new REST_Controller_Action_Helper_RestContexts();
        Zend_Controller_Action_HelperBroker::addHelper($restContexts);
    }

}
