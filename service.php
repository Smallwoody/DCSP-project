<?php
class service
{
    public $ServiceID;
    public $Name;
    public $Price;
    public $Desc;

    function __construct($id,$name,$desc,$price)
    {
        $this->ServiceID = $id;
        $this->Name = $name;
        $this->Desc = $desc;
        $this->Price = $price;
    }

    //this returns a list of services for the user to choose from
    function getServices()
    {
        $query = "SELECT * FROM `services`";
        $results = $this->SubmitQuery($query);

        $ServicesList[] = new service("","","","");
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            $ServicesList[] = new service (
                                $result['ServiceID'],
                                $result['Name'],
                                $result['Description'],
                                $result['Price']);
        }
        return $ServicesList;
    }

    // gets items that are within a package
    private function getPackageServices($id)
    {
        $query = "select 
                        s.ServiceID,
                        s.Name, 
                        s.Description
                    from packageitems p
                        join services s on s.ServiceID = p.ServiceID
                    where p.PackageID = $id";

        $results = $this->SubmitQuery($query);

        $ServicesList[] = new service("","","","");
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            $ServicesList[] = new service (
                                $result['ServiceID'],
                                $result['Name'],
                                $result['Description']);
        }
        return $ServicesList;
    }
    
    //Allows the managers to add a new service 
    function AddService($name, $desc, $price)
    {
        $query = "INSERT INTO `services` (
                    `Name`,
                    `Description`,
                    `Price`)
                    VALUES (
                        '$name',
                        '$desc',
                        '$price')";
        $this->SubmitQuery($query);
        return;
    }
    function SubmitQuery($query)
    {
        require 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
        $results = $conn->query($query);
        if (!$results) die ("Database access failed: " . $conn->error);
        $conn->close();
         return $results;
    }
}

?>
