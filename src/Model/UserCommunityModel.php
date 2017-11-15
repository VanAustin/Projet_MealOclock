<?php

namespace Community\Model;

use Community\Framework\BaseModel;

class UserCommunityModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('users_communities');
    }

    public function findUserCommunities($user_id)
    {
        $sql = 'SELECT * FROM users_communities WHERE user_id = :user_id';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':user_id', intval($user_id), \PDO::PARAM_INT);
        $sth->execute();
        return $res = $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findUserCommunitiesDetails($user_id)
    {
        $sql = 'SELECT c.* FROM users_communities uc LEFT JOIN communities c ON uc.community_id = c.id WHERE uc.user_id = :id';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id', intval($user_id), \PDO::PARAM_INT);
        $sth->execute();
        return $res = $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function setUserCommunities($user_id, $communities = NULL)
    {
        $user_id = intval($user_id);

        $sql = 'DELETE FROM users_communities WHERE user_id = :user_id';
        $queryDelete = $this->db->prepare($sql);
        $queryDelete->bindValue(':user_id', $user_id, \PDO::PARAM_INT);
        $ok = $queryDelete->execute();

        if($communities) {
            $sql = 'INSERT INTO users_communities
            VALUES (:user_id, :community_id)';
            $queryInsert = $this->db->prepare($sql);
            $queryInsert->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $queryInsert->bindParam(':community_id', $community, \PDO::PARAM_INT);
            foreach ($communities as $community) {
                $community = intval($community);
                $test = $queryInsert->execute();
            }
        }
    }

    public function deleteOneCommuFromUser($communityId, $userId)
    {
        $sql = 'DELETE FROM users_communities WHERE user_id = :user_id AND community_id = :community_id';
        $queryDelete = $this->db->prepare($sql);
        $queryDelete->bindValue(':user_id', intval($userId), \PDO::PARAM_INT);
        $queryDelete->bindValue(':community_id', intval($communityId), \PDO::PARAM_INT);
        $ok = $queryDelete->execute();
    }

    public function insertOneCommuFromUser($communityId, $userId)
    {
        $sql = 'INSERT INTO users_communities VALUES (:user_id, :community_id)';
        $queryDelete = $this->db->prepare($sql);
        $queryDelete->bindValue(':user_id', intval($userId), \PDO::PARAM_INT);
        $queryDelete->bindValue(':community_id', intval($communityId), \PDO::PARAM_INT);
        $ok = $queryDelete->execute();
    }

    public function findAllUsersFromCommunityId($id)
    {
        $sql = 'SELECT users.* FROM users_communities LEFT JOIN users ON users_communities.user_id = users.id WHERE users_communities.community_id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', intval($id), \PDO::PARAM_INT);
        $query->execute();
        return $res = $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}

 ?>
