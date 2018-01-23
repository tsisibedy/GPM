<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PersonnelController extends Controller
{
    /**
     * @Route("/showList", name="showList")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Personnel:index.html.twig');
    }

    /**
     * @Route("/listPersonnel", name="listPersonnel")
     */
    public function ajaxListAction(Request $request)
    {
        $data = new JsonResponse($this->selectData(''));

        return $data;
    }

    /**
     * @Route("/createViewPersonnel", name="createViewPersonnel")
     */
    public function createViewAction(Request $request)
    {
        return $this->render('AppBundle:User:add.html.twig');
    }

    /**
     * @Route("/createPersonnel", name="createPersonnel")
     */
    public function createAction(Request $request)
    {
        $listUser = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:User')
            ->findAll();

        $testExist = 0;
        foreach ($listUser as $list) {
            if ($list->getEmail() == $request->request->get('email')) {
                $testExist = 1;
            } elseif ($list->getUsername() == $request->request->get('username')) {
                $testExist = 2;
            }
        }

        if ($testExist == 1) {
            $data[] = [
                'msg' => "Email deja Utiliser",
            ];
            return new JsonResponse($data);
        } elseif ($testExist == 2) {
            $data[] = [
                'msg' => "Username deja Utiliser",
            ];
            return new JsonResponse($data);
        }
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->submit($request->request->all());

        $array [] = $request->request->get('roles');
        $user->setUsername($request->request->get('username'));
        $user->setEmail($request->request->get('email'));
        $user->setPlainPassword($request->request->get('password'));
        $user->setEnabled(1);
        $user->setRoles($array);

        $userManager = $this->get('fos_user.user_manager');
        $userManager->updateUser($user);

        return $this->redirect($this->generateUrl('showList'));
    }

    /**
     * @Route("/searchList", name="searchList")
     */
    public function searchAction(Request $request)
    {

        $data = new JsonResponse($this->selectData($request->request->get('search')));

        return $data;
    }

    private function selectData($value)
    {
        $queryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder('U');
        $queryBuilder->add('select', 'U');
        $queryBuilder->add('from', 'AppBundle:User U');
        $queryBuilder->where('U.id LIKE :search OR U.employerNom LIKE :search OR U.employerPrenom LIKE :search OR U.employerDateNaissance LIKE :search OR U.employerLieuNaissance LIKE :search OR U.employerSexe LIKE :search  OR U.employerSituation LIKE :search  OR U.employerAddresse LIKE :search OR U.employerCin LIKE :search OR U.email LIKE :search');
        $queryBuilder->setParameter('search', '%' . $value . '%');
        $queryBuilder->orderBy('U.id', 'ASC');
        $query = $queryBuilder->getQuery();
        $personnels = $query->getResult();

        $listPersonnels = [];
        foreach ($personnels as $personnel) {
            $listPersonnels [] = [
                'idP' => $personnel->getId(),
                'nom' => $personnel->getEmployerNom(),
                'prenom' => $personnel->getEmployerPrenom(),
                'DateN' => $personnel->getEmployerDateNaissance(),
                'lieu' => $personnel->getEmployerLieuNaissance(),
                'cin' => $personnel->getEmployerCin(),
                'sexe' => $personnel->getEmployerSexe(),
                'situation' => $personnel->getEmployerSituation(),
                'addresse' => $personnel->getEmployerAddresse(),
                'email' => $personnel->getEmail(),
            ];
        }


        return $listPersonnels;
    }

    private function selectOneDate($value)
    {
        $userEdit = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:User')
            ->find($value);


        $listPersonnels [] = [
            'idP' => $userEdit->getId(),
            'nom' => $userEdit->getEmployerNom(),
            'prenom' => $userEdit->getEmployerPrenom(),
            'DateN' => $userEdit->getEmployerDateNaissance(),
            'lieu' => $userEdit->getEmployerLieuNaissance(),
            'cin' => $userEdit->getEmployerCin(),
            'sexe' => $userEdit->getEmployerSexe(),
            'situation' => $userEdit->getEmployerSituation(),
            'addresse' => $userEdit->getEmployerAddresse(),
            'mail' => $userEdit->getEmail(),
        ];

        return $listPersonnels;
    }

    /**
     * @Route("/editPersonnel", name="editPersonnel")
     */
    public function editPersonnelAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Personnel:edit.html.twig', array('id' => $request->query->get('id')));
    }

    /**
     * @Route("/editPersonnelAjax", name="editPersonnelAjax")
     */
    public function editPersonnelAjaxAction(Request $request)
    {
        $data = new JsonResponse($this->selectOneDate($request->request->get('id')));

        return $data;

    }


    /**
     * @Route("/updateBasePersonnel", name="updateBasePersonnel")
     */
    public function updateBasePersonnelAction(Request $request)
    {
        $oEmployer = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:User')
            ->find($request->request->get('idP'));

        $roles [] = $request->request->get('roles');
        $oEmployer->setRoles($roles);
        $oEmployer->setEmail($request->request->get('email'));
        $form = $this->createForm(UserType::class, $oEmployer);
        $form->submit($request->request->all());
        $Manager = $this->getDoctrine()->getManager();
        $Manager->merge($oEmployer);
        $Manager->flush();

        $data = new JsonResponse($this->selectOneDate($request->request->get('idP')));

        return $data;
    }

    /**
     * @Route("/deletePersonnelAjax", name="deletePersonnelAjax")
     */
    public function deletePersonnelAjaxAction(Request $request)
    {
        $oEmployer = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:User')
            ->find($request->query->get('id'));

        $Manager = $this->getDoctrine()->getManager();
        $Manager->remove($oEmployer);
        $Manager->flush();

        return $this->redirect($this->generateUrl('showList'));

    }
}
