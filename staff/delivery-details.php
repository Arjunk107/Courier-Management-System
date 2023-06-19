<?php
    require 'header-staff.php';
    include('../connection.php');

?>
<html>

<head>
    <link href="../css/table.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color:#FFFFE0">

    <div class="container">
        <div  class="table-style">
            <table style="margin-left:auto;margin-right:auto;width:75%;" class="styled-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Booking id </th>
                        <th scope="col">Staff Id</th>
                        <th scope="col">Receiver name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                            $date=date('y-m-d');
                            $result = mysqli_query($connect, "SELECT * FROM `delivery`INNER JOIN `staff` ON delivery.Staff_id=staff.Staff_id WHERE date='$date' ");
                            $no=1;
                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>
                                <tr class="active-row">
                                <td><?=$no?></td>
                                    <td><?=$row['booking_id']?></td>
                                    <td><?=$row['Staff_id']?></td>
                                    <td><?=$row['receiver_name']?></td>
                                    <td><?=$row['date']?></td>
                                    <td><?=$row['dstatus']?></td>
                                    <td><?=$row['reason']?></td>
                                    <?php
                                    $no++;
                                    ?>
                                </tr>
                            <?php
                            }
                     
                  ?>
                        
                </tbody>

            </table>
        </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>