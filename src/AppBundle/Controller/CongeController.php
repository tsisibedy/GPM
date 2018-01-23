<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Conge;
use AppBundle\Entity\User;
use AppBundle\Form\CongeType;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CongeController extends Controller
{
    /**
     * @Route("/showListConge", name="showListConge")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Conge:index.html.twig');
    }

    /**
     * @Route("/listConge", name="listConge")
     */
    public function ajaxListCongeAction(Request $request)
    {
        $data = new JsonResponse($this->selectData(''));

        return $data;
    }

    /**
     * @Route("/createViewConge", name="createViewConge")
     */
    public function createViewCongeAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Conge:add.html.twig');
    }

    /**
     * @Route("/createAddConge", name="createAddConge")
     */
    public function createAddAction(Request $request)
    {
        $conge = new Conge();
        $form = $this->createForm(CongeType::class, $conge);
        $form->submit($request->request->all());
        $oManager = $this->getDoctrine()->getManager();
        $oManager->persist($conge);
        $oManager->flush();

        return $this->redirect($this->generateUrl('showListConge'));
    }

    private function selectData($value)
    {
        $queryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder('U');
        $queryBuilder->add('select', 'C');
        $queryBuilder->add('from', 'AppBundle:Conge C');
        $queryBuilder->where('C.id LIKE :search OR C.congeType LIKE :search OR C.congeDateStart LIKE :search OR C.congeDateFin LIKE :search OR C.congeStatus LIKE :search OR C.congeDemandeurId LIKE :search  OR C.congeDateCreate LIKE :search');
        $queryBuilder->setParameter('search', '%' . $value . '%');
        $queryBuilder->orderBy('C.id', 'ASC');
        $query = $queryBuilder->getQuery();
        $conge = $query->getResult();

        $listConge = [];
        foreach ($conge as $Conge) {
            $listConge [] = [
                'idP' => $Conge->getId(),
                'dateFin' => $Conge->getCongeDateFin(),
                'dateStart' => $Conge->getCongeDateStart(),
                'demandeur' => $Conge->getCongeDemandeurId(),
                'statusConge' => $Conge->getCongeStatus(),
                'type' => $Conge->getCongeType(),
                'createConge' => $Conge->getCongeDateCreate(),
            ];
        }


        return $listConge;
    }

}
