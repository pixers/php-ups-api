<?php


namespace Ups\Entity\Paperless;

/**
 * @author Maciej Kotlarz <maciej.kotlarz@pixers.uk>
 * @copyright 2019 PIXERS Ltd
 */
class Upload
{
    /**
     * @var UserCreatedForm
     */
    protected $userCreatedForm;

    /**
     * @var string
     */
    protected $shipperNumber;

    /**
     * @return UserCreatedForm
     */
    public function getUserCreatedForm()
    {
        return $this->userCreatedForm;
    }

    /**
     * @param UserCreatedForm $userCreatedForm
     */
    public function setUserCreatedForm(UserCreatedForm $userCreatedForm)
    {
        $this->userCreatedForm = $userCreatedForm;
    }

    /**
     * @return string
     */
    public function getShipperNumber()
    {
        return $this->shipperNumber;
    }

    /**
     * @param string $shipperNumber
     */
    public function setShipperNumber($shipperNumber)
    {
        $this->shipperNumber = $shipperNumber;
    }
}