const BASE_URL = "http://localhost:8000/";

$(".close").click(
function() {
    $(this).parent().fadeOut(150);
}
)

function deleteFolder(element) {
    let id = $(element).attr("data-id");
    let parent = $(element).parent();
    
    $.ajax(
        {
            url:  BASE_URL + "process/ajaxHandler.php",
            data: {action: "deleteFolder", id: id},
            method: "post",
            success: function (response) {
                if (response == "1") {
                    parent.fadeOut(180);
                } else {
                    alert("Couldn't delete your folder");
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
                data: {action: "addFolder", title: title.val()},
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

$(".task").click(
    function () {
        $(".selected").removeClass("selected");
        $(this).addClass("selected");
    }
)

$(".delete-task").click(
    function () {
        let id = $(".selected").attr("data-id");
        let task = $(".selected");
        
        $.ajax(
            {
                url:  BASE_URL + "process/ajaxHandler.php",
                data: {action: "deleteTask", id: id},
                method: "post",
                success: function (response) {
                    if (response == "1") {
                        task.fadeOut(180);
                    } else {
                        alert("Couldn't delete your task");
                    }
                }
            }
        )
    }
)