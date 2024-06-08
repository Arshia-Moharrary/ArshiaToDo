const BASE_URL = "http://localhost:8000/";

function closeAlert(element) {
    $(element).parent().remove();
}

function deleteFolder(element) {
    let id = $(element).attr("data-id");
    let parent = $(element).parent();

    $.ajax(
        {
            url: BASE_URL + "process/ajaxHandler.php",
            data: { action: "deleteFolder", id: id },
            method: "post",
            success: function (response) {
                if (response == "1") {
                    parent.fadeOut(180);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Couldn't delete your folder"
                    });
                }
            }
        }
    )
}

$("#addFolderBtn").click(
    function () {
        let title = $("#addFolderInput");

        $.ajax(
            {
                url: BASE_URL + "process/ajaxHandler.php",
                data: { action: "addFolder", title: title.val() },
                method: "post",
                success: function (response) {
                    $(response).appendTo("#folders");
                    title.val("");
                }
            }
        )
    }
)

$("#changeTaskMode").click(
    function () {

        if ($(this).html() == "Completed") {
            $(this).html("Not completed");
            $("#notComplete").fadeOut(0);
            $("#completed").fadeIn(0);
        } else {
            $(this).html("Completed");
            $("#completed").fadeOut(0);
            $("#notComplete").fadeIn(0);
        }
    }
)


function selectTask(element) {
    $(".selected").removeClass("selected");
    $(element).addClass("selected");
}

$(".delete-task").click(
    function () {
        let id = $(".selected").attr("data-id");
        let task = $(".selected");

        if (task.length >= 1) {
            $.ajax(
                {
                    url: BASE_URL + "process/ajaxHandler.php",
                    data: { action: "deleteTask", id: id },
                    method: "post",
                    success: function (response) {
                        if (response == "1") {
                            task.fadeOut(180);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Couldn't delete your task"
                            });
                        }
                    }
                }
            )
        } else {
            Swal.fire({
                icon: "info",
                title: "Select task",
                text: "First select a task for delete"
            });
        }
    }
)

$("#addTaskBtn").click(
    function () {
        Swal.fire({
            title: "Submit task title",
            input: "text",
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: true,
            confirmButtonText: "Add",
            showLoaderOnConfirm: true,
            preConfirm: function (title) {
                // Get folder id of url
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                const folder = urlParams.get('folder'); /* Folder id is here */

                $.ajax(
                    {
                        url: BASE_URL + "process/ajaxHandler.php",
                        data: { action: "addTask", title: title, folder: folder },
                        method: "post",
                        success: function (response) {
                            $(response).appendTo("#tasks");
                            $(".not-task").remove();
                        }
                    }
                )
            }
        })
    }
)

function done(element) {
    // Front
    $(element).removeClass();
    $(element).addClass("fa fa-check-square-o undone");
    $(element).attr("onclick", "undone(this)");

    // Send ajax request for done task
    let id = $(element).parent().attr("data-id");

    $.ajax(
        {
            url: BASE_URL + "process/ajaxHandler.php",
            data: { action: "doneTask", id: id },
            method: "post",
            success: function (response) {
                if (response == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Task done operation failed"
                    });
                }
            }
        }
    )
}

function undone(element) {
    // Front
    $(element).removeClass();
    $(element).addClass("fa fa-square-o undone");
    $(element).attr("onclick", "done(this)");

    // Send ajax request for undone task
    let id = $(element).parent().attr("data-id");

    $.ajax(
        {
            url: BASE_URL + "process/ajaxHandler.php",
            data: { action: "undoneTask", id: id },
            method: "post",
            success: function (response) {
                if (response == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Task undone operation failed"
                    });
                }
            }
        }
    )
}

$("#register").click(
    function (e) {
        e.preventDefault();

        // Form data
        let firstName = $("#firstName").val();
        let lastName = $("#lastName").val();
        let email = $("#email").val();
        let password = $("#password").val();

        $.ajax(
            {
                url: BASE_URL + "process/ajaxHandler.php",
                data: { action: "registerUser", firstName: firstName, lastName: lastName, email: email, password: password },
                method: "post",
                success: function (response) {
                    if (response == 1) {
                        Swal.fire({
                            icon: "success",
                            title: "Register is successfully",
                            confirmButtonText: "OK",
                            showLoaderOnConfirm: true,
                            preConfirm: function () {
                                window.location.href = BASE_URL;
                            }
                        })
                    } else if (response == 0) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Registration failed"
                        });
                    } else {
                        $(".error").html("");
                        $(response).appendTo(".error");
                    }
                }
            }
        )
    }
)

$("#login").click(
    function (e) {
        e.preventDefault();

        // Form data
        let email = $("#email").val();
        let password = $("#password").val();

        $.ajax(
            {
                url: BASE_URL + "process/ajaxHandler.php",
                data: { action: "loginUser", email: email, password: password },
                method: "post",
                success: function (response) {
                    if (response == 1) {
                        Swal.fire({
                            icon: "success",
                            title: "Login is successfully",
                            confirmButtonText: "OK",
                            showLoaderOnConfirm: true,
                            preConfirm: function () {
                                window.location.href = BASE_URL;
                            }
                        })
                    } else if (response == 0) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Login failed"
                        });
                    } else {
                        $(".error").html("");
                        $(response).appendTo(".error");
                    }
                }
            }
        )
    }
)

$(".logout").click(
    function () {
        Swal.fire({
            title: "Logout",
            text: "Are you sure logout of your account?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6e7881",
            confirmButtonText: "Yes, logout!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax(
                    {
                        url: BASE_URL + "process/ajaxHandler.php",
                        data: { action: "logoutUser" },
                        method: "post",
                        success: function () {
                            window.location.href = BASE_URL;
                        }
                    }
                )
            }
        });
    }
)