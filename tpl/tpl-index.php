<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= WEB_TITLE ?></title>
</head>

<body>
    <div class="page">
        <div class="pageHeader">
            <div class="title">Dashboard</div>
            <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">John Doe </span><img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/73.jpg" width="40" height="40" /></div>
        </div>
        <div class="main">
            <div class="nav">
                <div class="searchbox">
                    <div><i class="fa fa-search"></i>
                        <input type="search" placeholder="Search" />
                    </div>
                </div>
                <div class="menu">
                    <div class="title">Folders</div>
                    <ul>
                        <?php foreach ($folders as $folder) : ?>
                            <a href='?folder_id=<?= $folder->id ?>' class="folder">
                            <li>
                                    <i class="fa fa-folder"></i><?= ucfirst($folder->title); ?>
                                    <a href="?delete_folder_id=<?= $folder->id; ?>">
                                        <i class="fa fa-trash-o remove delete-folder"></i>
                                    </a>
                                </li>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="view">
                <div class="viewHeader">
                    <div class="title">Manage Tasks</div>
                    <div class="functions">
                        <div class="button active">Add New Task</div>
                        <div class="button">Completed</div>
                        <div class="button inverz"><i class="fa fa-trash-o"></i></div>
                    </div>
                </div>
                <div class="content">
                    <div class="list">
                        <div class="title">Today</div>
                        <ul>
                            <li class="checked"><i class="fa fa-check-square-o"></i><span>Update team page</span>
                                <div class="info">
                                    <div class="button green">In progress</div><span>Complete by 25/04/2014</span>
                                </div>
                            </li>
                            <li><i class="fa fa-square-o"></i><span>Design a new logo</span>
                                <div class="info">
                                    <div class="button">Pending</div><span>Complete by 10/04/2014</span>
                                </div>
                            </li>
                            <li><i class="fa fa-square-o"></i><span>Find a front end developer</span>
                                <div class="info"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="list">
                        <div class="title">Tomorrow</div>
                        <ul>
                            <li><i class="fa fa-square-o"></i><span>Find front end developer</span>
                                <div class="info"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script></script>

</body>

</html>