<?php


namespace Ups;

use GuzzleHttp\Client;
use Ups\Entity\Paperless\FormHistoryDocumentId;
use Ups\Entity\Paperless\PushToImageRepository;
use Ups\Entity\Paperless\Upload;
use Ups\Entity\Paperless\UserCreatedForm;

/**
 * @author Maciej Kotlarz <maciej.kotlarz@pixers.uk>
 * @copyright 2019 PIXERS Ltd
 */
class Paperless
{
    const ENDPOINT = '/PaperlessDocumentAPI';

    protected $accessKey;
    protected $userId;
    protected $password;
    protected $useIntegration;

    /**
     * Paperless constructor.
     * @param null $accessKey
     * @param null $userId
     * @param null $password
     * @param bool $useIntegration
     */
    public function __construct($accessKey = null, $userId = null, $password = null, $useIntegration = false)
    {
        $this->accessKey = $accessKey;
        $this->userId = $userId;
        $this->password = $password;
        $this->useIntegration = $useIntegration;
    }

    /**
     * @param Upload $uploadRequest
     * @param string $requestOption
     *
     * @return mixed
     */
    public function upload(Upload $uploadRequest, $requestOption = '')
    {
        $payload = $this->createPayload($uploadRequest, $requestOption);
        $guzzle = new Client();
        $response = $guzzle->post($this->getUri(), ['body' => json_encode($payload)]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param PushToImageRepository $pushToImageRepositoryRequest
     * @param string $requestOption
     *
     * @return mixed
     */
    public function pushToImageRepository(PushToImageRepository $pushToImageRepositoryRequest, $requestOption = '')
    {
        $payload = $this->createPushToImageRepositoryPayload($pushToImageRepositoryRequest, $requestOption);
        $guzzle = new Client();
        $response = $guzzle->post($this->getUri(), ['body' => json_encode($payload)]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param Upload $request
     * @param $requestOption string
     *
     * @return array
     */
    protected function createPayload(Upload $request, $requestOption)
    {
        $userCreatedForms = [];

        /** @var UserCreatedForm $userCreatedForm */
        foreach ($request->getUserCreatedForms() as $userCreatedForm) {
            $userCreatedForms[] = $this->createUserCreatedFormPayload($userCreatedForm);
        }

        return [
            'UPSSecurity' => [
                'UsernameToken' => [
                    'Username' => $this->userId,
                    'Password' => $this->password
                ],
                'ServiceAccessToken' => [
                    'AccessLicenseNumber' => $this->accessKey
                ]
            ],
            'UploadRequest' => [
                'ShipperNumber' => $request->getShipperNumber(),
                'Request' => [
                    'RequestOption' => $requestOption
                ],
                'UserCreatedForm' => $userCreatedForms
            ]
        ];
    }

    /**
     * @param UserCreatedForm $userCreatedForm
     * @return array
     */
    protected function createUserCreatedFormPayload(UserCreatedForm $userCreatedForm)
    {
        return [
            'UserCreatedFormFileName' => $userCreatedForm->getUserCreatedFormFileName(),
            'UserCreatedFormFileFormat' => $userCreatedForm->getUserCreatedFormFileFormat(),
            'UserCreatedFormDocumentType' => $userCreatedForm->getUserCreatedFormDocumentType(),
            'UserCreatedFormFile' => $userCreatedForm->getUserCreatedFormFile()
        ];
    }

    /**
     * @param PushToImageRepository $request
     * @param $requestOption
     * @return array
     */
    protected function createPushToImageRepositoryPayload(PushToImageRepository $request, $requestOption)
    {
        $formsHistoryIDs = [];

        /** @var FormHistoryDocumentId $formsIds */
        foreach ($request->getFormsHistoryDocumentIDs() as $formsIds)
        {
            $formsHistoryIDs[] = [
                'DocumentID' => $formsIds->getDocumentId()
            ];
        }

        return [
            'UPSSecurity' => [
                'UsernameToken' => [
                    'Username' => $this->userId,
                    'Password' => $this->password
                ],
                'ServiceAccessToken' => [
                    'AccessLicenseNumber' => $this->accessKey
                ]
            ],
            'PushToImageRepositoryRequest' => [
                'ShipperNumber' => $request->getShipperNumber(),
                'Request' => [
                    'RequestOption' => $requestOption
                ],
                'FormsHistoryDocumentID ' => $formsHistoryIDs,
                'FormsGroupID' => $request->getFormGroupID(),
                'ShipmentIdentifier' => $request->getShipmentIndentifier(),
                'ShipmentDateAndTime' => $request->getShipmentDateAndTime(),
                'ShipmentType ' => $request->getShipmentType(),
                'PRQConfirmationNumber' => $request->getPRQConfirmationNumber(),
                'TrackingNumber' => $request->getTrackingNumber()
            ]
        ];
    }

    /**
     * @return string
     */
    protected function getUri()
    {
        if ($this->useIntegration === true)
        {
            return 'https://wwwcie.ups.com/rest/PaperlessDocumentAPI';
        }

        return 'https://filexfer.ups.com/rest/PaperlessDocumentAPI';
    }
}