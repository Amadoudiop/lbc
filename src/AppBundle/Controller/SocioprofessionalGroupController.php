<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SocioprofessionalGroup;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Socioprofessionalgroup controller.
 *
 * @Route("socioprofessionalgroup")
 */
class SocioprofessionalGroupController extends Controller
{
    /**
     * Lists all socioprofessionalGroup entities.
     *
     * @Route("/", name="socioprofessionalgroup_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $socioprofessionalGroups = $em->getRepository('AppBundle:SocioprofessionalGroup')->findAll();

        return $this->render('socioprofessionalgroup/index.html.twig', array(
            'socioprofessionalGroups' => $socioprofessionalGroups,
        ));
    }

    /**
     * Creates a new socioprofessionalGroup entity.
     *
     * @Route("/new", name="socioprofessionalgroup_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $socioprofessionalGroup = new Socioprofessionalgroup();
        $form = $this->createForm('AppBundle\Form\SocioprofessionalGroupType', $socioprofessionalGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($socioprofessionalGroup);
            $em->flush();

            return $this->redirectToRoute('socioprofessionalgroup_show', array('id' => $socioprofessionalGroup->getId()));
        }

        return $this->render('socioprofessionalgroup/new.html.twig', array(
            'socioprofessionalGroup' => $socioprofessionalGroup,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a socioprofessionalGroup entity.
     *
     * @Route("/{id}", name="socioprofessionalgroup_show")
     * @Method("GET")
     */
    public function showAction(SocioprofessionalGroup $socioprofessionalGroup)
    {
        $deleteForm = $this->createDeleteForm($socioprofessionalGroup);

        return $this->render('socioprofessionalgroup/show.html.twig', array(
            'socioprofessionalGroup' => $socioprofessionalGroup,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing socioprofessionalGroup entity.
     *
     * @Route("/{id}/edit", name="socioprofessionalgroup_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SocioprofessionalGroup $socioprofessionalGroup)
    {
        $deleteForm = $this->createDeleteForm($socioprofessionalGroup);
        $editForm = $this->createForm('AppBundle\Form\SocioprofessionalGroupType', $socioprofessionalGroup);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('socioprofessionalgroup_edit', array('id' => $socioprofessionalGroup->getId()));
        }

        return $this->render('socioprofessionalgroup/edit.html.twig', array(
            'socioprofessionalGroup' => $socioprofessionalGroup,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a socioprofessionalGroup entity.
     *
     * @Route("/{id}", name="socioprofessionalgroup_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SocioprofessionalGroup $socioprofessionalGroup)
    {
        $form = $this->createDeleteForm($socioprofessionalGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($socioprofessionalGroup);
            $em->flush();
        }

        return $this->redirectToRoute('socioprofessionalgroup_index');
    }

    /**
     * Creates a form to delete a socioprofessionalGroup entity.
     *
     * @param SocioprofessionalGroup $socioprofessionalGroup The socioprofessionalGroup entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SocioprofessionalGroup $socioprofessionalGroup)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('socioprofessionalgroup_delete', array('id' => $socioprofessionalGroup->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
