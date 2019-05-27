<?php

namespace App\Controller;

use App\Document\Category;
use App\Document\Post;
use App\Document\PostsTags;
use App\Document\Tag;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;


class MainController extends Controller
{
    private $data = [];


    public function index(DocumentManager $dm)
    {

        $postsRepo = $dm->getRepository(Post::class);
        $posts = $postsRepo->findAll();

        $categoriesRepo = $dm->getRepository(Category::class);
        $this->data['categories'] = $categoriesRepo->findAll();

        $tagsRepo = $dm->getRepository(Tag::class);
        foreach ($posts as $post) {
            $post->tags = $tagsRepo->findAll();
        }
        $this->data['posts'] = $posts;




        /*return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
        */

        return $this->render('main.html.twig', $this->data);
    }

    public function savePostData(DocumentManager $dm)
    {
        $post = new Post();

        $post->setUrl('post-1');
        $post->setCreatedDate(date('Y-m-d h:i:s'));
        $post->setThumb('750x300.png');
        $post->setDescription('You may specify the number of times to retry connections and queries via the 
        retry_connect and retry_query options in the document manager configuration. These options default to zero, 
        which means that no operations will be retried.');
        $post->setAuthor('Admin');
        $dm->persist($post);

        $id = $post->getId();
        $post->setTitle('Post '.$id.' Title');
        $post->setUrl('post-'.$id);
        $dm->persist($post);


        $dm->flush();
    }

    public function saveTagData(DocumentManager $dm)
    {
        $tag = new Tag();
        $dm->persist($tag);
        $tag->setTitle('Tag Title ['.$tag->getId().']');
        $dm->persist($tag);
        $dm->flush();
    }

    public function savePostsTagsData(DocumentManager $dm, $tagId, $postId)
    {
        $documentItem = new PostsTags();
        $documentItem->setTagId($tagId);
        $documentItem->setPostId($postId);
        $dm->persist($documentItem);
        $dm->flush();
    }

    public function saveCategoryData(DocumentManager $dm, $title)
    {
        $category = new Category();
        $category->setTitle($title);
        $dm->persist($category);
        $dm->flush();
    }

}
