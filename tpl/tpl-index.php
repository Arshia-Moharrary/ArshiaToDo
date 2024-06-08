<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= WEB_TITLE ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
</head>

<body>
    <div id="result"></div>
    <div class="page">
        <div class="pageHeader">
            <div class="title"><?= PROJECT_NAME ?></div>
            <?php if ($user) : ?>
                <div class="userPanel"><span class="username"><?= $user->first_name . " " . $user->last_name ?></span><i class="fa fa-sign-out logout"></i></div>
            <?php endif; ?>
        </div>
        <?php if ($user) : ?>
            <div class="main">
                <div class="nav">
                    <div class="menu">
                        <div class="title">Folders</div>
                        <ul id="folders">
                            <?php foreach ($folders as $folder) : ?>
                                <li>
                                    <a href="?folder=<?= $folder->id ?>" class="<?= (isset($_GET["folder"])) && ($folder->id) == $_GET["folder"] ? 'folder-active' : 'folder' ?>">
                                        <i class="fa fa-folder"></i><?= ucfirst($folder->title); ?>
                                    </a>
                                    <i class="fa fa-trash-o remove delete-folder" data-id="<?= $folder->id ?>" onclick="deleteFolder(this)"></i>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <input type="text" id="addFolderInput" placeholder="Add new folder">
                        <button id="addFolderBtn" class="clickable"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="view">
                    <div class="viewHeader">
                        <?php if (isset($_GET["folder"])) : ?>
                            <div class="title">Tasks</div>
                            <div class="functions">
                                <div class="button active" id="addTaskBtn">Add New Task</div>
                                <div class="button" id="changeTaskMode">Completed</div>
                                <div class="button inverz delete-task"><i class="fa fa-trash-o"></i></div>
                            </div>
                    </div>
                    <div class="content">
                        <div class="list" id="notComplete">
                            <div class="title">Not completed</div>
                            <ul id="tasks" class="undone-tasks">
                                <?php if ($undoneTasks) : ?>
                                    <!-- Undone tasks -->
                                    <?php foreach ($undoneTasks as $task) : ?>
                                        <li class="task" data-id="<?= $task->id ?>" onclick="selectTask(this)">
                                            <i class="fa fa-square-o done" onclick="done(this)"></i>
                                            <span><?= $task->title ?></span>
                                            <div class="info">
                                                <span>Created by <?= $task->created_at ?></span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p class="text not-task">There is no task :)</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="list" id="completed" style="display: none;">
                            <div class="title">Completed</div>
                            <ul class="done-tasks">
                                <?php if ($doneTasks) : ?>
                                    <?php foreach ($doneTasks as $task) : ?>
                                        <li class="task" data-id="<?= $task->id ?>" onclick="selectTask(this)"><i class="fa fa-check-square-o undone" onclick="undone(this)"></i><span><?= $task->title ?></span>
                                            <div class="info">
                                                <span>Completed by <?= $task->doned_at ?></span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p class="text not-task">There is no task :)</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php else : ?>
                        <div class="title">Choose a folder</div>
                    <?php endif; ?>
                    </div>
                </div>
                <!-- Sign up form -->
                <link rel="stylesheet" href="style.css">
            <?php else : ?>
                <div class="text">Please <a href="<?= BASE_URL ?>auth/login.php">login</a> or <a href="<?= BASE_URL ?>auth/register.php">register</a> first</div>
            <?php endif; ?>
            </div>
    </div>
    <!-- * CDN * -->

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- * Local * -->
    <script src="<?= BASE_URL ?>assets/js/script.js"></script>

</body>

</html>