<?php


namespace Ups\Entity\Paperless;


/**
 * @author Maciej Kotlarz <maciej.kotlarz@pixers.uk>
 * @copyright 2019 PIXERS Ltd
 */
class FormHistoryDocumentId
{
    /**
     * @var string
     */
    protected $documentId;

    /**
     * @return string
     */
    public function getDocumentId()
    {
        return $this->documentId;
    }

    /**
     * @param string $documentId
     * @return FormHistoryDocumentId
     */
    public function setDocumentId($documentId)
    {
        $this->documentId = $documentId;
        return $this;
    }
}