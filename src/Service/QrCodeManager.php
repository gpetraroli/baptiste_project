<?php

namespace App\Service;

use App\Entity\Facility;
use App\Entity\HeatActivity;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class QrCodeManager
{
    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }

    public function createQrCode(HeatActivity $heatActivity): string
    {
        $imageData = file_get_contents('http://api.qrserver.com/v1/create-qr-code/?data=' . $heatActivity->getEntryLink() . '&size=100x100');

        $projectDir = $this->parameterBag->get('kernel.project_dir');
        $relativeDir = '/public/images/qr_codes/';
        $fileName = $heatActivity->getLabel() . '-' . uniqid() . '.png';

        file_put_contents($projectDir . $relativeDir . $fileName, $imageData);

        return $fileName;
    }
}
