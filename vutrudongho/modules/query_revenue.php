<?php
    include 'connectDatabase.php';
    
    if(isset($_GET['option'])){
        $conn = connectDatabase();
        $option = $_GET['option'];

        if($option == "date"){
            $dateFrom = !empty($_GET['dateFrom']) ? $_GET['dateFrom'] : '2023-01-01';
            $dateTo = !empty($_GET['dateTo']) ? $_GET['dateTo'] : '2023-12-31';
            $kq = $conn->query("Select DATE_FORMAT(OderDate, '%d/%m/%Y') as date, SUM(OrderTotal) as total from `order` where OderDate between '$dateFrom' and '$dateTo' group by date order by OderDate ASC");
            $json = mysqli_fetch_all($kq, MYSQLI_ASSOC);

            echo json_encode($json);
            return;
        }elseif ($option == "month") {
            $kq = $conn->query("Select DATE_FORMAT(OderDate, '%m/%Y') as date, SUM(OrderTotal) as total from `order` where OderDate between '2023-01-01' and '2023-12-31' group by date order by OderDate ASC");
            $json = mysqli_fetch_all($kq, MYSQLI_ASSOC);

            echo json_encode($json);
            return;
        }
        else{
            $kq = $conn->query("Select YEAR(OderDate) as date, SUM(OrderTotal) as total from `order` group by date order by date asc");
            $json = mysqli_fetch_all($kq, MYSQLI_ASSOC);

            echo json_encode($json);
            return;
        }
        

        
    }


?>