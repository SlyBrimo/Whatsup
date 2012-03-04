<?php

namespace Whatsup\SUPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Whatsup\SUPBundle\Entity\Venue;
use Whatsup\SUPBundle\Form\VenueType;
use Whatsup\SUPBundle\Helper\Calendar;

/**
 * Venue controller.
 *
 * @Route("/venue")
 */
class VenueController extends Controller
{
    /**
     * Lists all Venue entities.
     *
     * @Route("/", name="venue")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('WhatsupSUPBundle:Venue')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Venue entity.
     *
     * @Route("/{id}/show", name="venue_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $venue = $em->getRepository('WhatsupSUPBundle:Venue')->find($id);
		$e = $venue->getEvents();
		$calendar = new Calendar($venue->getEvents());

        if (!$venue) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'venue'      => $venue,
			'calendar'   => $calendar,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Venue entity.
     *
     * @Route("/new", name="venue_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Venue();
        $form   = $this->createForm(new VenueType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Venue entity.
     *
     * @Route("/create", name="venue_create")
     * @Method("post")
     * @Template("WhatsupSUPBundle:Venue:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Venue();
        $request = $this->getRequest();
        $form    = $this->createForm(new VenueType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('venue_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Venue entity.
     *
     * @Route("/{id}/edit", name="venue_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('WhatsupSUPBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $editForm = $this->createForm(new VenueType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Venue entity.
     *
     * @Route("/{id}/update", name="venue_update")
     * @Method("post")
     * @Template("WhatsupSUPBundle:Venue:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('WhatsupSUPBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $editForm   = $this->createForm(new VenueType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('venue_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Venue entity.
     *
     * @Route("/{id}/delete", name="venue_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('WhatsupSUPBundle:Venue')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Venue entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('venue'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Loads events from a Venue.
     *
     * @Route("/{id}/events.{_format}", name="events", defaults={"_format"="json"}, requirements={"_format"="json"})
	 * @Method("get")
     */
	public function eventsAction($id){
		$em = $this->getDoctrine()->getEntityManager();
		
		$request = $this->getRequest();
		$start = $request->query->get('start'); 
		$end = $request->query->get('end'); 
		
		$events = $em->getRepository('WhatsupSUPBundle:Venue')
		            ->findEventsWithinDateRange($id, $start, $end);
		
		return new Response(json_encode($events));
	}
}
