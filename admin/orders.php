<?php include("includes/header.php");
?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Orders</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Placed Orders</p>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Zip Code</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Phone Number</th>
                            <th>Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `tbl_orders` as o, `tbl_events` as e WHERE e.`event_id`=o.`event_id`";
                        $result = $dbconn->query($sql);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo ucfirst($row['firstname']) ?></td>
                                <td><?php echo ucfirst($row['lastname']) ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo ucfirst($row['streetname']) . " " . $row['housenumber'] ?></td>
                                <td><?php echo $row['zipcode'] ?></td>
                                <td><?php echo ucfirst($row['city']) ?></td>
                                <td><?php echo ucfirst($row['country']) ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['event_name'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Zip Code</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Phone Number</th>
                            <th>Event</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © EventManager 2021</span></div>
    </div>
</footer>
<a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/theme.js"></script>
<script>
    $('#editUser').on('show.bs.modal', function(e) {
        var userId = $(e.relatedTarget).data('id');
        var userFirstName = $(e.relatedTarget).data('firstname');
        var userLastName = $(e.relatedTarget).data('lastname');
        var userEmail = $(e.relatedTarget).data('email');
        var userType = $(e.relatedTarget).data('usertype');
        $("#editUserId").val(userId);
        $("#editUserFirstName").val(userFirstName);
        $("#editUserLastName").val(userLastName);
        $("#editUserEmail").val(userEmail);
        $("#editUserType").val(userType);
    });
    $('#deleteUser').on('show.bs.modal', function(e) {
        var userId = $(e.relatedTarget).data('id');
        $("#userId").val(userId);
    });
</script>
</body>

</html>