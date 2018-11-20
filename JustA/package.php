<?php
require_once "service.php";
class package
{
    public $packageID;
    public $Name;
    public $Price;
    public $Desc;
    public $Services[];

    function __construct($id,$name,$desc,$price)
    {
        $this->packageID = $id;
        $this->Name = $name;
        $this->Desc = $desc;
        $this->Price = $price;
    }

    //this returns a list of packages for the user to choose from
    function getPackages()
    {
        $query = "SELECT * FROM `packages`";
        $results = $this->SubmitQuery($query);

        $packagesList[] = new package("","","","");
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            $packagesList[] = new package (
                                $result['packageID'],
                                $result['Name'],
                                $result['Description'],
                                $result['Price']);
        }
        $serv = new $service("","","","");
        foreach($packagesList as $package)
        {
            $package->Services[] = $serv->getPackageServices($package->packageID);
        }
        return $packagesList;
    }

    //Allows the managers to add a new package 
    function Addpackage($name, $desc, $price)
    {
        $query = "INSERT INTO `packages` (
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

    //adds a service to a package
    function AddServiceToPackage($serviceID, $packageID)
    {
        "INSERT INTO `packageitems` (
            `ServiceID`,
            `PackageID`)
            VALUES (
                '$serviceID',
                '$packageID')";
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
