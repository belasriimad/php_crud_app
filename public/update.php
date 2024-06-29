<?php require_once('../layouts/header.php'); ?>
<?php
    if (!$_GET['id']) {
        header('Location:index.php');
    }

    $task_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :task_id");
    $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $stmt->execute();
   
    // set the resulting array to associative
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    $title = $task['title'];
    $body = $task['body'];
    $done = $task['done'];
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $title = $_POST['title'];
        $body = $_POST['body'];
        $done = $_POST['done'] ?? 0;

        require_once('../helpers/form_validate.php');

        if (!$errors) {
            $sql = 'UPDATE tasks SET title = :title,body =:body, done =:done
                WHERE id = :task_id';
    
            // prepare statement
            $statement = $conn->prepare($sql);
            
            // bind params
            $statement->bindParam(':task_id', $task_id, PDO::PARAM_INT);
            $statement->bindParam(':title', $title);
            $statement->bindParam(':body', $body);
            $statement->bindParam(':done', $done);
            $statement->execute();

            header('Location:index.php');
        }
    }
?>
<div class="container">
    <div class="row my-4">
        <div class="col-md-10 mx-auto">
            <?php if ($errors) : ?>
                <?php foreach ($errors as $error) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="mt-2">Update task</h3>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-home"></i> Back 
                    </a>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <input type="text" name="title" placeholder="Title*" 
                                value="<?php echo $title; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <textarea rows="5" cols="30" name="body"
                                placeholder="Body*" class="form-control"><?php echo $body; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" name="done" 
                                <?php if ($done): ?> checked <?php endif; ?> 
                                value="1"    
                                class="form-check-input">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('../layouts/footer.php'); ?>