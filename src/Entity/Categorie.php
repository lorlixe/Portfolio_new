<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'category_id')]
    private Collection $project_id;

    /**
     * @var Collection<int, Post>
     */
    #[ORM\ManyToMany(targetEntity: Post::class, mappedBy: 'category_id')]
    private Collection $post_id;

    public function __construct()
    {
        $this->project_id = new ArrayCollection();
        $this->post_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjectId(): Collection
    {
        return $this->project_id;
    }

    public function addProjectId(Project $projectId): static
    {
        if (!$this->project_id->contains($projectId)) {
            $this->project_id->add($projectId);
        }

        return $this;
    }

    public function removeProjectId(Project $projectId): static
    {
        $this->project_id->removeElement($projectId);

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPostId(): Collection
    {
        return $this->post_id;
    }

    public function addPostId(Post $postId): static
    {
        if (!$this->post_id->contains($postId)) {
            $this->post_id->add($postId);
        }

        return $this;
    }

    public function removePostId(Post $postId): static
    {
        $this->post_id->removeElement($postId);

        return $this;
    }
}
