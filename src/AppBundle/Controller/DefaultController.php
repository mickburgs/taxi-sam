<?php

namespace AppBundle\Controller;

use AppBundle\Form\AppointmentForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\Translator;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $sendForm = false;
        $formError = false;

        $form = $this->createForm(AppointmentForm::class);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted()) {

                if ($form->isValid()) {
                    $sendForm = true;
                } else {
                    $formError = true;
                }
            }
        }

        $this->getLang();
        return $this->render('AppBundle:default:index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'carousel' => true,
            'sendForm' => $sendForm,
            'formError' => $formError,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/taal/{lang}", name="language")
     */
    public function langAction(Request $request, $lang)
    {
        $this->setLang($lang);
        $referer = $request->headers->get('referer');

        if (!empty($referer)) {
            return $this->redirect($referer);
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $this->getLang();


        return $this->render('AppBundle:default:contact.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    private function setLang($lang)
    {
        /** @var Session $session */
        $session = $this->get('session');
        if (in_array($lang, $this->getLangConfig())) {
            $session->set('lang', $lang);
        }
    }

    private function getLang()
    {
        /** @var Session $session */
        $session = $this->get('session');
        if ($session->has('lang') && !empty($session->get('lang'))) {
            $lang = $session->get('lang');
            if (in_array($lang, $this->getLangConfig())) {
                /** @var Translator $translator */
                $translator = $this->get('translator');
                $translator->setLocale($lang);
            }
        }
    }

    private function getLangConfig()
    {
        return ['en', 'nl'];
    }
}
