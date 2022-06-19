<?php

namespace App\Controller;

use App\Converter\ConverterService;
use App\Repository\RepositoryLocatorTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MeterController extends AbstractController
{
    use RepositoryLocatorTrait;

    /** @var ConverterService */
    private $converterService;

    /** @var EntityManagerInterface */
    private $em;

    public function __construct(ConverterService $converterService, EntityManagerInterface $em)
    {
        $this->converterService = $converterService;
        $this->em = $em;
    }

    public function index(Request $request)
    {
        $units = $this->getUnitRepository()->findAll();
        $substances = $this->getSubstanceRepository()->findAll();

        $unitFrom = $request->get('unit_from');
        //TODO validation


        return $this->render(
            'meter/index.html.twig',
            [
                'controller_name' => 'MeterController',
                'units' => $units,
                'unit_from' => $unitFrom,
                'substances' => $substances,
            ]
        );
    }

    public function convert($substance, $amount, $from, $to)
    {
        var_dump($this->converterService->convert($substance, $amount, $from, $to));

        return new Response('ok');
    }
}
