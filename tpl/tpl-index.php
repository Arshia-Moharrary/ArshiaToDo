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
            <div class="title">Dashboard</div>
            <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">John Doe </span><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4kzl1aQvIkyNVBzz8iu6xKcjROVMssdoTdg&s" width="40" height="40" /></div>
        </div>
        <div class="main">
            <div class="nav">
                <div class="menu">
                    <div class="title">Folders</div>
                    <ul id="folders">
                        <?php foreach ($folders as $folder) : ?>
                            <li>
                                <i class="fa fa-folder"></i><?= ucfirst($folder->title); ?>
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
                    <div class="title">Tasks</div>
                    <div class="functions">
                        <div class="button active">Add New Task</div>
                        <div class="button" id="changeTaskMode">Completed</div>
                        <div class="button inverz"><i class="fa fa-trash-o"></i></div>
                    </div>
                </div>
                <div class="content">
                    <div class="list" id="notComplete">
                        <div class="title">Not completed</div>
                        <ul>
                            <!-- Undone tasks -->
                            <?php foreach ($undoneTasks as $task) : ?>
                                <li><i class="fa fa-square-o"></i><span><?= $task->title ?></span>
                                    <div class="info">
                                        <span>Created by <?= $task->created_at ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="list" id="completed" style="display: none;">
                        <div class="title">Completed</div>
                        <ul>
                            <?php foreach ($doneTasks as $task) : ?>
                                <li><i class="fa fa-check-square-o"></i><span><?= $task->title ?></span>
                                    <div class="info">
                                        <span>Completed by <?= $task->doned_at ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="<?= BASE_URL ?>assets/js/script.js"></script>

</body>

</html>