<?php
/**
 * @var array $data
 * @var int $currentPage
 * @var int $totalRecords
 * @var int $totalPages
 */
include(LAYOUTS . 'head.php');
?>

<main class="page">
    <section class="clean-block about-us">
        <div class="container">
            <div class="block-heading">
<!--                <h2 class="text-info">Dashboard</h2>-->
            </div>
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <p class="text-primary m-0 fw-bold">Users</p>
                        <a href="/add_user" class="btn btn-success">Add New</a>
                    </div>
                    <div class="card-body">
                        <div id="dataTable" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                            <table id="dataTable" class="table my-0">
                                <thead>
                                <tr>
                                    <th>email</th>
                                    <th>username</th>
                                    <th class="text-end">action</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php foreach ($data['users'] as $user): ?>
                                <tr>
                                    <td><?php echo $user['email'] ?></td>
                                    <td><?php echo $user['username'] ?></td>
                                    <td class="d-flex justify-content-end gap-3">
                                        <a class="btn btn-info text-light" href="/edit_user/<?php echo $user['id'] ?>">Edit</a>
                                        <a href="/delete_user/<?php echo $user['id'] ?>" onclick="return confirmDelete('User')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>

								<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">

                                    <?php
									$recordsPerPage = 10; // Assuming 10 records per page

									// Calculate start and end record numbers
									$startRecord = ($currentPage - 1) * $recordsPerPage + 1;
									$endRecord = min($currentPage * $recordsPerPage, $totalRecords); // Assuming $totalRecords is the total number of records in your database

									// Display the pagination info
									echo "Showing $startRecord to $endRecord of $totalRecords";
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
										<?php if ($currentPage > 1): ?>
                                            <li class="page-item"><a class="page-link" href="/users/page/<?php echo $currentPage - 1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
										<?php else: ?>
                                            <li class="page-item disabled"><span class="page-link" aria-hidden="true">«</span></li>
										<?php endif; ?>

										<?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li class="page-item <?php echo ($i == $currentPage) ? 'active' : '' ?>"> <a class="page-link" href="/users/page/<?php echo $i ?>"><?php echo $i ?></a></li>
										<?php endfor; ?>

										<?php if ($currentPage < $totalPages): ?>
                                            <li class="page-item"><a class="page-link" href="/users/page/<?php echo $currentPage + 1 ?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
										<?php else: ?>
                                            <li class="page-item disabled"><span class="page-link" aria-hidden="true">»</span></li>
										<?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include(LAYOUTS. 'foot.php'); ?>

