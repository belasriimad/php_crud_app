<?php require_once('../layouts/header.php'); ?>
<?php
 $stmt = $conn->prepare("SELECT * FROM tasks");
 $stmt->execute();

 // set the resulting array to associative
 $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
  <div class="container">
    <div class="row my-4">
      <div class="col-md-10 mx-auto">
        <div class="my-3">
          <a href="create.php" class="btn btn-primary">
              <i class="fas fa-plus"></i> Create 
          </a>
        </div>
        <div class="card">
          <div class="card-body">
            <table class="table">
              <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Title</th>
                      <th scope="col">Body</th>
                      <th scope="col">Done</th>
                      <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
                <?php foreach($tasks as $key => $task) :?>
                <tr>
                  <th scope="row"><?php echo $key += 1; ?></th>
                  <td><?php echo $task['title']; ?></td>
                  <td><?php echo $task['body']; ?></td>
                  <td>
                    <?php if ($task['done']): ?>
                        <span class="badge bg-success p-2">
                            Done
                        </span>
                    <?php else: ?>
                        <span class="badge bg-danger p-2">
                            Pending...
                        </span>
                    <?php endif; ?>
                  </td>
                  <td>
                      <a href="update.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-warning">
                          <i class="fas fa-edit"></i>
                      </a>
                      <a href="delete.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-danger">
                          <i class="fas fa-trash"></i>
                      </a>
                  </td>
                </tr>   
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php require_once('../layouts/footer.php'); ?>

    