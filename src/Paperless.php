<?php


namespace Ups;

use GuzzleHttp\Client;
use Ups\Entity\Upload;

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
        $payload = $this->createUploadRequestPayload($uploadRequest, $requestOption);
        $guzzle = new Client();

        return json_decode($guzzle->post($this->getUri(), ['body' => json_encode($payload) ]), true);
    }

    /**
     * @param Upload $request
     * @param $requestOption string
     *
     * @return array
     */
    protected function createUploadRequestPayload(Upload $request, $requestOption)
    {
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
                'UserCreatedForm' => [
                    'UserCreatedFormFileName' => $request->getUserCreatedForm()->getUserCreatedFormFileName(),
                    'UserCreatedFormFileFormat' => $request->getUserCreatedForm()->getUserCreatedFormFileFormat(),
                    'UserCreatedFormDocumentType' => $request->getUserCreatedForm()->getUserCreatedFormDocumentType(),
                    'UserCreatedFormFile' => $request->getUserCreatedForm()->getUserCreatedFormFile()
                ]
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