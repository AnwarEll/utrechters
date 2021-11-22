<?php include("includes/header.php");
?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Locations</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Event Locations</p>
        </div>
        <div class="card-body">
            <span class="btn btn-success" data-toggle="modal" data-target="#addLocation">Add Location</span>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Location Name</th>
                            <th>Location City</th>
                            <th>Location URL</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `tbl_locations`";
                        $result = $dbconn->query($sql);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['location_name'] ?></td>
                                <td><?php echo $row['location_city'] ?></td>
                                <td style="max-width:500px;"><?php echo $row['location_url'] ?></td>
                                <td>
                                    <button class="btn btn-primary passingID" data-toggle="modal" data-id="<?php echo $row['location_id'] ?>" data-locationname="<?php echo $row['location_name'] ?>" data-locationcity="<?php echo $row['location_city'] ?>" data-locationurl="<?php echo $row['location_url'] ?>" data-target="#editLocation">Edit</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-id="<?php echo $row['location_id'] ?>" data-target="#deleteLocation">Delete</button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Location Name</th>
                            <th>Location City</th>
                            <th>Location URL</th>
                            <th>Update</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addLocation" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="actions/locationActions.php">
                    <div class="modal-header d-flex align-items-center bg-primary text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Add Location</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="addLocationName">Location Name</label>
                                <input type="text" name="locationName" class="form-control" id="addLocationName" autofocus="" required />
                            </div>
                            <div class="form-group col-6">
                                <label for="addLocationCity">Location City</label>
                                <input type="text" name="locationCity" class="form-control" id="addLocationCity" autofocus="" required />
                            </div>
                            <div class="form-group col-12">
                                <label for="addLocationUrl">Google Maps URL</label>
                                <input type="text" name="locationUrl" class="form-control" id="addLocationUrl" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <input type="submit" name="addSubmit" class="btn btn-primary btn-send" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editLocation" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="actions/locationActions.php">
                    <div class="modal-header d-flex align-items-center bg-primary text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Edit Location</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <input type="hidden" name="locationId" class="form-control" id="editLocationId" readonly="readonly" required />
                            </div>
                            <div class="form-group col-6">
                                <label for="editLocationName">Location Name</label>
                                <input type="text" name="locationName" class="form-control" id="editLocationName" autofocus="" required />
                            </div>
                            <div class="form-group col-6">
                                <label for="editLocationCity">Location City</label>
                                <input type="text" name="locationCity" class="form-control" id="editLocationCity" autofocus="" required />
                            </div>
                            <div class="form-group col-12">
                                <label for="editLocationUrl">Google Maps URL</label>
                                <input type="text" name="locationUrl" class="form-control" id="editLocationUrl" required />
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

    <div class="modal fade" id="deleteLocation" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="actions/locationActions.php">
                    <div class="modal-header d-flex align-items-center bg-primary text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Delete Location</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" name="locationId" class="form-control" id="locationId" placeholder="id. . ." autofocus="" readonly="readonly" required />
                        </div>
                        <label for="confirm">Please confirm that you really want to delete the location. <br>This cannot be undone!</label><br>
                        I understand the risk of this, and I want to delete this location. <br>Check this -> <input type="checkbox" name="confirmation" id="confirm">
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
    $('#editLocation').on('show.bs.modal', function(e) {
        var locationId = $(e.relatedTarget).data('id');
        var locationName = $(e.relatedTarget).data('locationname');
        var locationCity = $(e.relatedTarget).data('locationcity');
        var locationUrl = $(e.relatedTarget).data('locationurl');
        $("#editLocationId").val(locationId);
        $("#editLocationName").val(locationName);
        $("#editLocationCity").val(locationCity);
        $("#editLocationUrl").val(locationUrl);
    });
    $('#deleteLocation').on('show.bs.modal', function(e) {
        var locationId = $(e.relatedTarget).data('id');
        $("#locationId").val(locationId);
    });
</script>
</body>

</html>