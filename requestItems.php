<?php
class requestItem
{
    public $RequestID;
    public $PackageID;// only service or package id will be filled
    public $ServicID; // one will be null
    public $Name;
    public $Price;
    public $Desc;
    public $Quantity;

    function __construct($rID,$pID,$sID,$name,$price,$desc,$quantity)
    {
        $this->RequestID = $rID;
        $this->PackageID = $pID;
        $this->ServicID = $sID;
        $this->Name = $name;
        $this->Price = $price;
        $this->Desc = $desc;
        $this->Quantity = $quantity;
    }

    //this returns a list of services for the user to choose from
    function getRequestItems($rID)
    {
        $query = "SELECT
                    i.RequestID,
                    i.PackageID,
                    i.ServiceID,
                    i.Quantity,
                    s.Name as ServiceName,
                    s.Description as ServiceDesc,
                    s.Price as ServicePrice,
                    p.Name as PackgeName,
                    p.Description as PackageDesc
                    p.Price as PackagePrice,
                FROM
                    requestitems i
                JOIN services s ON
                    s.ServiceID = i.ServiceID
                join packages p ON p.PackageID = i.PackageID
                where i.RequestID = $rID";
        $results = $this->SubmitQuery($query);

        $RequestItems[] = new requestItem("","","","","","","");
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            if($result['ServiceID'] == NULL)
            {
                $RequestItems[] = new requestItem (
                                    $result['RequestID'],
                                    $result['PackageID'],
                                    NULL,
                                    $result['PackgeName'],
                                    $result['PackagePrice'],
                                    $result['PackageDesc']
                                    $result['Quantity']);
            }
            else
            {
                $RequestItems[] = new requestItem (
                                    $result['RequestID'],
                                    NULL,
                                    $result['ServiceID'],
                                    $result['ServiceName'],
                                    $result['ServicePrice'],
                                    $result['ServiceDesc']
                                    $result['Quantity']);
            }
        }
        return $ServicesList;
    }

    function InsertRequestItems($rID, $sID, $pID, $quantity)
    {
        if($item["ServiceID"] == NULL)
        {
            $query2 = "INSERT INTO `requestitems`(
                `RequestID`, 
                `PackageID`, 
                `Quantity`) 
                VALUES (
                    $rID,
                    $pID,
                    $quantity)";
        }
        else    
            $query2 = "INSERT INTO `requestitems`(
                                        `RequestID`, 
                                        `ServiceID`, 
                                        `Quantity`) 
                                        VALUES (
                                            $rID,
                                            $sID,
                                            $quantity)";
        }
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
