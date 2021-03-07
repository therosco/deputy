<?php

namespace Deputy;

use Deputy\DataStructures\TreeIndex;
use Deputy\DataStructures\ManyToOneStorage;
use Exception;

/**
 * Class UserHierarchy
 *
 * This is to encapsulate the input and provided the required functionality.
 *
 * This class in the only one in the app beside validation that is aware of the input data structure.
 *
 * @package Deputy
 */
class UserHierarchy
{
    private TreeIndex $roles;
    private ManyToOneStorage $users;

    /**
     * Sets roles
     *
     * @param array $roles
     */
    public function setRoles(array $roles): void {
        $tree = new TreeIndex();
        foreach ($roles as $role) {
            $tree->addNode($role->Id, $role->Parent);
        }

        $this->roles = $tree;
    }

    /**
     * Sets users
     *
     * @param array $users
     * @throws Exception
     */
    public function setUsers(array $users): void {
        $this->users = new ManyToOneStorage();
        foreach ($users as $user) {
            $this->users->add($user->Id, $user->Role, $user);
        }
    }

    /**
     * Calculates subordinates
     *
     * @param int $userId
     * @return array
     * @throws Exception
     */
    public function getSubOrdinates(int $userId): array {
        $result = [];

        $user = $this->users->getById($userId);
        if (!$user) {
            throw new Exception("Unknown user $userId");
        }

        $childrenRoles = $this->roles->findChildrenNodes($user->Role);
        foreach ($childrenRoles as $roleId) {
            $result = array_merge($result, $this->users->getByRelatedId($roleId));
        }

        return $result;
    }
}