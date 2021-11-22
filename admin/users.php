<?php include("includes/header.php");
?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">User Accounts</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Registerd Users</p>
        </div>
        <div class="card-body">
            <span class="btn btn-success" data-toggle="modal" data-target="#addUser">Add User</span>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Account Type</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `tbl_users` as u, `tbl_usertypes` as ut WHERE ut.usertype_id=u.usertype";
                        $result = $dbconn->query($sql);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['firstname'] ?></td>
                                <td><?php echo $row['lastname'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['usertype_name'] ?></td>
                                <td><button class="btn btn-primary passingID" data-toggle="modal" data-id="<?php echo $row['id'] ?>" data-firstname="<?php echo $row['firstname'] ?>" data-lastname="<?php echo $row['lastname'] ?>""
                                data-email=" <?php echo $row['email'] ?>" data-usertype="<?php echo $row['usertype']; ?>" data-target="#editUser">Edit</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-id="<?php echo $row['id'] ?>" data-target="#deleteUser">Delete</button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Account Type</th>
                            <th>Update</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="actions/userActions.php">
                    <div class="modal-header d-flex align-items-center bg-primary text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Add User</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="firstnameInput" class="form-label">First Name</label>
                                <input type="text" name="firstname" class="form-control" id="firstnameInput" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastnameInput" class="form-label">Last Name</label>
                                <input type="text" name="lastname" class="form-control" id="lastnameInput" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="emailInput" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="emailInput" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="userType">UserType</label>
                                <select name="usertype" class="browser-default custom-select" id="userType">
                                    <?php
                                    $lQuery     = "SELECT * FROM `tbl_usertypes` ORDER BY `usertype_name` DESC";
                                    $lResult    = $dbconn->query($lQuery);
                                    while ($row = mysqli_fetch_array($lResult)) {
                                        $userId   = $row['usertype_id'];
                                        $userType = $row['usertype_name'];
                                        echo "<option value='$userId'>$userType</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="passwordInput" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="passwordInput" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="repeatPasswordInput" class="form-label">Repeat Password</label>
                                <input type="password" name="repeatPassword" class="form-control" id="repeatPasswordInput" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="addSubmit" class="btn btn-primary btn-send" value="Add">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="actions/userActions.php">
                    <div class="modal-header d-flex align-items-center bg-primary text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Edit User</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <input type="hidden" name="userId" class="form-control" id="editUserId" readonly="readonly" required />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editUserFirstName" class="form-label">First Name</label>
                                <input type="text" name="firstname" class="form-control" id="editUserFirstName" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editUserLastName" class="form-label">Last Name</label>
                                <input type="text" name="lastname" class="form-control" id="editUserLastName" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="editUserEmail" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="editUserEmail" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="editUserType">UserType</label>
                                <select name="usertype" class="browser-default custom-select" id="editUserType">
                                    <?php
                                    $lQuery     = "SELECT * FROM `tbl_usertypes` ORDER BY `usertype_name` DESC";
                                    $lResult    = $dbconn->query($lQuery);
                                    while ($row = mysqli_fetch_array($lResult)) {
                                        $userId   = $row['usertype_id'];
                                        $userType = $row['usertype_name'];
                                        echo "<option value='$userId'>$userType</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="passwordInput" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="passwordInput">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="repeatPasswordInput" class="form-label">Repeat Password</label>
                                <input type="password" name="repeatPassword" class="form-control" id="repeatPasswordInput">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="editSubmit" class="btn btn-primary btn-send" value="Edit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="actions/userActions.php">
                    <div class="modal-header d-flex align-items-center bg-primary text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Delete User</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="userId" class="form-control" id="userId" placeholder="id. . ." autofocus="" readonly="readonly" required />
                        </div>
                        <label for="confirm">Please confirm that you really want to delete the user. <br>This cannot be undone!</label><br>
                        I understand the risk of this, and I want to delete this user. <br>Check this -> <input type="checkbox" name="confirmation" id="confirm">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <input type="submit" name="deleteSubmit" class="btn btn-danger btn-send" value="Delete">
                    </div>
                </form>
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