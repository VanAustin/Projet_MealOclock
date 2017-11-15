<?php

namespace Community\Controller;

use Community\Framework\BaseController;
use Community\Model\CommunityModel;
use Community\Model\UserCommunityModel;

class CommunityController extends BaseController
{
    /**
     * home page
     */
    public function home()
    {
        $communityModel = new CommunityModel();
        $communities = $communityModel->findAll();
        echo $this->templates->render('community/home', array('communities' => $communities));
    }
    public function community($params)
    {

            if(empty($_POST)) {
            extract($params);
            $communityModel = new CommunityModel();
            $community = $communityModel->findById($id);

            $userCommunityModel = new UserCommunityModel();
            $userCommunities = $userCommunityModel->findUserCommunities($this->user['id']);

            $communityMembers = $userCommunityModel->findAllUsersFromCommunityId($community['id']);

            $joined = false;
            if(!empty($userCommunities)) {
                foreach ($userCommunities as $userCommunity) {
                    if($userCommunity['community_id'] === $community['id']) {
                        $joined = true;
                    }
                }
            }

            echo $this->templates->render('community/community_single', array(
                'community' => $community,
                'userCommunities' => $userCommunities,
                'communityMembers' => $communityMembers,
                'joined' => $joined
            ));
        }

        $userCommunityModel = new UserCommunityModel();

        if(isset($_POST['delete'])) {
            $userCommunityModel->deleteOneCommuFromUser($_POST['community_id'], $_POST['user_id']);
            header('Location: ' . $this->router->generate('community', array('id' => $_POST['community_id'])));
        }

        if(isset($_POST['insert'])) {
            $userCommunityModel->deleteOneCommuFromUser($_POST['community_id'], $_POST['user_id']);
            $userCommunityModel->insertOneCommuFromUser($_POST['community_id'], $_POST['user_id']);
            header('Location: ' . $this->router->generate('community', array('id' => $_POST['community_id'])));
        }
    }
}


 ?>
