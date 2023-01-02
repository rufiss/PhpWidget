<?php
namespace Util;

use Lacuna\Signer\Model\DocumentMarkPrePositionedDocumentMarkModel;
use Lacuna\Signer\Model\DocumentMarkType;
use Lacuna\Signer\Model\DocumentsActionUrlRequest;
use Lacuna\Signer\Model\DocumentsActionUrlResponse;
use Lacuna\Signer\Model\DocumentsCreateDocumentRequest;
use Lacuna\Signer\Model\FlowActionsFlowActionCreateModel;
use Lacuna\Signer\Model\FlowActionType;
use Lacuna\Signer\Model\UsersParticipantUserModel;
use Lacuna\Signer\PhpClient\SignerClient;
use Lacuna\Signer\PhpClient\Models\UploadModel;
use Lacuna\Signer\PhpClient\Builders\FileUploadBuilder;

use function PHPSTORM_META\type;

require __DIR__. '/../vendor/autoload.php';

class Service {

    protected $signerClient;
    protected $endPoint;
    protected $apiKey;

    public function __construct() {
    }
    public function init()
    {
        $this->endPoint = "https://signer-lac.azurewebsites.net/";
        $this->apiKey = "API Sample App|43fc0da834e48b4b840fd6e8c37196cf29f919e5daedba0f1a5ec17406c13a99";
        $this->signerClient = new SignerClient($this->endPoint, $this->apiKey);
    }
    function run($name, $cpf, $email)
    {

        $filePath = "Template-Prescricao.pdf";
        $fileName = basename($filePath);
        $file = fopen($filePath, "r");
        $uploadModel = new UploadModel($this->signerClient->uploadFile($fileName, $file, "application/pdf"));
        fclose($file);

        $fileUploadModelBuilder = new FileUploadBuilder($uploadModel);
        $fileUploadModelBuilder->setDisplayName("Embedded Signature Sample");
        $user = new UsersParticipantUserModel();
        $user->setName($name);
        $user->setEmail($email);
        $user->setIdentifier($cpf);


        $flowActionCreateModel = new FlowActionsFlowActionCreateModel();
        $flowActionCreateModel->setType(FlowActionType::SIGNER);
        $flowActionCreateModel->setUser($user);
        // $mark = new DocumentMarkPrePositionedDocumentMarkModel();
        // $mark->setType(DocumentMarkType::SIGNATURE_VISUAL_REPRESENTATION);
        // $mark->setUploadId($uploadModel->getId());
        // $mark->setTopLeftX(228);
        // $mark->setTopLeftY(652);
        // $mark->setWidth(170.0);
        // $mark->setHeight(40.0);
        // $flowActionCreateModel->setPrePositionedMarks($mark);


        $documentRequest = new DocumentsCreateDocumentRequest();
        $documentRequest->setFiles(
            array($fileUploadModelBuilder->toModel())
        );
        $documentRequest->setFlowActions(
            array($flowActionCreateModel)
        );

        $docResult = $this->signerClient->createDocument($documentRequest)[0];

        $actionUrlRequest = new DocumentsActionUrlRequest();
        $actionUrlRequest->setIdentifier($user->getIdentifier());
        $actionUrlResponse = new DocumentsActionUrlResponse($this->signerClient->getActionUrl($docResult->getDocumentId(), $actionUrlRequest));

        return ($actionUrlResponse->getEmbedUrl());

    }
}

?>
