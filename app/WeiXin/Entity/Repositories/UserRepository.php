<?php

namespace WeiXin\Entity\Repositories;

use Polymer\Repository\Repository;
use Polymer\Utils\FuncUtils;
use WeiXin\Entity\PersonDTO;

/**
 * UsersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends Repository
{
    public function getList(): array
    {
        /*$rsm = new ResultSetMapping();
        $rsm->addEntityResult(User::class, 'user');
        $rsm->addFieldResult('user', 'username', 'username');
        $rsm->addFieldResult('user', 'user_id', 'user_id');
        $rsm->addJoinedEntityResult(UserProfile::class, 'p', 'user', 'user_profile');
        $rsm->addFieldResult('p', 'content', 'content');
        $rsm->addFieldResult('p', 'profile_id', 'profile_id');
        $sql = "SELECT u.username ,u.user_id ,p.content,p.profile_id FROM `user` u LEFT JOIN user_profile p ON u.user_id = p.user_id WHERE p.user_id = 1";
        $nativeQuery = $this->_em->createNativeQuery($sql, $rsm);*/
        //$nativeQuery->setParameter(1 , 1);
        //$arrayResult = $nativeQuery->getResult();
        $obj = $this->find(1);
        /*$queryBuilder = $this->createQueryBuilder("u");
        $maxResults = $queryBuilder
            ->select("u.username,p.content")
            ->leftJoin('u.user_profiles', 'p', Join::WITH, 'p.user_id=u.user_id')
            //->where("u.user_id=1")
            ->getQuery()
            ->getArrayResult();*/
        //$maxResults = $this->createNativeNamedQuery("test")->getArrayResult();
        foreach ($obj->getUserProfiles() as $v) {
            $scalar = FuncUtils::entityToArray($v, ['userProfiles', 'user']);
            print_r($scalar);
            //  print_r($personDTO);
        }
        //$obj = $this->findBy(['user_id'=>2]);
        print_r($obj);
        return [$obj];
    }
}
