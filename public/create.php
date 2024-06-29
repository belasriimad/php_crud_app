<?php require_once('../layouts/header.php'); ?>
<?php
    $title = '';
    $body = '';
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $body = $_POST['body'];
        
        require_once('../helpers/form_validate.php');

        if (!$errors) {
            $sql = 'INSERT INTO tasks(title, body) VALUES(:title, :body)';
    
            $stmt = $conn->prepare($sql);
    
            $stmt->execute([
                ':title' => $title,
                ':body' => $body
            ]);
    
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
                    <h3 class="mt-2">Add new task</h3>
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