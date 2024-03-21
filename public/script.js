// Initialize variables to keep track of the total number of followers, the current page, and the last searched username
let total = 0;
let curPage = 1;
let searchText = "";

$(document).ready(function () {
    // Attach an event handler to the search button to initiate the search when the mouse button is released
    $("#searchBtn").on("mouseup", async function (e) {
        // Retrieve the username from the input field
        let username = $("#username").val();
        // Clear the followers and user info sections
        $("#followers").html("");
        $("#userInfo").html("");
        // If a username is entered, get the total number of followers for that user
        if (username) {
            getTotal(username);
        }
    });

    // Attach an event handler to the "Load More" button to fetch more followers when clicked
    $("#loadMore").on("mouseup", function () {
        // Retrieve the username from the input field and calculate the next page number
        let username = $("#username").val();
        let page = parseInt($("#followers").data("page")) + 1;
        // Fetch the next page of followers
        searchUser(username, page);
    });
});

// Function to fetch and display a page of followers for a given username
async function searchUser(username, page) {
    curPage = page;
    $.ajax({
        url: `/getFollowers/${username}/${page}`,
        data: { username: username, page: page },
        dataType: "json",
        success: function (data) {
            // If followers are found, display them and update the page data
            if (data.length > 0) {
                if (searchText != username) $("#followers").html("");
                searchText = username;
                data.forEach(function (follower) {
                    // Append each follower's avatar to the followers section
                    $("#followers").append(
                        `<img src="${follower.avatar_url}" alt="${follower.login}'s avatar" style="width: 200px; height: 200px;">`
                    );
                });
                $("#followers").data("page", page);
                // Show or hide the "Load More" button based on whether there are more followers to load
                if (total > curPage * 30) $("#loadMore").show();
                else $("#loadMore").hide();
            } else {
                $("#loadMore").hide();
            }
        },
        error: function () {
            console.log("Error fetching data");
        },
    });
    return;
}

// Function to fetch the total number of followers for a given username
function getTotal(username) {
    $.ajax({
        url: "/getTotal/" + username,
        type: "GET",
        data: { username: username },
        dataType: "json",
        success: function (data) {
            if (data) {
                total = data.followers;
                // Update the total followers count and display the user info
                $("#userInfo").html(
                    `<h2>${username}</h2><p>Followers: ${data.followers}</p>`
                );
                // Fetch the first page of followers
                searchUser(username, 1);
            }
        },
        error: function () {
            console.log("Error fetching data");
        },
    });
}
