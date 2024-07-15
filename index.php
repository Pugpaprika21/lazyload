<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lazy Load Users on Scroll</title>
    <style>
        .user-item {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div id="userList">
        <!--  -->
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $(function () {
            var page = 1; 
            var isLoading = false;
            var num = 0; 

            function loadUsers() {
                if (isLoading) return; 
                isLoading = true;

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "http://localhost/lazyload/api/users.php",
                    data: { page: page, limit: 50 },
                    success: function (response) {
                        var userList = $('#userList');
                        response.forEach(function(user) {
                            num++;
                            userList.append('<div class="user-item">' + num + " " + user.first_name + ' ' + user.last_name + '</div>');
                        });

                        page++;
                        isLoading = false;
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        isLoading = false;
                    }
                });
            }

            loadUsers();

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    loadUsers();
                }
            });
        });
    </script>
</body>
</html>
