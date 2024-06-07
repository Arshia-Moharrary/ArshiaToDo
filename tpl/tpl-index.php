<?= $_SESSION["user"]; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= WEB_TITLE ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/auth.css">
</head>

<body>
    <div id="result"></div>
    <div class="page">
        <div class="pageHeader">
            <div class="title">ArshiaToDo</div>
            <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">John Doe </span><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4kzl1aQvIkyNVBzz8iu6xKcjROVMssdoTdg&s" width="40" height="40" /></div>
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
                            <?php if ($undoneTasks) : ?>
                                <ul id="tasks" class="undone-tasks">
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
                                </ul>
                            <?php else : ?>
                                <p style="margin-left: 12px; font-size: 22px; opacity: 0.7;">There is no task :)</p>
                            <?php endif; ?>
                        </div>
                        <div class="list" id="completed" style="display: none;">
                            <div class="title">Completed</div>
                            <?php if ($doneTasks) : ?>
                                <ul class="done-tasks">
                                    <?php foreach ($doneTasks as $task) : ?>
                                        <li class="task" data-id="<?= $task->id ?>" onclick="selectTask(this)"><i class="fa fa-check-square-o undone" onclick="undone(this)"></i><span><?= $task->title ?></span>
                                            <div class="info">
                                                <span>Completed by <?= $task->doned_at ?></span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else : ?>
                                <p style="margin-left: 12px; font-size: 22px; opacity: 0.7;">There is no task :)</p>
                            <?php endif; ?>
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