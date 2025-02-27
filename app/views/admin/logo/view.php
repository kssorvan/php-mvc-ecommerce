<?php\n// \app\views\admin\logo\view.php\n\n?>
<div class="content-right">
    <div class="top">
        <h3>All Logo</h3>
    </div>
    <div class="bottom view-post">
        <figure>
            <form method="post" enctype="multipart/form-data">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        <?= htmlspecialchars($_GET['success']) ?>
                    </div>
                <?php endif; ?>
                
                <table class="table" border="1px">
                    <tr> 
                        <th>ID</th>
                        <th>Status</th>
                        <th>Thumbnail</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($logos as $logo): ?>
                    <tr>
                        <td><?= $logo['id'] ?></td>
                        <td><?= $logo['status'] ?></td>
                        <td><img src="/assets/images/admin/<?= $logo['thumbnail'] ?>" width="150px"/></td>
                        <td width="150px">
                            <a href="/admin/logo/update/<?= $logo['id'] ?>" class="btn btn-primary">Update</a>
                            <button type="button" data-id="<?= $logo['id'] ?>" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                Remove
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="modal-title">Are you sure you want to remove this logo?</h5>
                            </div>
                            <div class="modal-footer">
                                <form id="deleteForm" method="post" action="/admin/logo/delete">
                                    <input type="hidden" id="removeId" name="remove_id">
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </figure>
    </div>
</div>

<script>
    // Set the logo ID when remove button is clicked
    document.querySelectorAll('.btn-remove').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('removeId').value = this.getAttribute('data-id');
        });
    });
</script>