<?php include('includes/header.php'); ?>

<?php
require '../includes/encryption_functions.php';
require '../includes/dbconfig.php';

$sql = "SELECT idNumber, surname, firstName, middleName, suffix, dissability, address, dob, age, sex, dateIdissue, guardian, contact, barangay FROM pwddb";
$result = $conn->query($sql);
?>

<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4>List of all PWD</h4>
                </div>
                <div class="card-body pt-1">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID number</th>
                                <th>Name</th>
                                <th>Show All Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $decryptedIdNumber = decryptthis($row['idNumber'], $key);
                                    $decryptedSurname = decryptthis($row['surname'], $key);
                                    $decryptedFirstName = decryptthis($row['firstName'], $key);
                                    $decryptedMiddleName = decryptthis($row['middleName'], $key);
                                    $decryptedSuffix = decryptthis($row['suffix'], $key);

                                    $fullName = htmlspecialchars($decryptedFirstName . " " . $decryptedMiddleName . " " . $decryptedSurname . " " . $decryptedSuffix);

                                    $decrypteddissability = decryptthis($row['dissability'], $key);
                                    $decrpytedaddress = decryptthis($row['address'], $key);
                                    $decrpyteddob = decryptthis($row['dob'], $key);
                                    $decrpytedage = decryptthis($row['age'], $key);
                                    $decrpytedsex = decryptthis($row['sex'], $key);
                                    $decrpyteddateIdissue = decryptthis($row['dateIdissue'], $key);
                                    $decrpytedguardian = decryptthis($row['guardian'], $key);
                                    $decrpytedcontact = decryptthis($row['contact'], $key);
                                    $decrpytedbarangay = decryptthis($row['barangay'], $key);

                                    echo "<tr>
                                            <td>" . htmlspecialchars($decryptedIdNumber) . "</td>
                                            <td>" . $fullName . "</td>
                                            <td>
                                                <button class='btn btn-primary' onclick='showDetails(
                                                    \"$dissability\",
                                                    \"$address\",
                                                    \"$dob\",
                                                    \"$age\",
                                                    \"$sex\",
                                                    \"$dateIdissue\",
                                                    \"$guardian\",
                                                    \"$contact\",
                                                    \"$barangay\"
                                                )'>Show All Details</button>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No results found</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                    <div id="detailsModal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Disability:</strong> <span id="detailDisability"></span></p>
                                    <p><strong>Address:</strong> <span id="detailAddress"></span></p>
                                    <p><strong>Date of Birth:</strong> <span id="detailDob"></span></p>
                                    <p><strong>Age:</strong> <span id="detailAge"></span></p>
                                    <p><strong>Sex:</strong> <span id="detailSex"></span></p>
                                    <p><strong>Date ID Issued:</strong> <span id="detailDateIdissue"></span></p>
                                    <p><strong>Guardian:</strong> <span id="detailGuardian"></span></p>
                                    <p><strong>Contact:</strong> <span id="detailContact"></span></p>
                                    <p><strong>Barangay:</strong> <span id="detailBarangay"></span></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function showDetails(dissability, address, dob, age, sex, dateIdissue, guardian, contact, barangay) {
                            document.getElementById('detailDisability').innerText = dissability;
                            document.getElementById('detailAddress').innerText = address;
                            document.getElementById('detailDob').innerText = dob;
                            document.getElementById('detailAge').innerText = age;
                            document.getElementById('detailSex').innerText = sex;
                            document.getElementById('detailDateIdissue').innerText = dateIdissue;
                            document.getElementById('detailGuardian').innerText = guardian;
                            document.getElementById('detailContact').innerText = contact;
                            document.getElementById('detailBarangay').innerText = barangay;
                            $('#detailsModal').modal('show');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
