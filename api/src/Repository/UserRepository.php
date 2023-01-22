<?php

namespace App\Repository;

use App\Entity\Types\Email\Email;
use App\Entity\Types\Id\Id;
use App\Entity\User\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DomainException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (! $user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user);
    }

    /**
     * @param \App\Entity\Types\Email\Email $email
     *
     * @return bool
     */
    public function hasByEmail(Email $email): bool
    {
        return count(
                $this->getEntityManager()->getRepository(User::class)->findBy(['email' => $email->getValue()])
            ) > 0;
    }

    /**
     * @param \App\Entity\Types\Id\Id $id
     *
     * @return \App\Entity\User\User
     */
    public function get(Id $id): User
    {
        $user = $this->find($id->getValue());

        if ($user instanceof User) {
            return $user;
        }

        throw new DomainException('User not found');
    }
}
