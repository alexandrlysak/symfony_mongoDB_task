<?php

namespace App\Controller;

use App\Document\Category;
use App\Document\Post;
use App\Document\Tag;
use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class DashboardController extends Controller
{
    private $dm;
    private $data = [];
    private $session;

    public function __construct(DocumentManager $dm, SessionInterface $session)
    {
        $this->dm = $dm;
        $this->session = $session;
    }

    public function indexAction()
    {
        if (!$this->isAdminRole()) {
            $this->session->remove('userLogin');
            return $this->redirectToRoute('login');
        }

        $postsRepo = $this->dm->getRepository(Post::class);
        $posts = $postsRepo->findAll();

        $categoriesRepo = $this->dm->getRepository(Category::class);
        $this->data['categories'] = $categoriesRepo->findAll();

        $tagsRepo = $this->dm->getRepository(Tag::class);
        foreach ($posts as $post) {
            $post->tags = $tagsRepo->findAll();
        }
        $this->data['posts'] = $posts;

        return $this->render('dashboard/main.html.twig', $this->data);
    }

    public function deletePostAction(Request $request)
    {
        if(!$request->isXmlHttpRequest()) {
            $this->indexAction();
        }

        if (!$this->isAdminRole()) {
            return $this->json([
                'code' => 0,
                'message' => 'Authenticate Error !!!'
            ]);
        }

        $requestData = $request->request->all();
        if (!$requestData['id'] || $requestData['id'] == '') {
            return $this->json([
                'code' => 0,
                'message' => 'Operation error !!!'
            ]);
        }


        $postsRepo = $this->dm->getRepository(Post::class);

        $post = $postsRepo->find($requestData['id']);
        if (!$post) {
            return $this->json([
                'code' => 0,
                'message' => 'Operation error !!!'
            ]);
        }

        $this->dm->remove($post);
        $this->dm->flush();

        return $this->json([
            'code' => 1,
        ]);
    }

    public function editPostAction($id)
    {
        $this->data['flashMessage'] = $this->session->get('flash');
        $this->session->remove('flash');

        if (!$this->isAdminRole()) {
            $this->session->remove('userLogin');
            return $this->redirectToRoute('login');
        }

        if (!$id || $id == '') {
            $this->indexAction();
        }

        $postsRepo = $this->dm->getRepository(Post::class);
        $post = $postsRepo->find($id);
        if (!$post) {
            $this->indexAction();
        }

        $this->data['postData'] = $post;

        $token = bin2hex(random_bytes(12));
        $this->session->set('csrf_token', $token);

        $form = $this->createFormBuilder()
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Post title *',
                    'value' => $post->getTitle()
                ]
            ])
            ->add('url', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Post url *',
                    'value' => $post->getUrl()
                ]
            ])
            ->add('thumbnail', FileType::class, [
                'attr' => [
                    'class' => 'form-control-file',
                    'data-value' => $post->getThumb()
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 4,

                ],
                'data' => $post->getDescription()
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 4
                ],
                'data' => $post->getContent()
            ])
            ->add('csrf_token', HiddenType::class, [
                'data' => $token,
            ])
            ->getForm();

        $this->data['form'] = $form->createView();
        $this->data['post'] = $post;
        return $this->render('dashboard/post.html.twig', $this->data);
    }

    public function savePostDataAction(Request $request)
    {
        $referer = $request->headers->get('referer');

        $csrfToken = $this->session->get('csrf_token');

        $formData = $request->request->all();

        $this->session->set('flash', 'Hello');

        return $this->redirect($referer);



    }

    public function isAdminRole()
    {
        $currentUser = $this->session->get('userLogin');
        return $currentUser && $currentUser == 'admin';
    }


}