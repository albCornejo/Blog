<?php

//namespace AppBundle\Entity;
//
//use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints as Assert;
//
///**
// * Post
// *
// * @ORM\Table(name="post")
// * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
// */
//class Post
//{
//    /**
//     * @var int
//     *
//     * @ORM\Column(name="id", type="integer")
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="AUTO")
//     */
//    private $id;
//
//    /**
//     * @var string
//     * @Assert\NotBlank(message="El campo title no puede estar vacío")
//     * @Assert\Length(
//     *      min = 2,
//     *      minMessage = "El título no puede tener menos de 2 caracteres",
//     *      max = 10,
//     *      maxMessage = "El título no puede tener más de 10 caracteres",
//     * )
//     * @ORM\Column(name="title", type="string", length=100)
//     */
//    private $title;
//
//    /**
//     * @var string
//     * @Assert\NotBlank(message="El campo body no puede estar vacío")
//     * @ORM\Column(name="body", type="text")
//     */
//    private $body;
//
//
//    /**
//     * Get id
//     *
//     * @return int
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * Set title
//     *
//     * @param string $title
//     *
//     * @return Post
//     */
//    public function setTitle($title)
//    {
//        $this->title = $title;
//
//        return $this;
//    }
//
//    /**
//     * Get title
//     *
//     * @return string
//     */
//    public function getTitle()
//    {
//        return $this->title;
//    }
//
//    /**
//     * Set body
//     *
//     * @param string $body
//     *
//     * @return Post
//     */
//    public function setBody($body)
//    {
//        $this->body = $body;
//
//        return $this;
//    }
//
//    /**
//     * Get body
//     *
//     * @return string
//     */
//    public function getBody()
//    {
//        return $this->body;
//    }
//}






namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=100)
     * @Assert\NotBlank(message="The field title cannot be empty")
     */
    protected $title;

    /**
     * @var string
     * @Assert\NotBlank(message="The field title cannot be empty")
     * @ORM\Column(name="body", type="text")
     */
    protected $body;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="posts", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="posts_categories")
     *
     * @Assert\Count(
     *      min = "1",
     *      minMessage = "You must specify at least one category"
     * )
     */
    protected $categories;

    /**
     * Tag constructor.
     */
    public function __construct() {
        $this->categories = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param Category|null $category
     * @return $this
     */
    public function addCategory(Category $category = null)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories->toArray();
    }

    /**
     * @param Category $category
     */
    public function removeCategory(Category $category)
    {
        if (!$this->categories->contains($category)) {
            return;
        }
        $this->categories->removeElement($category);
        $category->removePost($this);
    }

    public function removeAllCategories()
    {
        $this->categories->clear();
    }
}