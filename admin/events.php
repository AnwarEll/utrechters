<?php include("includes/header.php");
?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Events</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Planned Events</p>
        </div>
        <div class="card-body">
            <span class="btn btn-success" data-toggle="modal" data-target="#addEvent">Add Event</span>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Total Tickets</th>
                            <th>Stock Tickets</th>
                            <th>Location</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `tbl_events` as e, `tbl_locations` as l WHERE e.location_id = l.location_id";
                        $result = $dbconn->query($sql);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['event_name'] ?></td>
                                <td><?php echo $row['totaltickets'] ?></td>
                                <td><?php echo $row['stocktickets'] ?></td>
                                <td><?php echo $row['location_name'] ?></td>
                                <td><button class="btn btn-primary passingID" data-toggle="modal" data-id="<?php echo $row['event_id'] ?>" data-name="<?php echo $row['event_name'] ?>" data-totaltickets="<?php echo $row['totaltickets'] ?>""
                                data-location="<?php echo $row['location_name'] ?>" data-starttime="<?php echo $row['event_startdate'] ?>" data-endtime="<?php echo $row['event_enddate'] ?>" data-description="<?php echo $row['event_description'] ?>" data-maxtickets="<?php echo $row['totaltickets'] ?>" data-stocktickets="<?php echo $row['stocktickets'] ?>" data-target="#editEvent">Edit</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-id="<?php echo $row['event_id'] ?>" data-target="#deleteEvent">Delete</button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Event Name</th>
                            <th>Total Tickets</th>
                            <th>Stock Tickets</th>
                            <th>Location</th>
                            <th>Update</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addEvent" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="actions/eventActions.php" enctype="multipart/form-data">
                    <div class="modal-header d-flex align-items-center bg-primary text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Add Event</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="eventName">Name</label>
                                <input type="text" name="eventName" class="form-control" id="eventName" required />
                            </div>
                            <div class="form-group col-12">
                                <label for="eventDescription">Description</label>
                                <textarea name="eventDescription" class="form-control" id="eventDescription" required></textarea>
                            </div>
                            <div class="form-group col-md-12" style="margin:12px;max-width: 766px;">
                                <input type="file" name="eventImage" class="custom-file-input" id="customFileInput" required>
                                <label for="customFileInput" class="custom-file-label">Image</label>
                            </div>
                            <div class="form-group col-6">
                                <label for="startDate">Start Date</label>
                                <input type="datetime-local" name="startDate" class="form-control" id="startDate" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="endDate">End Date</label>
                                <input type="datetime-local" name="endDate" class="form-control" id="endDate" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="locationName">Location</label>
                                <select name="locationName" class="browser-default custom-select" id="locationName">
                                    <option selected>Choose a location</option>
                                    <?php
                                    $lQuery     = "SELECT * FROM `tbl_locations` ORDER BY `location_city`";
                                    $lResult    = $dbconn->query($lQuery);
                                    while ($row = mysqli_fetch_array($lResult)) {
                                        $locId = $row['location_id'];
                                        $location = $row['location_name'];
                                        $locCity  = $row['location_city'];
                                        echo "<option value='$locId'>$locCity | $location</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="availableTickets">Available Tickets</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">🎫</div>
                                    </div>
                                    <input type="number" name="availableTickets" min="0" class="form-control" id="availableTickets" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="ticketPrice">Ticket Price</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" min=0 step=0.01 name="ticketPrice" class="form-control" id="ticketPrice" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="customUrl">Custom URL</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">/</div>
                                    </div>
                                    <input type="text" name="customUrl" class="form-control" id="customUrl" required>
                                </div>
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

    <div class="modal fade" id="editEvent" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="actions/eventActions.php">
                    <div class="modal-header d-flex align-items-center bg-primary text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Edit Event</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <input type="hidden" name="eventId" class="form-control" id="editEventId" readonly="readonly" required />
                            </div>
                            <div class="form-group col-12">
                                <label for="editEventName">Event Name</label>
                                <input type="text" name="eventName" class="form-control" id="editEventName" autofocus="" required />
                            </div>
                            <div class="form-group col-12">
                                <label for="editDescription">Event Description</label>
                                <textarea name="eventDescription" class="form-control summernote" id="editDescription" required></textarea>
                            </div>
                            <div class="form-group col-12">
                                <label for="editLocation">Location</label>
                                <select name="locationName" class="browser-default custom-select" id="editLocation">
                                    <?php
                                    $lQuery     = "SELECT * FROM `tbl_locations` ORDER BY `location_city`";
                                    $lResult    = $dbconn->query($lQuery);
                                    while ($row = mysqli_fetch_array($lResult)) {
                                        $locId = $row['location_id'];
                                        $location = $row['location_name'];
                                        $locCity  = $row['location_city'];
                                        echo "<option value='$locId'>$locCity | $location</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="editStartDate">Start Date</label>
                                <input type="text" name="startDate" class="form-control" id="editStartDate" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="editEndDate">End Date</label>
                                <input type="text" name="endDate" class="form-control" id="editEndDate" required>
                            </div>
                            <div class="col-4">
                                <label for="editTotalTickets">Total Tickets</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">🎫</div>
                                    </div>
                                    <input type="number" name="totalTickets" min="0" class="form-control" id="editTotalTickets" required>
                                </div>
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

    <div class="modal fade" id="deleteEvent" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="actions/eventActions.php">
                    <div class="modal-header d-flex align-items-center bg-primary text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Delete Event</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" name="eventId" class="form-control" id="eventId" placeholder="id. . ." autofocus="" readonly="readonly" required />
                        </div>
                        <label for="confirm">Please confirm that you really want to delete the event. <br>This cannot be undone!</label><br>
                        I understand the risk of this, and I want to delete this event. <br>Check this -> <input type="checkbox" name="confirmation" id="confirm">
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
    $('#editEvent').on('show.bs.modal', function(e) {
        var eventId = $(e.relatedTarget).data('id');
        var eventName = $(e.relatedTarget).data('name');
        var locationName = $(e.relatedTarget).data('location');
        var description = $(e.relatedTarget).data("description");
        var startDate = $(e.relatedTarget).data("starttime");
        var endDate = $(e.relatedTarget).data("endtime");
        var maxTickets = $(e.relatedTarget).data("maxtickets");
        $("#editEventId").val(eventId);
        $("#editEventName").val(eventName);
        $("#editLocation").val(locationName);
        $("#editDescription").val(description);
        $("#editStartDate").val(startDate);
        $("#editEndDate").val(endDate);
        $("#editTotalTickets").val(maxTickets);
        console.log(locationName)
    });
    $('#deleteEvent').on('show.bs.modal', function(e) {
        var eventId = $(e.relatedTarget).data('id');
        $("#eventId").val(eventId);
    });
    $(document).ready(function() {
        $("#ticketPrice").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var name = document.getElementById("customFileInput").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = name
    })
</script>
</body>

</html>