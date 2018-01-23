<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Conge;
use AppBundle\Entity\Typeconge;
use AppBundle\Entity\User;
use AppBundle\Form\CongeType;
use AppBundle\Form\TypecongeType;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TypeCongeController extends Controller
{
    /**
     * @Route("/showListTypeConge", name="showListTypeConge")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:TypeConge:index.html.twig');
    }

    /**
     * @Route("/listTypeConge", name="listTypeConge")
     */
    public function ajaxListCongeAction(Request $request)
    {
        $data = new JsonResponse($this->selectData(''));

        return $data;
    }

    /**
     * @Route("/create-view-type-conge", name="createViewTypeConge")
     */
    public function createViewCongeAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:TypeConge:add.html.twig');
    }

    /**
     * @Route("/createAddTypeConge", name="createAddTypeConge")
     */
    public function createAddAction(Request $request)
    {
        $typeConge = new Typeconge();
        $form = $this->createForm(TypecongeType::class, $typeConge);
        $form->submit($request->request->all());
        $oManager = $this->getDoctrine()->getManager();
        $oManager->persist($typeConge);
        $oManager->flush();

        return $this->redirect($this->generateUrl('showListTypeConge'));
    }

    /**
     * @Route("/updateBaseStatusTypeConge", name="updateBaseStatusTypeConge")
     */
    public function updateBaseTypeCongeAction(Request $request)
    {
       $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Typeconge')
            ->updateStatus($request->query->get('status'),$request->query->get('id'));

        return $this->redirect($this->generateUrl('showListTypeConge'));
    }

    private function selectData($value)
    {
        $queryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder('U');
        $queryBuilder->add('select', 'T');
        $queryBuilder->add('from', 'AppBundle:Typeconge T');
        $queryBuilder->where('T.id LIKE :search OR T.typecongeName LIKE :search OR T.typecongeStatus LIKE :search');
        $queryBuilder->setParameter('search', '%' . $value . '%');
        $queryBuilder->orderBy('T.id', 'ASC');
        $query = $queryBuilder->getQuery();
        $typeConge = $query->getResult();

        $listTypeConge = [];
        foreach ($typeConge as $tConge) {
            $listTypeConge [] = [
                'idP' => $tConge->getId(),
                'nameType' => $tConge->getTypecongeName(),
                'statusType' => $tConge->getTypecongeStatus(),
            ];
        }


        return $listTypeConge;
    }

}
