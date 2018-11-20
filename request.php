<?php
require_once "reqestItems.php";
class request
{
    public $requestID;
    public $UserID;
    public $Status;
    public $Location;
    public $RequestDate;
    public $RequestItems[];
    public $CompletionDate;
    public $Signature;

    function __construct($id,$uID,$status,$loc, $rdate, array $items, $cdate = null, $sign = null)
    {
        $this->requestID = $id;
        $this->UserID = $uID;
        $this->Status = $status;
        $this->Location = $loc;
        $this->RequestDate = $rdate;
        $this->RequestItems = $items;
        $this->CompletionDate = $cdate == null ? "N/A" : $cdate;//because it is nullable in db
        $this->Signature = $sign == null ? "N/A" : $sign; //because it is nullable in db
    }

    //this returns a list of requests for the Manager choose to complete
    function getOpenRequests()
    {
        $query = "SELECT * FROM requests r WHERE r.Status = 'Open'";
        $results = $this->SubmitQuery($query);

        $requestsList[] = new request("","","","","");
        $requestItem = new requestItem("","","","","","","");
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            $requestOrder = $requestItem->getRequestItems($result['RequestID']);
            $requestsList[] = new request (
                                $result['RequestID'],
                                $result['UserID'],
                                $result['Status'],
                                $result['Location'],
                                $result['RequestDate'],
                                $requestOrder,
                                $result['CompletionDate'],
                                $result['ManagerID']);
        }
        return $requestsList;
    }

    //this returns a list of completed requests 
    function getClosedRequests()
    {
        $query = "SELECT * FROM requests r WHERE r.Status = 'Closed'";
        $results = $this->SubmitQuery($query);

        $requestsList[] = new request("","","","","");
        $requestItem = new requestItem("","","","","","","");
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            $requestOrder = $requestItem->getRequestItems($result['RequestID']);
            $requestsList[] = new request (
                                $result['RequestID'],
                                $result['UserID'],
                                $result['Status'],
                                $result['Location'],
                                $result['RequestDate'],
                                $requestOrder,
                                $result['CompletionDate'],
                                $result['ManagerID']);
        }
        return $requestsList;
    }
    //this returns a list of requests for the Manager choose to complete
    function getUserRequests($uID)
    {
        $query = "SELECT * FROM requests r WHERE r.UserID = $uID";
        $results = $this->SubmitQuery($query);

        $requestsList[] = new request("","","","","");
        $requestItem = new requestItem("","","","","","","");
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            $requestOrder = $requestItem->getRequestItems($result['RequestID']);
            $requestsList[] = new request (
                                $result['RequestID'],
                                $result['UserID'],
                                $result['Status'],
                                $result['Location'],
                                $result['RequestDate'],
                                $requestOrder,
                                $result['CompletionDate']);
        }
        return $requestsList;
    }

    function closeRequest($rID, $mID, $datetime)
    {
        $query = "UPDATE requests r 
                SET `Status`='Closed',
                `CompletionDate`= NOW(),
                `ManagerID`=$mID WHERE r.RequestID = $rID";
        
        SubmitQuery($query);
        return;
    }
    function submitRequest($uID, $loc, array $items)
    {
        require_once 'login.php';
        $rID = -1;
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
        
        $query = "INSERT INTO `requests`(`UserID`, `Location`) VALUES ($uID, $loc)";

        if($conn->query($query) == TRUE)
        {
            $rID = $conn->insert_id;
        };
        else{
            die ("Database access failed: " . $conn->error);
        }
             
        $conn->close();

        $requestItem = new requestItem("","","","","","","");
        if($rID != -1)
        {
            foreach($items as $item)
            {
                $requestItem->InsertRequestItems($rID, $item["ServiceID"], $item["PackageID"], $item["Quantity"]);
            }
        }
        return;
    }
    function SubmitQuery($query)
    {
        require_once 'login.php';
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
