<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HashTest;
use AppBundle\Hashtest\HashApiClient;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Hashtest controller.
 *
 * @Route("hashtest")
 */
class HashTestController extends Controller
{
    /**
     * Lists all hashTest entities.
     *
     * @Route("/", name="hashtest_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $hashTests = $em->getRepository('AppBundle:HashTest')->findAll();

        return $this->render('hashtest/index.html.twig', array(
            'hashTests' => $hashTests,
        ));
    }

    /**
     * Creates a new hashTest entity.
     *
     * @Route("/new", name="hashtest_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $hashTest = new Hashtest();
        $form = $this->createForm('AppBundle\Form\HashTestType', $hashTest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getHash($hashTest);
            $em = $this->getDoctrine()->getManager();
            $em->persist($hashTest);
            $em->flush($hashTest);

//            return $this->redirectToRoute('hashtest_show', array('id' => $hashTest->getId()));
            return $this->redirectToRoute('thanks');
        }

        return $this->render('hashtest/new.html.twig', array(
            'hashTest' => $hashTest,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a hashTest entity.
     *
     * @Route("/{id}", name="hashtest_show")
     * @Method("GET")
     */
    public function showAction(HashTest $hashTest)
    {
        $deleteForm = $this->createDeleteForm($hashTest);

        return $this->render('hashtest/show.html.twig', array(
            'hashTest' => $hashTest,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing hashTest entity.
     *
     * @Route("/{id}/edit", name="hashtest_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, HashTest $hashTest)
    {
        $deleteForm = $this->createDeleteForm($hashTest);
        $editForm = $this->createForm('AppBundle\Form\HashTestType', $hashTest);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getHash($hashTest);

            $this->getDoctrine()->getManager()->flush();

//            return $this->redirectToRoute('hashtest_edit', array('id' => $hashTest->getId()));
            return $this->redirectToRoute('hashtest_show', array('id' => $hashTest->getId()));

        }

        return $this->render('hashtest/edit.html.twig', array(
            'hashTest' => $hashTest,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a hashTest entity.
     *
     * @Route("/{id}", name="hashtest_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, HashTest $hashTest)
    {
        $form = $this->createDeleteForm($hashTest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hashTest);
            $em->flush($hashTest);
        }

        return $this->redirectToRoute('hashtest_index');
    }

    /**
     * Creates a form to delete a hashTest entity.
     *
     * @param HashTest $hashTest The hashTest entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(HashTest $hashTest)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hashtest_delete', array('id' => $hashTest->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    private function getHash($hashTest) {
        $hashTest->setHash(HashApiClient::getHash(
            [
                'firstname'=>$hashTest->getFirstname(), 
                'lastname'=>$hashTest->getLastname()
            ]
        ));
    }
    
}
