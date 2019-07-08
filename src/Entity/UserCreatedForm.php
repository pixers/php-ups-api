<?php


namespace Ups\Entity;


use DOMDocument;
use DOMNode;
use Ups\NodeInterface;

/**
 * @author Maciej Kotlarz <maciej.kotlarz@pixers.uk>
 * @copyright 2019 PIXERS Ltd
 */
class UserCreatedForm implements NodeInterface
{
    /**
     * @var string
     */
    protected $documentID;

    /**
     * @return string
     */
    public function getDocumentID()
    {
        return $this->documentID;
    }

    /**
     * @param string $documentID
     * @return UserCreatedForm
     */
    public function setDocumentID($documentID)
    {
        $this->documentID = $documentID;

        return $this;
    }

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMNode
     */
    public function toNode(DOMDocument $document = null)
    {
        if ($document === null)
        {
            $document = new DOMDocument();
        }

        $node = $document->createElement('UserCreatedForm');
        if ($this->getDocumentID() !== null)
        {
            $node->appendChild($document->createElement('DocumentID', $this->getDocumentID()));
        }

        return $node;
    }
}