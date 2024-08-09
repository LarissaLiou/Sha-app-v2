const notifications_container = document.querySelector("#notifications");

async function acceptConnectionRequest(notification_id,container) {
    const response = await postRequest("backend/Notifications/notification_accept_connection.php", { notification_id });
    if (response.success){
        alert("Connection request accepted");
        container.remove();
    }
    else alert("Failed to accept connection request");
}
function insertNotification(notifData) {
    const notification = createEle("div", ["notifGridConnect"], "", {}, {}); // Create a div element
    for (const key in notifData) {
        notification.dataset[key] = JSON.stringify(notifData[key]);
    }

    const img = createEle("img", ["notifpfp"], "", { src: notifData.profile_picture });
    img.onerror = function() {
        img.src = "static/assets/default.png";
    };
    notification.appendChild(img);

    const username = document.createElement("h2");
    username.classList.add("sender_id");
    username.textContent = notifData.username;
    notification.appendChild(username); // Append the username to the notification
    // const notifType = notifData.notification_type;
    // const title = document.createElement("h3");
    // title.classList.add("notification_type");
    // title.textContent = notificationTextMap[notifType] || "Unknown notification type";
    const notifDescription = createEle("p",["notifDescription","grid-items"],"",{
        textContent: notifData["content"]
    },{}); // Create a paragraph element
    notification.appendChild(notifDescription);

    // const notif_time = document.createElement("h4"); // Correct the typo here
    // notif_time.classList.add("created_at");
    // notif_time.textContent = notifData.time;
    // notification.appendChild(notif_time); // Append the time to the notification
    if (notifData.notification_type == 2) {
        const acceptButton = createEle("button", ["notifAccept","grid-items"], "", {
            textContent: "Accept"
        }, {});
        acceptButton.onclick = function() {
            acceptConnectionRequest(notifData.notification_id, notification);
        };
        notification.appendChild(acceptButton);
    }
    notifications_container.appendChild(notification);
}

async function setUpNotifications() {
    const { notifications } = await getRequest("backend/Notifications/notifications.php");

    for (const notification of notifications) {
        insertNotification(notification);
    }
}

setUpNotifications();