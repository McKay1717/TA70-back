<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $Description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="users")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="user")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LoginHistory", mappedBy="user")
     */
    private $loginHistories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="user")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Salon", mappedBy="user")
     */
    private $salons;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ListenHistory", mappedBy="user")
     */
    private $listenHistories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SearchHistory", mappedBy="user")
     */
    private $searchHistories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Music", mappedBy="User")
     */
    private $musics;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->loginHistories = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->salons = new ArrayCollection();
        $this->listenHistories = new ArrayCollection();
        $this->searchHistories = new ArrayCollection();
        $this->musics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): self
    {
        $this->Lastname = $Lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(self $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(self $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @return Collection|LoginHistory[]
     */
    public function getLoginHistories(): Collection
    {
        return $this->loginHistories;
    }

    public function addLoginHistory(LoginHistory $loginHistory): self
    {
        if (!$this->loginHistories->contains($loginHistory)) {
            $this->loginHistories[] = $loginHistory;
            $loginHistory->setUser($this);
        }

        return $this;
    }

    public function removeLoginHistory(LoginHistory $loginHistory): self
    {
        if ($this->loginHistories->contains($loginHistory)) {
            $this->loginHistories->removeElement($loginHistory);
            // set the owning side to null (unless already changed)
            if ($loginHistory->getUser() === $this) {
                $loginHistory->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setUser($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getUser() === $this) {
                $message->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Salon[]
     */
    public function getSalons(): Collection
    {
        return $this->salons;
    }

    public function addSalon(Salon $salon): self
    {
        if (!$this->salons->contains($salon)) {
            $this->salons[] = $salon;
            $salon->setUser($this);
        }

        return $this;
    }

    public function removeSalon(Salon $salon): self
    {
        if ($this->salons->contains($salon)) {
            $this->salons->removeElement($salon);
            // set the owning side to null (unless already changed)
            if ($salon->getUser() === $this) {
                $salon->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ListenHistory[]
     */
    public function getListenHistories(): Collection
    {
        return $this->listenHistories;
    }

    public function addListenHistory(ListenHistory $listenHistory): self
    {
        if (!$this->listenHistories->contains($listenHistory)) {
            $this->listenHistories[] = $listenHistory;
            $listenHistory->addUser($this);
        }

        return $this;
    }

    public function removeListenHistory(ListenHistory $listenHistory): self
    {
        if ($this->listenHistories->contains($listenHistory)) {
            $this->listenHistories->removeElement($listenHistory);
            $listenHistory->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|SearchHistory[]
     */
    public function getSearchHistories(): Collection
    {
        return $this->searchHistories;
    }

    public function addSearchHistory(SearchHistory $searchHistory): self
    {
        if (!$this->searchHistories->contains($searchHistory)) {
            $this->searchHistories[] = $searchHistory;
            $searchHistory->addUser($this);
        }

        return $this;
    }

    public function removeSearchHistory(SearchHistory $searchHistory): self
    {
        if ($this->searchHistories->contains($searchHistory)) {
            $this->searchHistories->removeElement($searchHistory);
            $searchHistory->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Music[]
     */
    public function getMusics(): Collection
    {
        return $this->musics;
    }

    public function addMusic(Music $music): self
    {
        if (!$this->musics->contains($music)) {
            $this->musics[] = $music;
            $music->addUser($this);
        }

        return $this;
    }

    public function removeMusic(Music $music): self
    {
        if ($this->musics->contains($music)) {
            $this->musics->removeElement($music);
            $music->removeUser($this);
        }

        return $this;
    }
}
