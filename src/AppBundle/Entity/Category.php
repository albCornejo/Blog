<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=100)
     * @Assert\NotBlank(message="The field name cannot be empty")
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      max = 10,
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters"
     * )
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="categories", cascade={"persist", "remove"})
     */
    protected $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Post|null $post
     */
    public function addPost(Post $post = null)
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
        }
        $post->addCategory($this);
    }

    /**
     * @return array
     */
    public function getPosts()
    {
        return $this->posts->toArray();
    }

    /**
     * @param Post $post
     */
    public function removePost(Post $post)
    {
        if (!$this->posts->contains($post)) {
            return;
        }
        $this->posts->removeElement($post);
        $post->removeCategory($this);
    }

    public function removeAllPosts()
    {
        $this->posts->clear();
    }
}
