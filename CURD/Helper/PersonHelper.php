<?php


namespace CRUD\Helper;
use CRUD\Model\Person;
use PDO;
class PersonHelper
{
    /**
     * @throws \Exception
     */
    public function insert(Person $person_instance)
    {
        //CREATE INSTANCE
        $firstname =trim( $person_instance->getFirstName());
        $lastname = trim($person_instance->getLastName());
        $username =trim( $person_instance->getUsername());
        // USE DBconnector CLASS TO GET
        $connection = new \CRUD\Helper\DBConnector();
        //USE CONNECT FUNCTION
        $connection->connect();
        $conn=$connection->getConnection();

        $sth=$conn->prepare("INSERT INTO mycuddb (FirstName, LastName, Username)
                SELECT * FROM (SELECT '$firstname', '$lastname', '$username') AS tmp
                WHERE NOT EXISTS (
                        SELECT Username FROM Person WHERE Username = '$username'
                    ) LIMIT 1");

        $sth->execute();
        $count = $sth->rowCount();
//        $sql = "INSERT INTO mycurddb (Fname, lName, uName)
//                VLUES ($firstname,$lastname,$username)";
        // use exec() because no results are returned
//        $conn->exec($sql);
        if($conn->rowCount()){
            $message="<br>  username: ".$username." Created successfully. New Row added to database";
        }else{
            $message="<br> not created";
        }

        echo $message;

    }

    /**
     * @throws \Exception
     */
    public function fetch(int $id)
    {
        $connection = new \CRUD\Helper\DBConnector();
        $connection->connect();
        $conn=$connection->getConnection();
        $temp=$conn->prepare("select * from mycurddb where id=$id");
        $temp->execute();
        $connectionR = $temp->fetch(PDO::FETCH_ASSOC);
        if($connectionR!=false){
            echo "id: ".$connectionR['id']." FirstName: ".$connectionR['fName'].
                " LastName: ".$connectionR['lName']." Username: ".$connectionR['uName'];
        }else{
            echo "user not found.";
        }

    }

    /**
     * @throws \Exception
     */
    public function fetchAll()
    {
        $connection = new \CRUD\Helper\DBConnector();
        $connection->connect();
        $conn=$connection->getConnection();
        $sth=$conn->prepare("select * from mycurddb");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        echo "<table><thead> <th>id</th> <th>FirstName</th> <th>LastName</th> <th>Username</th></thead>";
        echo "<tbody> ";
        foreach ($result as $val){
            echo "<tr>";
            echo " <td> ".$val['id']." </td><td> ".$val['fName'].
                " </td><td> ".$val['lName']." </td><td> ".$val['uName'];
            echo "</td> </tr>";
        }
        echo "</tbody> </table>";
    }

    /**
     * @throws \Exception
     */
    public function update(Person $person_instance)
    {
        //CREATE INSTANCE
        $firstname = $person_instance->getFirstName();
        $lastname = $person_instance->getLastName();
        $username= $person_instance->getUsername();
        // USE CONNECTION CLASS TO UPDATE
        $connection = new \CRUD\Helper\DBConnector();
        $connection->connect();
        $conn=$connection->getConnection();
        // SET THE QUERY TO UPDATE
        $pre=$conn->prepare("UPDATE mycurddb
                SET fName='$firstname',lName='$lastname'
                WHERE uName='$username'");
        $pre->execute();

        if($pre->rowCount()){
            $message="<br> updated successfully.";
        }else{
            $message="<br> not updated";
        }
        echo $message;
    }

    /**
     * @throws \Exception
     */
    public function delete($username)
    {
        $connection = new \CRUD\Helper\DBConnector();
        $connection->connect();
        $conn=$connection->getConnection();
        $pre=$conn->prepare("DELETE FROM mycurddb
                where username='$username'");
        $pre->execute();
        if($pre->rowCount()){
            $message="<br> username: ".$username."the user deleted successfully.";
        }else{
            $message="<br> not deleted";
        }
        echo $message;
    }

}