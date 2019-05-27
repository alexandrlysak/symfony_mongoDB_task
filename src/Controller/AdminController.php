<?php
namespace App\Controller;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdminController extends Controller
{
    private $data = [];
    private $dm;
    private $session;

    public function __construct(DocumentManager $dm, SessionInterface $session)
    {
        $this->dm = $dm;
        $this->session = $session;
    }

    public function authLoginAction(Request $request)
    {
        $csrfToken = $this->session->get('csrf_token');

        $formData = $request->request->all();

        if (!$formData['form']['login'] || $formData['form']['login'] == '') {
            return $this->redirectToRoute('login');
        }

        if (!$formData['form']['password'] || $formData['form']['password'] == '') {
            return $this->redirectToRoute('login');
        }

        if (!$formData['form']['csrf_token'] || $formData['form']['csrf_token'] == '' || $formData['form']['csrf_token'] !== $csrfToken) {
            return $this->redirectToRoute('login');
        }

        $user = $this->dm->getRepository(User::class)->findOneBy([
            'login' => $formData['form']['login'],
            'password' => md5($formData['form']['password'])
        ]);

        if ($user && $user->getRole() == 'admin') {
            $this->session->set('userLogin', $user->getLogin());
            return $this->redirectToRoute('dashboard');
        } else {
            $this->session->remove('userLogin');
            return $this->redirectToRoute('login');
        }
    }

    public function authLogoutAction()
    {
        $this->session->remove('userLogin');
        return $this->redirectToRoute('frontend_main');
    }


    public function loginAction(Request $request)
    {
        $this->session->remove('userLogin');

        $token = bin2hex(random_bytes(12));
        $this->session->set('csrf_token', $token);

        $form = $this->createFormBuilder()
            ->add('login', TextType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Login *'
                ),
                'label' => FALSE
            ])
            ->add('password', PasswordType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Password *'
                ),
                'label' => FALSE
            ])
            ->add('csrf_token', HiddenType::class, [
                'data' => $token,
            ])
            ->getForm();

        $form->handleRequest($request);
        $this->data['form'] = $form->createView();

        return $this->render('login.html.twig', $this->data);
    }
}
