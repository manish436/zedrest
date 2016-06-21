<?php

class REST_Controller_Plugin_RestHandler extends Zend_Controller_Plugin_Abstract
{

    private $availableMimeTypes = array(
        'php' => 'text/php',
        'xml' => 'application/xml',
        'json' => 'application/json',
        'amf' => 'application/octet-stream',
        'urlencoded' => 'application/x-www-form-urlencoded'
    );

    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $this->getResponse()->setHeader('Vary', 'Accept');

        $mimeType = $this->getMimeType($request->getHeader('Accept'));

        switch ($mimeType) {
            case 'text/xml':
            case 'application/xml':
                $request->setParam('format', 'xml');
                break;

            case 'application/octet-stream':
                $request->setParam('format', 'amf');
                break;

            case 'text/php':
                $request->setParam('format', 'php');
                break;

            case 'application/json':
            default:
                $request->setParam('format', 'json');
                break;
        }
    }

    private function getMimeType($mimeTypes = null)
    {
        // Values will be stored in this array
        $AcceptTypes = Array();

        // Accept header is case insensitive, and whitespace isn't important
        $accept = strtolower(str_replace(' ', '', $mimeTypes));

        // divide it into parts in the place of a ","
        $accept = explode(',', $accept);

        foreach ($accept as $a) {
            // the default quality is 1.
            $q = 1;

            // check if there is a different quality
            if (strpos($a, ';q=')) {
                // divide "mime/type;q=X" into two parts: "mime/type" i "X"
                list($a, $q) = explode(';q=', $a);
            }

            // mime-type $a is accepted with the quality $q
            // WARNING: $q == 0 means, that mime-type isn't supported!
            $AcceptTypes[$a] = $q;
        }

        arsort($AcceptTypes);

        // let's check our supported types:
        foreach ($AcceptTypes as $mime => $q) {
            if ($q && in_array($mime, $this->availableMimeTypes)) {
                return $mime;
            }
        }
        // no mime-type found
        return null;
    }

}
