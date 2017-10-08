<?php

namespace AppBundle\Controller;

use AppBundle\Form\AppointmentForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\Translator;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->controllerAction($request, 'AppBundle:default:index.html.twig');
    }

    /**
     * @Route("/service", name="service")
     */
    public function serviceAction(Request $request)
    {
        return $this->controllerAction($request, 'AppBundle:default:service.html.twig');
    }

    /**
     * @Route("/zakelijk", name="zakelijk")
     */
    public function businessAction(Request $request)
    {
        return $this->controllerAction($request, 'AppBundle:default:business.html.twig');

    }

    /**
     * @param Request $request
     * @param string $template
     * @return Response
     */
    private function controllerAction(Request $request, $template)
    {
        $sendForm = false;
        $formError = false;
        $lang = 'nl';

        $session = $this->get('session');
        if ($session->has('lang') && !empty($session->get('lang'))) {
            $lang = $session->get('lang');
        }

        $form = $this->createForm(AppointmentForm::class);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted()) {

                if ($form->isValid()) {
                    $sendForm = true;
                    $this->sendAppointmentFormMail($form);

                } else {
                    $formError = true;
                }
            }
        }

        $this->getLang();
        return $this->render($template, [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'carousel' => true,
            'sendForm' => $sendForm,
            'formError' => $formError,
            'lang' => $lang,
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

    /**
     * @param $lang
     */
    private function setLang($lang)
    {
        /** @var Session $session */
        $session = $this->get('session');
        if (in_array($lang, $this->getLangConfig())) {
            $session->set('lang', $lang);
        }
    }

    /**
     *
     */
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

    /**
     * @return array
     */
    private function getLangConfig()
    {
        return ['en', 'nl'];
    }

    /**
     * @param Form $form
     */
    private function sendAppointmentFormMail(Form $form)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Afpsraak formulier')
            ->setFrom('info@servicetaxiflevoland.nl')
            ->setTo('info@servicetaxiflevoland.nl')
            ->setBody(
                $this->renderView(
                    'AppBundle:mails:appointment.html.twig',
                    [
                        'name' => $form->get('name')->getData(),
                        'phone' => $form->get('phone')->getData(),
                        'emailaddress' => $form->get('emailaddress')->getData(),
                        'date' => $form->get('date')->getData(),
                        'pickup_location' => $form->get('pickup_location')->getData(),
                        'drop_location' => $form->get('drop_location')->getData(),
                        'description' => $form->get('description')->getData(),
                    ]
                ),
                'text/html'
            );

        /** @var \Swift_Mailer $mailer */
        $mailer = $this->get('mailer');

        $mailer->send($message);
    }
}
