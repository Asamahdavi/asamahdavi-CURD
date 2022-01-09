<?php

namespace CRUD\Controller;

use CRUD\Helper\PersonHelper;
use CRUD\Model\Actions;
use CRUD\Model\Person;

class PersonController
{
    /**
     * @throws \Exception
     */
    public function switcher($uri, $request)
    {
        switch ($uri)
        {
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request);
                break;
            case Actions::READ:
                $this->readAction($request);
                break;
            case Actions::READ_ALL:
                $this->readAllAction($request);
                break;
            case Actions::DELETE:
                $this->deleteAction($request);
                break;
            default:
                break;
        }
    }

    /**
     * @throws \Exception
     */
    public function createAction($request)
    {
//        $firstname=$_POST["FirstName"];
//        $lastName=$_POST["LastName"];
//        $username=$_POST["Username"];
        $firstName=$_POST["FirstName"];
        $lastName=$_POST["LastName"];
        $username=$_POST["Username"];
        $person = new Person($firstName,$lastName,$username);
        $personHelper = new PersonHelper();
        $personHelper->insert($person);
    }

    /**
     * @throws \Exception
     */
    public function updateAction($request)
    {
        $firstName=$_POST["FirstName"];
        $lastName=$_POST["LastName"];
        $username=$_POST["Username"];
        $person = new Person($firstName,$lastName,$username);
        $personHelper = new PersonHelper();
        $personHelper->update($person);
    }

    /**
     * @throws \Exception
     */
    public function readAction($request)
    {
        $id=$_GET["id"];
        $personHelper = new PersonHelper();
        $personHelper->fetch($id);
    }

    /**
     * @throws \Exception
     */
    public function readAllAction($request)
    {
        $personHelper = new PersonHelper();
        $personHelper->fetchAll();
    }

    /**
     * @throws \Exception
     */
    public function deleteAction($request)
    {
        $username=$_POST["Username"];
        $personHelper = new PersonHelper();
        $personHelper->delete($username);
    }

}