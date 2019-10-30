<?php


namespace Ups\Entity\Paperless;


/**
 * @author Maciej Kotlarz <maciej.kotlarz@pixers.uk>
 * @copyright 2019 PIXERS Ltd
 */
class PushToImageRepository
{
    /**
     * @var string
     */
    protected $shipperNumber;

    /**
     * @var array
     */
    protected $formsHistoryDocumentIDs;

    /**
     * @var string
     */
    protected $formGroupID;

    /**
     * @var string
     */
    protected $shipmentIndentifier;

    /**
     * @var string
     */
    protected $shipmentDateAndTime;

    /**
     * @var string
     */
    protected $PRQConfirmationNumber;

    /**
     * @var string
     */
    protected $trackingNumber;

    /**
     * @var string
     */
    protected $shipmentType;

    /**
     * @return string
     */
    public function getShipperNumber()
    {
        return $this->shipperNumber;
    }

    /**
     * @param string $shipperNumber
     * @return PushToImageRepository
     */
    public function setShipperNumber($shipperNumber)
    {
        $this->shipperNumber = $shipperNumber;
        return $this;
    }

    /**
     * @return array
     */
    public function getFormsHistoryDocumentIDs()
    {
        return $this->formsHistoryDocumentIDs;
    }

    /**
     * @param array $formsHistoryDocumentIDs
     * @return PushToImageRepository
     */
    public function setFormsHistoryDocumentIDs($formsHistoryDocumentIDs)
    {
        $this->formsHistoryDocumentIDs = $formsHistoryDocumentIDs;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormGroupID()
    {
        return $this->formGroupID;
    }

    /**
     * @param string $formGroupID
     * @return PushToImageRepository
     */
    public function setFormGroupID($formGroupID)
    {
        $this->formGroupID = $formGroupID;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentIndentifier()
    {
        return $this->shipmentIndentifier;
    }

    /**
     * @param string $shipmentIndentifier
     * @return PushToImageRepository
     */
    public function setShipmentIndentifier($shipmentIndentifier)
    {
        $this->shipmentIndentifier = $shipmentIndentifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentDateAndTime()
    {
        return $this->shipmentDateAndTime;
    }

    /**
     * @param string $shipmentDateAndTime
     * @return PushToImageRepository
     */
    public function setShipmentDateAndTime($shipmentDateAndTime)
    {
        $this->shipmentDateAndTime = $shipmentDateAndTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getPRQConfirmationNumber()
    {
        return $this->PRQConfirmationNumber;
    }

    /**
     * @param string $PRQConfirmationNumber
     * @return PushToImageRepository
     */
    public function setPRQConfirmationNumber($PRQConfirmationNumber)
    {
        $this->PRQConfirmationNumber = $PRQConfirmationNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    /**
     * @param string $trackingNumber
     * @return PushToImageRepository
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentType()
    {
        return $this->shipmentType;
    }

    /**
     * @param $shipmentType
     * @return $this
     */
    public function setShipmentType($shipmentType)
    {
        $this->shipmentType = $shipmentType;
        return $this;
    }
}